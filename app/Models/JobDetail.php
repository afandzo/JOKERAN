<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Tambahkan relasi atau method lain sesuai kebutuhan
}
