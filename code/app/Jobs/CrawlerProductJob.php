<?php

namespace App\Jobs;

use App\Repositories\ColorRepository;
use App\Repositories\ProductGroupImageRepository;
use App\Repositories\ProductGroupRepository;
use App\Repositories\ProductGroupSizeRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SizeRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CrawlerProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $pid = 0;

    public function __construct(int $pid)
    {
        $this->pid = $pid;
    }

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var ColorRepository
     */
    private $colorRepository;

    /**
     * @var ProductGroupRepository
     */
    private $productGroupRepository;

    /**
     * @var ProductGroupImageRepository
     */
    private $productGroupImageRepository;

    /**
     * @var SizeRepository
     */
    private $sizeRepository;

    /**
     * @var ProductGroupSizeRepository
     */
    private $productGroupSizeRepository;

    public function handle(
        ProductRepository $productRepository,
        ColorRepository $colorRepository,
        ProductGroupRepository $productGroupRepository,
        ProductGroupImageRepository $productGroupImageRepository,
        SizeRepository $sizeRepository,
        ProductGroupSizeRepository $productGroupSizeRepository
    ) {
        $this->productRepository = $productRepository;
        $this->colorRepository = $colorRepository;
        $this->productGroupRepository = $productGroupRepository;
        $this->productGroupImageRepository = $productGroupImageRepository;
        $this->sizeRepository = $sizeRepository;
        $this->productGroupSizeRepository = $productGroupSizeRepository;

        $product = $this->productRepository->find($this->pid);

        try {
            DB::beginTransaction();
            $html = file_get_html($product['data']['crawler_url']);

            $matches = null;
            $pattern = '#product:(.*?)onVariantSelected#m';
            preg_match_all($pattern, $html, $matches);
            if (empty($matches[1])) {
                return;
            }

            $json = trim(trim($matches[1][0], ' '), ',');
            $data = json_decode($json, true);


            $html = str_get_html($html);
            $imageResult = $html->find('.product-thumb');
            $colorOption = 'data-option';
            $images = [];
            foreach ($imageResult as $img) {
                $attr = $img->{$colorOption};
                if (empty($attr)) {
                    continue;
                }
                $images[$attr][] = trim($img->find('.product-image-feature', 0)->src);
            }


            $colors = [];
            foreach ($data['variants'] as $item) {
                $colors[$item['option1']]['sizes'][] = $item;
            }

            $colors = collect($colors)->map(function ($item) use ($images) {
                $color = Str::slug($item['sizes'][0]['option1']);
                $item['images'] = $images[$color] ?? [];
                return $item;
            })->all();


            foreach ($colors as $colorName => $colorInfo) {
                $this->insertProductGroup(trim($colorName), $colorInfo);
            }

            $productData = [
                'price' => $data['price_max'] / 100,
                'old_price' => $data['compare_at_price_max'] / 100,
                'description' => $data['description'],
                'is_crawler' => true
            ];

            $this->productRepository->update($productData, $this->pid);
            DB::commit();
        } catch (\Exception $exception) {
            app('log')->error($exception);
            DB::rollBack();
        }
    }

    private function insertProductGroup($colorName, $data)
    {
        $result = app(ColorRepository::class)->getByName($colorName);
        if (empty($result['data'])) {
            $color = $this->makeColor($colorName);
        } else {
            $color = $result['data'];
        }

        $colorId = $color['id'];
        $productGroup = $this->productGroupRepository->create(['product_id' => $this->pid, 'color_id' => $colorId]);
        $productGroupId = $productGroup['data']['id'];
        $this->insertColorImage($productGroupId, $data['images']);

        $values = [];
        foreach ($data['sizes'] as $item) {
            $sizeId = $this->getSizeByName($item['option2']);
            $values[] = [
                'product_group_id' => $productGroupId,
                'size_id' => $sizeId,
                'sku' => $item['sku'],
                'quantity' => $item['inventory_quantity']
            ];
        }
        $this->productGroupSizeRepository->addMulti($values);
    }

    private function getSizeByName($sizeName)
    {
        $size = $this->sizeRepository->getFirst(['name' => $sizeName]);
        if (empty($size['data'])) {
            $size = $this->sizeRepository->create(['name' => $sizeName]);
        }
        return $size['data']['id'];
    }

    private function insertColorImage($productGroupId, $images)
    {
        if (empty($images)) {
            return;
        }
        $values = [];
        foreach ($images as $index => $img) {
            $values[] = [
                'product_group_id' => $productGroupId,
                'image' => $img,
                'cover_image' => $index == 0
            ];
        }
        $this->productGroupImageRepository->addMulti($values);
    }

    private function makeColor($colorName)
    {
        $color = $this->colorRepository->create(['name' => $colorName]);
        return $color['data'];
    }
}
