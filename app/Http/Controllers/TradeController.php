<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageData;
use App\Models\TradeLeft;
use App\Models\TradeRight;
use App\Models\AllTrade;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TradeController extends Controller
{
    public function Trade(Request $request)
    {

        $loguserId = Auth::id();
        $tradeleftdata = TradeLeft::where('user_id', $loguserId)->get();
        $traderightdata = TradeRight::where('user_id', $loguserId)->get();

        $search = $request->search;

        if (!empty($search)) {
            $imageDatas = ImageData::where('image_name', 'LIKE', "%$search%")->paginate(10);
        } else {
            $imageDatas = ImageData::paginate(2);
        }

        // Check if the collection is empty
        $noResults = $imageDatas->isEmpty();

        $data = compact('imageDatas', 'tradeleftdata', 'traderightdata',  'search',  'noResults');
        return view('trade')->with($data);
    }

    public function Left(Request $request)
    {
        return $this->saveCardSelection($request, 'left');
    }

    public function Right(Request $request)
    {
        return $this->saveCardSelection($request, 'right');
    }

    private function saveCardSelection(Request $request, $side)
    {
        $data = [
            'image' => $request->input('image'),
            'user_id' => Auth::id(),
            'card_id' => $request->input('id'),
            'name' => $request->input('name'),
            'value' => $request->input('normalValue'),
            'p_value' => $request->input('permanentValue'),
            'price' => $request->input('price'),
            'isPermanent' => $request->input('isPermanent') === "1" ? true : false,
            'isSide' => $request->input('isSide'),
        ];

        if ($side === 'right') {
            TradeRight::create($data);
        } else {
            TradeLeft::create($data);
        }

        return redirect()->back();
    }

    public function Destroyleft($id)
    {
        $item = TradeLeft::find($id);
        if ($item) {
            $item->delete();
        }

        return redirect()->back();
    }

    public function Destroyright($id)
    {
        $item = TradeRight::find($id);
        if ($item) {
            $item->delete();
        }

        return redirect()->back();
    }


    public function Submit(Request $request)
    {
        $loguserId = Auth::id();

        // Retrieve tradeleftdata and traderightdata from the request
        $tradeleftdata = json_decode($request->input('tradeleftdata'), true) ?? [];
        $traderightdata = json_decode($request->input('traderightdata'), true) ?? [];

        // Combine both trade data arrays into one
        $allTradeData = array_merge($tradeleftdata, $traderightdata);

        // Check if there is data to process
        if (!empty($allTradeData)) {
            // Generate a unique batch ID
            $batchId = DB::table('all-trade')->max('batch_id') + 1;

            // Prepare the data for batch insertion
            $batchData = array_map(function ($trade) use ($loguserId, $batchId) {
                return [
                    'batch_id' => $batchId,
                    'image' => $trade['image'],
                    'user_id' => $loguserId,
                    'card_id' => $trade['card_id'],
                    'name' => $trade['name'],
                    'value' => $trade['value'],
                    'p_value' => $trade['p_value'],
                    'price' => $trade['price'],
                    'isPermanent' => $trade['isPermanent'] === 1 ? true : false,
                    'isSide' => $trade['isSide'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $allTradeData);

            // Use a transaction to ensure data integrity
            DB::transaction(function () use ($batchData) {
                // Insert all data in one query
                AllTrade::insert($batchData);
            });

            // Delete records related to the current user from TradeLeft and TradeRight
            $deletedLeft = TradeLeft::where('user_id', $loguserId)->delete();
            Log::info("Deleted TradeLeft records for user $loguserId: $deletedLeft");

            $deletedRight = TradeRight::where('user_id', $loguserId)->delete();
            Log::info("Deleted TradeRight records for user $loguserId: $deletedRight");

            // Redirect to the dashboard
            return redirect('/dashboard')->with('success', 'Trade submitted successfully.');
        } else {
            // Handle the case where no trade data is provided
            return redirect()->back()->with('error', 'No trade data provided.');
        }
    }



    public function Dashboard(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Update the user's last activity timestamp
            DB::table('users')
                ->where('id', $user->id)
                ->update(['last_activity' => now()]);
        }

        $onlineDuration = now()->subMinutes(1);

        // Initialize the query with relationships
        $query = AllTrade::with(['user:id,name,last_activity']);

        // Handle Search
        if ($search = $request->input('search')) {
            // Search by post name or user name
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
            });
        }

        if ($postId = $request->input('post_id')) {
            $query->where('batch_id', $postId);
        }

        // Handle Online/Offline Status Filter
        if ($status = $request->input('status')) {
            $query->whereHas('user', function ($q) use ($status, $onlineDuration) {
                if ($status == 'online') {
                    $q->where('last_activity', '>', $onlineDuration);
                } elseif ($status == 'offline') {
                    $q->where('last_activity', '<=', $onlineDuration);
                }
            });
        }

        // Handle Sorting
        $sortOrder = $request->input('sort', 'desc');
        $query->orderBy('created_at', $sortOrder);

        // Fetch all trades
        $allTrades = collect();
        $query->chunk(100, function ($trades) use (&$allTrades) {
            $allTrades = $allTrades->merge($trades);
        });

        // Group and organize trades
        $tradesByBatch = $allTrades->groupBy('batch_id');

        $organizedTrades = $tradesByBatch->map(function ($trades) use ($onlineDuration) {
            $user = $trades->first()->user;
            $isOnline = $user->last_activity > $onlineDuration;

            return [
                'left' => $trades->where('isSide', '0'),
                'right' => $trades->where('isSide', '1'),
                'created_at' => $trades->first()->created_at,
                'user' => $user->name,
                'userid' => $user,
                'isOnline' => $isOnline,
            ];
        });

        return view('dashboard', ['organizedTrades' => $organizedTrades]);
    }


    public function OldTrade()
    {
        $userId = Auth::id();
        $oldtrade = AllTrade::where('user_id', $userId)->get();

        // Extract IDs
        $ids = $oldtrade->pluck('id');

        // Group trades by batch_id and get the earliest creation date for each batch
        $groupedTrades = $oldtrade->groupBy('batch_id')->map(function ($batchTrades) {
            return [
                'left' => $batchTrades->filter(fn ($trade) => intval($trade->isSide) === 0),
                'right' => $batchTrades->filter(fn ($trade) => intval($trade->isSide) === 1),
                'created_at' => $batchTrades->min('created_at'), // Get the earliest creation date in the batch
            ];
        });

        // Convert to a collection and sort by creation date in descending order
        $groupedTrades = $groupedTrades->sortByDesc(function ($batch) {
            return $batch['created_at'];
        });

        // Pass the grouped trades and IDs to the view
        return view('oldtrade', [
            'groupedTrades' => $groupedTrades,
            'ids' => $ids
        ]);
    }


    public function deleteOldTrade($id)
    {
        // Assuming you want to delete the records
        AllTrade::where('batch_id', $id)->delete();
        Comment::where('all_trade_id', $id)->delete();
        return redirect()->back()->with('success', 'Trade deleted successfully');
    }


    public function edit($batchId, $id)
    {
        // Find a trade by both batch_id and id
        $trade = AllTrade::where('batch_id', $batchId)->where('id', $id)->first();



        if (!$trade) {
            return redirect()->back()->with('error', 'Trade not found.');
        }
        return view('trade-edit', compact('trade', 'batchId', 'id'));
    }

    public function update(Request $request, $batchId, $id)
    {
        $trade = AllTrade::where('batch_id', $batchId)->where('id', $id)->first();

        if (!$trade) {
            return redirect()->back()->with('error', 'Trade not found.');
        }

        // Validate and update trade details
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric',
            'p_value' => 'required|numeric',
            'price' => 'required|numeric',
            'isPermanent' => 'required|boolean',
            'isSide' => 'required|boolean',
        ]);

        $trade->name = $request->name;
        $trade->value = $request->value;
        $trade->p_value = $request->p_value;
        $trade->price = $request->price;
        $trade->isPermanent = $request->isPermanent;
        $trade->isSide = $request->isSide;

        $trade->save();

        return redirect()->route('old.trade')->with('success', 'Trade updated successfully.');
    }


    public function IndComment($id)
    {


        // Retrieve all trades for the given batch_id, including comments and user relations
        $allTrades = AllTrade::where('batch_id', $id)->get();



        // Group trades by batch_id
        $tradesByBatch = $allTrades->groupBy('batch_id');

        // Organize trades and gather all comments from all trades within the batch
        $organizedTrades = $tradesByBatch->map(function ($trades) {
            return [
                'left' => $trades->where('isSide', '0'),
                'right' => $trades->where('isSide', '1'),
                'created_at' => $trades->first()->created_at,
                'user_id' => $trades->first()->user->id,
                'user' => $trades->first()->user->name,
                'trades' => $trades->map(function ($trade) {
                    return [
                        'trade' => $trade,
                    ];
                }),
            ];
        });

        // Retrieve comments based on the provided all_trade_id
        $commentid = Comment::where('all_trade_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();


        // Pass the data to the view
        return view('comment', [
            'organizedTrades' => $organizedTrades,
            'batchId' => $id,
            'commentid' => $commentid,
        ]);
    }


    public function storeComment(Request $request, $tradeId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);



        Log::info('upload comment' . $tradeId);

        $trade = AllTrade::where('batch_id', $tradeId)->first();

        Log::info($trade);

        if (!$trade) {
            return redirect()->back()->withErrors('The trade you are commenting on does not exist.');
        }

        Comment::create([
            'user_id' => Auth::id(),
            'all_trade_id' => $tradeId,
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
