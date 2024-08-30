<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHistoryRequest;
use App\Http\Requests\UpdateHistoryRequest;
use App\Models\History;
use App\Models\HistoryUnit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($userId)
    {
        if($userId == Auth()->user()->id){
            return User::where('id', $userId)->first()->latestHistory;
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHistoryRequest $request, $userId)
    {
        $validated = $request->validate([
        // 'file' => 'required|mimes:json',
        'videos' => 'required|array',
        ]);

        $validated = ['user_id' => Auth()->user()->id];

        $history = History::create($validated);




        $videoArr = array_map(function ($video) use ($history) {
                return [
                'history_id' => $history['id'],
                'title' => $video['title'],
                'title_url' => $video['titleUrl'] ?? 'nono',
                'channel' => $video['subtitles'][0]['name'] ?? 'dsdsds',
                'channel_url' => $video['subtitles'][0]['url'] ?? 'saysadu_url',
                'time' => $video['time'],
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
                
            ];
        }, $request['videos']);
        
        $chunks = array_chunk($videoArr, 1000);

        DB::transaction(function () use ($chunks){
            foreach ($chunks as $chunk) {
                DB::table('history_units')->insert($chunk);
            }
        });

        return [
            'matches' => $this->match_history($history),
            'history' => $history,
            'videos' => $history->historyUnits,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHistoryRequest $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        //
    }

    private function match_history($history){ //change to public
        $users = User::all(); // ?Change to UserController?
        $arr = [];
        foreach($users as $user){
            $history_match = $user->latestHistory;
            if($history_match && $history_match->user_id != $history->user_id){
                $matches = $this->compare_video_arrays($history->historyUnits, $history_match->historyUnits);
                $connection = ['user' => $user, 'matches' => $matches];
                array_push($arr, $connection);
            }
        };
        return $arr;
    }

    // private function compare_video_arrays($a, $b){ //change to public
    //     $matches = [];

    //     for($i = 0; $i < 5000; $i++){
    //         for($j = 0; $j < 5000; $j++){
    //             if($a[$i]->title == $b[$j]->title){
    //                 array_push($matches, $a[$i]);
    //             }
    //         }   
    //     }
    //     return $matches;
    // }
    private function compare_video_arrays($a, $b) {
        $matches = ['videos' => [], 'channels' => []];
        $titlesA = [];
        $channelsA = [];

    
        // Build a hash table of titles from array $b
        foreach($a as $video) {
            $titlesA[$video->title_url] = true;
            $channelsA[$video->channel_url] = true;

        }
    
        // Check each video in $a against the hash table
        foreach($b as $video) {
            if (isset($titlesInA[$video->title_url])) {
                array_push($matches['videos'], $video);
            }
            if (isset($channelsA[$video->channel_url])) {
                array_push($matches['channels'], ['channel' => $video->channel, 'vid' => $video]);

            }
        }
    
        return $matches;
    }
    
}
