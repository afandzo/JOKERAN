<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boss extends Model
{
    use HasFactory;
    // public function book() {
    //     return $this->hasMany(Book::class);
    // }

    protected $guarded = ['id'];
}
