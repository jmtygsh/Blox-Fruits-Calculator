<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'all_trade_id', 'comment']; // Correct fillable fields

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allTrade()
    {
        return $this->belongsTo(AllTrade::class, 'all_trade_id', 'batch_id'); // Correct foreign key and local key
    }
}
