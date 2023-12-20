<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Resources\TeamCollection;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $queryData = Team :: all();
            $formattedData = new TeamCollection($queryData);
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
    public function store(StoreTeamRequest $request)
    {
        $validatedRequest = $request->validated();
        try {
            $queryData = Team :: create($validatedRequest);
            $formattedData = new TeamResource($queryData);
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
            $queryData = Team :: findOrFail($id);
            $formattedData = new TeamResource($queryData);
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
    public function update(UpdateTeamRequest $request, string $id)
    {
        $validatedRequest = $request->validated();
        try {
            $queryData = Team :: findOrFail($id);
            $queryData->update($validatedRequest);
            $queryData->save();
            $formattedData = new TeamResource($queryData);
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
            $queryData = Team :: findOrFail($id);
            $queryData->delete();
            $formattedData = new TeamResource($queryData);
            return response()-> json( [
                "message" => "success",
                "data" =>$formattedData
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
            
        }
    }
}
