<?php

namespace App\Models;

use App\Traits\Resourceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * App\Models\File
 *
 * @property int $id
 * @property string $title
 * @property string $disk
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class File extends Resource
{
    use HasFactory, Resourceable;
    public $timestamps = false;

}
