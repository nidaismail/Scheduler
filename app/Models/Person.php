<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    public $table = 'persons';
    public $incrementing = false;
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
