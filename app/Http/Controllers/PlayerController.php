<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Http\Resources\PlayerCollection;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use Exception;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $queryData = Player :: all();
            $formattedData = new PlayerCollection($queryData);
            return response()-> json([
                "message" => "success",
                "data" =>$formattedData
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
            
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request)
    {
        $validatedRequest = $request->validated();
        try {
            $queryData = Player :: create($validatedRequest);
            $formattedData = new PlayerResource($queryData);
            return response()-> json([
                "message" => "success",
                "data" =>$formattedData
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $queryData = Player :: findOrFail($id);
            $formattedData = new PlayerResource($queryData);
            return response()-> json([
                "message" => "success",
                "data" =>$formattedData
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, string $id)
    {
        $validatedRequest = $request->validated();
        try {
            $queryData = Player :: findOrFail($id);
            $queryData->update($validatedRequest);
            $queryData->save();
            $formattedData = new PlayerResource($queryData);
            return response()-> json([
                "message" => "success",
                "data" =>$formattedData
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $queryData = Player :: findOrFail($id);
            $queryData->delete();
            $formattedData = new PlayerResource($queryData);
            return response()-> json( [
                "message" => "success",
                "data" =>$formattedData
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
            
        }
    }
}
