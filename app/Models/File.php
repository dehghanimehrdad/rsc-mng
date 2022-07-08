<?php

namespace App\Models;

use App\Traits\Resourceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * App\Models\File
 *
 * @property int $id
 * @property string $disk
 * @property string $path
 */
class File extends Resource
{
    use HasFactory, Resourceable;
    public $timestamps = false;

}
