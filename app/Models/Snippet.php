<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
