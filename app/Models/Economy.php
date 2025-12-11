<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Economy extends Model
{
    use HasFactory;

    public $timestamps = false;

    // Explicitly set table name if pluralization is tricky, though 'economies' is standard.
    protected $table = 'economies';

    protected $fillable = ['country_id', 'year', 'gdp', 'gdp_per_capita'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
