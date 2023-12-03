<?php

namespace App\Console\Commands;

use App\Services\ArticleService;
use Illuminate\Console\Command;

class UpdateNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-news-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from different sources and update the article table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $articleService = new ArticleService;
        $articleService->dailyUpdate();
        return;
    }
}
