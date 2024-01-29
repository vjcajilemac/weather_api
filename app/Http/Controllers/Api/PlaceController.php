<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function searchPlaces(Request $request)
    {
        try{

            $apiUrl = env('METEOSOURCE_BASE_URL');
            $apiUrl = $apiUrl."/find_places?key=".env('METEOSOURCE_AUTH_KEY')."&text=".$request->text;

            $response = Http::get($apiUrl);

            $data = $response->json();


            return response([
                'success' => true,
                'message' => 'Registro creado',
                'data'    => $data,
            ], 201);

        } catch (Exception $e) {
            return $this->sendError($e , $e->getMessage(), 400);
        }
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
