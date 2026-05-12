<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

    protected $fillable = ['band_id', 'url'];

    public function band() {
        return $this->belongsTo(Band::class);
    }
}
