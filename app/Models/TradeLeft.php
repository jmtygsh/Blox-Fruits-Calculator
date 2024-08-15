<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeLeft extends Model
{
    use HasFactory;


    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'trade-left';

    // Specify the fillable fields to allow mass assignment
    protected $fillable = [
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

    // Optionally, define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
