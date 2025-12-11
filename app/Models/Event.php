<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['country_id', 'description', 'date'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
