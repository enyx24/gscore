<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public const SUBJECTS = [
        'toan', 'ngu_van', 'ngoai_ngu', 'vat_li', 'hoa_hoc',
        'sinh_hoc', 'lich_su', 'dia_li', 'gdcd'
    ];
    public const LANG_IDS = [
        'N1', 'N2', 'N3', 'N4', 'N5', 'N6', 'N7'
    ];
    public function scoreStats(Request $request)
    {
        $subject = $request->query('subject');

        if (!$subject) {
            return response()->json(['error' => 'Missing subject parameter'], 400);
        }
        if (!in_array($subject, self::SUBJECTS))
            return response()->json(['error' => 'Not a valid subject'], 400);

        if ($subject !== 'ngoai_ngu') {
            $query = "
                SELECT 
                    SUM(CASE WHEN score >= 8 THEN 1 ELSE 0 END) AS level_8_up,
                    SUM(CASE WHEN score >= 6 AND score < 8 THEN 1 ELSE 0 END) AS level_6_8,
                    SUM(CASE WHEN score >= 4 AND score < 6 THEN 1 ELSE 0 END) AS level_4_6,
                    SUM(CASE WHEN score < 4 THEN 1 ELSE 0 END) AS level_below_4
                FROM score
                WHERE subject = ?
            ";

            $result = DB::selectOne($query, [$subject]);

            $stats = [
                'level_8_up' => $result->level_8_up,
                'level_6_8' => $result->level_6_8,
                'level_4_6' => $result->level_4_6,
                'level_below_4' => $result->level_below_4,
            ];
        } else {
            $foreignLangId = $request->query('lang_id');

            if (!$foreignLangId) {
                return response()->json(['error' => 'Missing foreign_language_id for ngoai_ngu'], 400);
            }
            if (!in_array($foreignLangId, self::LANG_IDS)) {
                return response()->json(['error' => 'Not a valid language ID'], 400);
            }


            $query = "
                SELECT 
                    SUM(CASE WHEN score >= 8 THEN 1 ELSE 0 END) AS level_8_up,
                    SUM(CASE WHEN score >= 6 AND score < 8 THEN 1 ELSE 0 END) AS level_6_8,
                    SUM(CASE WHEN score >= 4 AND score < 6 THEN 1 ELSE 0 END) AS level_4_6,
                    SUM(CASE WHEN score < 4 THEN 1 ELSE 0 END) AS level_below_4
                FROM score
                WHERE subject = ? AND foreign_language_id = ?
            ";

            $result = DB::selectOne($query, [$subject, $foreignLangId]);

            $stats = [
                'level_8_up' => $result->level_8_up,
                'level_6_8' => $result->level_6_8,
                'level_4_6' => $result->level_4_6,
                'level_below_4' => $result->level_below_4,
            ];
        }

        return response()->json([
            'subject' => $subject,
            'foreign_language_id' => $foreignLangId ?? null,
            'stats' => $stats
        ]);
    }
}
