<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    public $table = 'grade';
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
