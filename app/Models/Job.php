<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function boss()
    {
        return $this->belongsTo(Boss::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(JobDetail::class);
    }

}
