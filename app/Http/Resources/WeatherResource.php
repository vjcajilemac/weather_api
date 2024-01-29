<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "fahrenheit_temperature"=> $this->fahrenheit_temperature,
            "elevation"=> $this->elevation,
            "units"=> $this->units,
            "summary"=> $this->summary,
            "relative_humidity"=> $this->relative_humidity,
            "wind"=> $this->wind,
            "precipitation"=> $this->precipitation,
            "cloud_cover"=> $this->cloud_cover,
            "place"=> $this->place,
            "comments" => $this->comments,


        ];
    }
}
