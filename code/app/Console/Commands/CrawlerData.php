<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrawlerData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lay du lieu cua trang https://marc.com.vn/';

    private $domain = 'https://marc.com.vn';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $totalPage = 15;
        for ($i = 1; $i <= $totalPage; $i++) {
            $this->getProducts($i);
        }
    }

    public function getProducts($page)
    {
        $url = $this->domain . '/collections/all?page=' . $page;
        $html = file_get_html($url);
        $products = $html->find('.product-detail');
        if (empty($products)) {
            return;
        }
        $data = [];
        foreach ($products as $pro) {
            $hyperLink = $pro->find('a', 0);
            $data[] = [
                'name' => trim($hyperLink->plaintext),
                'url' => $this->domain . trim($hyperLink->href),
            ];
        }
        echo '<pre>' . print_r($data, true) . '</pre>';
        die;

        $this->info('crawler products page: ' . $page);
    }
}
