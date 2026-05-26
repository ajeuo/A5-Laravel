<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

    protected $fillable = ['band_id', 'url'];

    public function band() {
        return $this->belongsTo(Band::class);
    }

    public function getEmbedUrl() {
        preg_match('/(?:youtu\.be\/|v=)([a-zA-Z0-9_-]+)/', $this->url, $matches);
        return 'https://www.youtube.com/embed/' . $matches[1];
    }
}
