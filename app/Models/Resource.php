<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Resource
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property MorphTo $resourceable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Resource extends Model
{
    use HasFactory;

    public function resourceable(){
        return $this->morphTo();
    }
}
