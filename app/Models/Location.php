<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    public $table = 'location';
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

}
