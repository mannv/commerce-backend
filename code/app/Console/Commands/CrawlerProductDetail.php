<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerProductJob;
use App\Repositories\ProductRepository;
use Illuminate\Console\Command;

class CrawlerProductDetail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:product-detail';

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

    public function handle(ProductRepository $productRepository)
    {
        $result = $productRepository->findWhere(['is_crawler' => false]);
        if (empty($result['data'])) {
            $this->error('Khong co du lieu de chay');
            return;
        }

        foreach ($result['data'] as $item) {
            CrawlerProductJob::dispatch($item['id'])->onQueue('crawler_job');
        }
    }

}
