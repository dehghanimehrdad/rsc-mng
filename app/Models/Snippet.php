<?php

namespace App\Models;

use App\Traits\Resourceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * App\Models\Snippet
 *
 * @property int $id
 * @property string $content
 * @property string $type
 */
class Snippet extends Resource
{
    use HasFactory, Resourceable;

    public $timestamps = false;


}
