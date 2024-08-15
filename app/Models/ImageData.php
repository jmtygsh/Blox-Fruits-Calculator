<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageData extends Model
{
    use HasFactory;

    // Specify the table if necessary
    protected $table = 'image_data'; // Optional if the naming convention is followed

    // Specify the primary key
    protected $primaryKey = 'image_id'; // Change to your actual primary key name

    // If the primary key is not an incrementing integer
    public $incrementing = false; // Set to true if it's auto-incrementing

    // If the primary key is not an integer type
    protected $keyType = 'int'; // Change to 'string' if it's a string

    protected $fillable = [
        'image',
        'image_name',
        'image_value',
        'image_p_value',
        'price',
    ];
}
