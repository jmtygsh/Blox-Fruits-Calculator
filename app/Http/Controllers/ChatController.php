<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Models\User;
use App\Models\Message;


class ChatController extends Controller
{

    public function chatID($id)
    {
        // Get the authenticated user ID
        $sender_id = auth()->id();

        if (Auth::check()) {
            $authUser = Auth::user();
            User::where('id', $authUser->id)->update(['last_activity' => now()]);
        }

        $lastActivity = User::where('id', $id)->value('last_activity');
        $onlineDuration = now()->subMinutes(1);
        $isOnline = $lastActivity > $onlineDuration;

        // Retrieve messages between the authenticated user and the selected receiver
        $messages = Message::where(function ($query) use ($sender_id, $id) {
            $query->where('sender_id', $sender_id)->where('receiver_id', $id);
        })->orWhere(function ($query) use ($sender_id, $id) {
            $query->where('sender_id', $id)->where('receiver_id', $sender_id);
        })->with(['sender:id,name', 'receiver:id,name']) // Eager load only 'id' and 'name'
            ->get();

        $otherUser = User::find($id)->name;

        // Pass the messages and other user's data to the view
        return view('chatlive', compact('id', 'messages', 'otherUser', 'isOnline'));
    }


    public function messages(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Get the authenticated user ID
        $senderId = auth()->id();

        // Receiver ID is passed as a parameter
        $receiverId = $id;

        // Create and save the new message
        try {
            $chatMessage = new Message();
            $chatMessage->sender_id = $senderId;
            $chatMessage->receiver_id = $receiverId;
            $chatMessage->message = $validatedData['message'];
            $chatMessage->save();


            // Log::info('Broadcasting MessageSent event', ['message' => $chatMessage->message]);
            broadcast(new MessageSent($chatMessage))->toOthers();
            ob_clean();

            return response()->json(['success' => true, 'chat' => $validatedData['message'], 'message' => 'Message sent successfully!']);
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Message saving failed: ' . $e->getMessage());

            // Return a JSON response indicating failure
            return response()->json([
                'success' => false,
                'message' => 'Failed to send the message. Please try again.'
            ], 500); // Return a 500 internal server error status
        }
    }

    public function chatDashboard(Request $request)
    {
        $authId = auth()->id();
    
        // Retrieve search and filter inputs
        $search = $request->input('search');
        $filter = $request->input('filter');
    
        // Fetch the latest messages from each sender where the receiver_id matches the authenticated user's ID
        $messagesQuery = Message::where('receiver_id', $authId)
            ->with('sender:id,name,last_activity');
    
        // Apply search filter
        if (!empty($search)) {
            $messagesQuery->whereHas('sender', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->orWhere('message', 'like', '%' . $search . '%');
        }
    
        // Apply sorting filter
        if ($filter === 'oldest') {
            $messagesQuery->orderBy('created_at', 'asc');
        } else {
            $messagesQuery->orderBy('created_at', 'desc');
        }
    
        // Get the results and ensure uniqueness
        $messages = $messagesQuery->get()->unique('sender_id');
    
        // Map sender IDs to their message creation dates
        $senderInfo = $messages->mapWithKeys(function ($message) {
            return [
                $message->sender_id => [
                    'messageDate' => $message->created_at->format('d M Y')  // Format the date
                ]
            ];
        });
    
        $messageDates = $senderInfo->pluck('messageDate');
    
        // Pass data to the view
        return view('messages', [
            'messages' => $messages,
            'authId' => $authId,
            'messageDates' => $messageDates
        ]);
    }


    public function deleteOldMessages()
    {
        // Get the date 30 days ago from now
        $dateThreshold = now()->subDays(30);

        // Find messages older than 30 days
        $messages = Message::where('created_at', '<', $dateThreshold)->get();

        // Delete each old message and log its details
        foreach ($messages as $message) {
            // Log the message details
            Log::info('Deleting message:', [$message]);
            // Delete the message
            $message->delete();
        }
        
        return redirect()->back();
    }

    
}
