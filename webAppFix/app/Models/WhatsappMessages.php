<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMessages extends Model
{
    use HasFactory;

    protected $table = 'whastapp_messages';
    
    protected $fillable = [
        'sender',
        'content',
    ];
}
