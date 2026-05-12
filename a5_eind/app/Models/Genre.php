<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['naam'];

        public function band() {
            return $this->hasMany(Band::class);
        }
}
