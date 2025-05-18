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
                'error' => 'Missing reg query parameter'
            ], 400);
        }
        // https://stackoverflow.com/questions/18683444/detect-if-a-string-contains-any-numbers
        if (!ctype_digit($reg) || strlen($reg) != 8)
            return response()->json([
                'error' => 'reg is not a valid id'
            ], 400);
        
        // QUERY
        $score = Score::where('id', $reg)->get();
        if ($score->isEmpty())
            return response()->json([
                'error' => 'ID not found'
            ], 404);
        return response()->json($score);
    }
}
