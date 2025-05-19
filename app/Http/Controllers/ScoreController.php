<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    public function checkScore(Request $request){
        $reg = $request->query('reg');
        // VALIDATION
        if (!$reg) {
            return response()->json([
                'error' => 'Missing registration number'
            ], 400);
        }
        // https://stackoverflow.com/questions/18683444/detect-if-a-string-contains-any-numbers
        if (!ctype_digit($reg) || strlen($reg) != 8)
            return response()->json([
                'error' => 'Registration number is not valid'
            ], 400);
        
        // QUERY
        $scores = Score::where('uid', $reg)->get();
        if ($scores->isEmpty())
            return response()->json([
                'error' => 'Registration number not found',
                'debug' => "Received ID: $reg",
            ], 404);
        return response()->json($scores);
    }
}
