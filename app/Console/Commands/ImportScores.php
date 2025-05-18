<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Score;

class ImportScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-scores {file=./data/diem_thi_thpt_2024.csv} {--batch=10000}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import scores from csv file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file');
        $batch_size = (int) $this->option('batch');
        if (!file_exists($file)) {
            $this->error("$file not found.");
            return 1;
        }
        $this->info("Importing $file");
    
        $handle = fopen($file, 'r');
        $headers = fgetcsv($handle);

        $batch = [];
        $count = 0;

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($headers, $row);
            $uid = $data['sbd'];
            if ($data['ma_ngoai_ngu'] === "")
                $foreign_language_id = null;
            else
                $foreign_language_id = $data['ma_ngoai_ngu'];

            foreach ($headers as $subject) {
                if ($subject == 'sbd') continue;
                $score = $data[$subject];
                if ($score === '' || !is_numeric($score)) continue;
                $score = floatval($score);
                $batch[] = [
                    'uid' => $uid,
                    'subject' => $subject,
                    'score' => $score,
                    'foreign_language_id' => $foreign_language_id,
                ];
            }

            if (count($batch) >= $batch_size) {
                $count += count($batch);
                Score::insert($batch);
                $this->info("$count lines added");
                $batch = [];
            }
        }
        if (count($batch) > 0) {
            $count += count($batch);
            Score::insert($batch);
            $this->info("$count lines added");
            $batch = [];
        }
    }
}
