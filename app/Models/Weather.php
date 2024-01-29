<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\SoftDeletes;

class Weather extends Model
{
    protected $table = "weathers";
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['elevation', 'units', 'summary', 'temperature', 'relative_humidity', 'wind', 'precipitation','cloud_cover', 'place_id'];
    protected $appends = ['fahrenheit_temperature'];
    protected $dates = ['deleted_at'];
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    
    
    public function getFahrenheitTemperatureAttribute()
    {
        // Accede al atributo 'temperatura_celsius' y realiza la conversión a Fahrenheit
        // Supongamos que 'temperatura_celsius' es un atributo real en tu modelo

        $cls_temperature = $this->attributes['temperature'];

        if ($cls_temperature) {
            // Realiza la conversión a Fahrenheit
            $fahrenheit_temperature = ($cls_temperature * 9 / 5) + 32;

            return $fahrenheit_temperature;
        }

        return null;
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
