<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerImageJob;
use App\Repositories\ProductGroupImageRepository;
use Illuminate\Console\Command;

class CrawlerImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(ProductGroupImageRepository $repository)
    {
        $result = $repository->findWhere(['is_crawler' => false]);
        if (empty($result['data'])) {
            $this->error('Khong con du lieu de chay');
            return;
        }
        foreach ($result['data'] as $item) {
            CrawlerImageJob::dispatch($item)->onQueue('crawler_image');
        }

    }
}
