<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'place_id', 'adm_area1', 'adm_area2', 'country', 'lat', 'lon', 'type', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];
    public function __construct(array $attributes = [])
    {

        parent::__construct($attributes);
        if(count($attributes)>0){
            $this->attributes['name'] = $attributes['name'];
            $this->attributes['place_id'] = $attributes['place_id'];
            $this->attributes['adm_area1'] = $attributes['adm_area1'];
            $this->attributes['adm_area2'] = $attributes['adm_area2'];
            $this->attributes['country'] = $attributes['country'];
            $this->attributes['lat'] = $attributes['lat'];
            $this->attributes['lon'] = $attributes['lon'];
            $this->attributes['type'] = $attributes['type'];

        }


    }

    public function weathers(): HasMany
    {
        return $this->hasMany(Weather::class);
    }
}
