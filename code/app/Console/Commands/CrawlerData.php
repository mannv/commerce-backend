<?php

namespace App\Console\Commands;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
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
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $categories = [
            [
                'name' => 'Áo kiểu',
                'url' => 'https://marc.com.vn/collections/ao-kieu',
                'totalPage' => 3
            ],
            [
                'name' => 'Áo thun',
                'url' => 'https://marc.com.vn/collections/ao-thun-nu',
                'totalPage' => 2
            ],
            [
                'name' => 'Đầm',
                'url' => 'https://marc.com.vn/collections/dam',
                'totalPage' => 7
            ],
            [
                'name' => 'Quần',
                'url' => 'https://marc.com.vn/collections/quan',
                'totalPage' => 2
            ],
            [
                'name' => 'Váy',
                'url' => 'https://marc.com.vn/collections/vay',
                'totalPage' => 2
            ],
            [
                'name' => 'Phụ kiện',
                'url' => 'https://marc.com.vn/collections/phu-kien',
                'totalPage' => 1
            ],
            [
                'name' => 'Đồ bơi/đồ lót',
                'url' => 'https://marc.com.vn/collections/do-boi',
                'totalPage' => 1
            ]
        ];


        foreach ($categories as $item) {
            $cate = $categoryRepository->create(['name' => $item['name']]);
            for ($i = 1; $i <= $item['totalPage']; $i++) {
                $this->getProducts($item['url'], $i , $cate['data']['id']);
            }
        }
    }

    public function getProducts($url, $page, $cateId)
    {
        $url .= '?page=' . $page;
        $html = file_get_html($url);
        $products = $html->find('.product-detail');
        if (empty($products)) {
            return;
        }
        $values = [];
        foreach ($products as $pro) {
            $hyperLink = $pro->find('a', 0);
            $values[] = [
                'cate_id' => $cateId,
                'name' => trim($hyperLink->plaintext),
                'crawler_url' => $this->domain . trim($hyperLink->href),
            ];
        }
        $this->productRepository->addMulti($values);
        $this->info('crawler products page: ' . $page);
    }
}
