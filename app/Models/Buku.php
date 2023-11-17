<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = ['id', 'judul', 'penulis', 'harga', 'tgl_terbit', 'created_at', 'updated_at', 'filename', 'filepath'];

    protected $dates = ['tgl_terbit'];

    public function galleries()
{
    return $this->hasMany(Gallery::class);
}

    public function photos()
    {
        return $this->hasMany('App\Models\Buku', 'id', 'id');
    }
}