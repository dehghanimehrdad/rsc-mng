<?php

namespace App\Models;

use App\Traits\Resourceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * App\Models\Snippet
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Snippet extends Resource
{
    use HasFactory, Resourceable;

    public $timestamps = false;


}
