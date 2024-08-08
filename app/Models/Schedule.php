<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = "schedule";
    protected $fillable = ['location_id', 'user_id', 'activity_id', 'remarks', 'class_id', 'time_from', 'time_to', 'date'];
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
    public function class()
    {
        return $this->belongsTo(Grade::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
