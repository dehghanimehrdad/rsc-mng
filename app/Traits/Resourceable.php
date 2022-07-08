<?php
namespace App\Traits;

use App\Models\Resource;

trait Resourceable{
    public function resource(){
        return $this->morphOne(Resource::class, 'resourceable');
    }
}

