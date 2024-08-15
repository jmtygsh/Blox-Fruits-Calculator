<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllTrade extends Model
{
    use HasFactory;

    protected $table = 'all-trade';

    protected $fillable = [
        'batch_id',
        'image',
        'user_id',
        'card_id',
        'name',
        'value',
        'p_value',
        'price',
        'isPermanent',
        'isSide',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'all_trade_id', 'batch_id'); // Match the foreign key and local key
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
