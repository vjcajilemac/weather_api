<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{


    public function comment($id, Request $request){
        $found_registration = Registration::find($id);
        if(!$found_registration){
            return response([
                'success' => false,
                'message' => 'No se ha encontrado el registro',
                'data'    => [],
            ], 404);
        }
        $found_registration->comments()->create([
            'content' => $request->content,
            'user_id' => 1
        ]);

        return response([
            'success' => true,
            'message' => 'Comentario agregado correctamente.',
            'data'    => [],
        ]);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
