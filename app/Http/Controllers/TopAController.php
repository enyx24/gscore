<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TopAController extends Controller
{
    function getTopKBySubjects(array $subjects, int $k = 10)
    {
        $selects = ['uid'];
        foreach ($subjects as $subject) {
            $selects[] = DB::raw("SUM(CASE WHEN subject = '$subject' THEN score ELSE 0 END) AS $subject");
        }
        $selects[] = DB::raw("SUM(CASE WHEN subject IN ('" . implode("','", $subjects) . "') THEN score ELSE 0 END) AS total_score");

        return DB::table('score')
            ->select(...$selects)
            ->groupBy('uid')
            ->orderByDesc('total_score')
            ->limit($k)
            ->get();
    }
    public function topAStats(Request $request)
    {
        $subjects = ['toan', 'vat_li', 'hoa_hoc'];
        $top_k = 10;
        $result = $this->getTopKBySubjects($subjects, $top_k);
        return response()->json([
            'top10_khoi_a' => $result,
        ]);
    }
}
