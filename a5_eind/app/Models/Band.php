<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    protected $fillable = [ 'naam', 'beschrijving', 'biografie', 'foto', 'achtergrondkleur', 'tekstkleur', 'genre_id' ];

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function videos() {
        return $this->hasMany(Video::class);
    }
}
