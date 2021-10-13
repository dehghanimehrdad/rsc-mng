<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    const TYPE_HTML = 'html';

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'content'
    ];
}
