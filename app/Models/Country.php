<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // Disable timestamps as they are not in the schema
    public $timestamps = false;

    protected $fillable = ['name', 'capital', 'population', 'area'];

    // 1:N Relationship with Events
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // 1:N Relationship with Economies
    public function economies()
    {
        return $this->hasMany(Economy::class);
    }

    // M:N Relationship with other Countries (Partners) via trade_turnovers
    // Since this is a self-referencing M:N, it's tricky.
    // A country can be country_id1 OR country_id2.
    // We will define it as 'partnersWhereImFirst' and 'partnersWhereImSecond' and maybe a merged accessor if needed,
    // or just assume for now we define one direction for simplicity, or try to merge them.
    // However, standard Laravel `belongsToMany` expects a single foreign key direction.
    
    // Simplest approach for "Partners":
    public function partnersFromFirst()
    {
        return $this->belongsToMany(Country::class, 'trade_turnovers', 'country_id1', 'country_id2')
                    ->withPivot(['year', 'export_c1_to_c2', 'export_c2_to_c1']);
    }

    public function partnersFromSecond()
    {
        return $this->belongsToMany(Country::class, 'trade_turnovers', 'country_id2', 'country_id1')
                    ->withPivot(['year', 'export_c1_to_c2', 'export_c2_to_c1']);
    }

    // Helper to get all partners
    public function getPartnersAttribute()
    {
        return $this->partnersFromFirst->merge($this->partnersFromSecond);
    }
}
