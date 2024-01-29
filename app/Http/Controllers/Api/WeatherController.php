<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Place;
use App\Models\Weather;
use App\Models\Registration;

use App\Http\Resources\WeatherCollection;
use App\Http\Resources\WeatherResource;
use App\Http\Resources\CommentCollection;

class WeatherController extends Controller
{
    /**
     * getdata and save it.
     */

    public function index(){
        $weathers = Weather::all();
        

        return response([
			'success' => true,
			'message' => __('Registro creado'),
			'data'    => new WeatherCollection($weathers),
		]);

    }

    public function getComments($id){
        $fount_weathers = Weather::find($id);
        if(!$fount_weathers){
            return response([
                'success' => false,
                'message' =>'El comentario no existe',
                'data'    => [],
            ]);

        }
        
        return response([
			'success' => true,
			'message' =>'Registros encontrados',
			'data'    => new CommentCollection($fount_weathers->comments),
		]);

    }

    

    public function findByPlace(Request $request)
    {

        $place =$request->place;
        
        $new_place = Place::where('place_id', $place['place_id'])->first();
        
        if(!$new_place){

            $new_place = new Place();
            $new_place->name = $place['name'];
            $new_place->place_id = $place['place_id'];
            $new_place->adm_area1 = $place['adm_area1'];
            $new_place->adm_area2 = $place['adm_area2'];
            $new_place->country = $place['country'];
            $new_place->lat = floatval($place['lat']);
            $new_place->lon = floatval($place['lon']);
            $new_place->type = $place['type'];
            $new_place->timezone = $place['timezone'];
            $new_place->save();
        }

        //Llamar a la api del clima
        
        $apiUrl = env('METEOSOURCE_BASE_URL');
        $apiUrl = $apiUrl."/point?key=".env('METEOSOURCE_AUTH_KEY')."&place_id=".$new_place->place_id;
        // Realiza la solicitud HTTP GET
        
        $response = Http::get($apiUrl);

        // Obtiene los datos de la respuesta
            
        $weather_data = $response->json();

        #print_r($weather_data);
        
        //Agregar clima
        
        $new_weather = new Weather();
        $current = $weather_data['current'];
        

        $new_weather->elevation = $weather_data['elevation'];
        $new_weather->units = $weather_data['units'];
        $new_weather->summary = $current['summary'];
        $new_weather->temperature = floatval($current['temperature']);
        $new_weather->cloud_cover = floatval($current['cloud_cover']);
        $new_weather->relative_humidity = $new_weather->temperature * $new_weather->cloud_cover;
        $new_weather->wind = json_encode($current['wind']);
        $new_weather->precipitation = json_encode($current['precipitation']);
        
        $new_weather->place_id= $new_place->id;
        $new_weather->save();


        #save registration

        $new_registration = new Registration();
        $new_registration->title= $current['summary'];
        $new_registration->lat= $new_place['lat'];
        $new_registration->lon= $new_place['lon'];
        $new_registration->save();

        
        return response([
			'success' => true,
			'message' => 'Registro creado',
			'data'    => [],
		], 201);

    }


    public function comment($id, Request $request){
        $found_weather = Weather::find($id);
        if(!$found_weather){
            return response([
                'success' => false,
                'message' => 'No se ha encontrado el registro',
                'data'    => [],
            ], 404);
        }
        $found_weather->comments()->create([
            'content' => $request->content,
            'user_id' => 1,
        ]);

        return response([
            'success' => true,
            'message' => 'Comentario agregado correctamente.',
            'data'    => [],
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Soft delete.
     */
    public function delete(string $id)
    {
        $found_weather= Weather::find($id);
        if(!$found_weather){
            return response([
                'success' => false,
                'message' => 'No se ha encontrado el registro.',
                'data'    => [],
            ], 404);
        }
        $found_weather->delete();
        return response([
            'success' => true,
            'message' => 'Registro eliminado correctamente.',
            'data'    => [],
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
