<?php

namespace App\Models;

use App\Traits\Resourceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Link
 *
 * @property int $id
 * @property string $url
 * @property bool $open_in_new_tab
 */
class Link extends Resource
{
    use HasFactory, Resourceable;
    public $timestamps = false;
}
