<?php

namespace App\Models;

use App\Traits\Resourceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * App\Models\Link
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property bool $open_in_new_tab
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Link extends Resource
{
    use HasFactory, Resourceable;
    public $timestamps = false;
}
