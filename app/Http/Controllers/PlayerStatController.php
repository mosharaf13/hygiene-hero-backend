<?php

namespace App\Http\Controllers;

use App\Models\PlayerStat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class PlayerStatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PlayerStat::all();
    }

    public function latest($playerId)
    {
        return PlayerStat::where('player_id', $playerId)->latest()->first();
    }

    public function threshold($playerId)
    {
        $threshold = PlayerStat::where('player_id', $playerId)
            ->orderBy('created_at', 'asc')
            ->limit(3)
            ->get()
            ->avg('heartbeat');

        return $threshold + 5;
    }

    public function store(Request $request)
    {
        // Validate the request data as needed
        $request->validate([
            'heartbeat' => 'required|string',
            'player_id' => 'required|string',
        ]);

        PlayerStat::create([
            'heartbeat' => $request->input('heartbeat'),
            'level_id' => $request->input('level_id', 0),
            'player_id' => $request->input('player_id'),
            'version_id' => $request->input('version_id', 0),
            'score' => $request->input('score', 0),
            'play_session_count' => $request->input('play_session_count', 0),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Optionally, you can return a response to indicate success
        return response()->json(['message' => 'Heartbeat record created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return PlayerStat::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        PlayerStat::where('id', $id)
            ->update([
                'player_score' => $request->input('player_score', null),
                'variation' => $request->input('variation', null),
            ]);

        // Optionally, you can return a response to indicate success
        return response()->json(['message' => 'Heartbeat record updated successfully'], 201);
    }

    public function getNextPlayerId()
    {
        $playerId = Cache::get('player_id');
        if (!$playerId) {
            $highestPlayerId = PlayerStat::max('player_id') ?? 0;
            $playerId = $highestPlayerId + 1;
            Cache::put('player_id', $playerId, 60);
        } else {
            $playerId++;
            Cache::put('player_id', $playerId, 60);
        }

        return $playerId;
    }



}
