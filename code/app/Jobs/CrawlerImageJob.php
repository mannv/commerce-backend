<?php

namespace App\Jobs;

use App\Repositories\ProductGroupImageRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CrawlerImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(ProductGroupImageRepository $repository)
    {
        $image = $this->data['image'];

        $urlPart = explode('/', $image);

        $savePath = storage_path('app/public/images/product/' . $urlPart[3]);
        $thumbPath = storage_path('app/public/images/thumb/' . $urlPart[3]);
        if (!File::isDirectory($savePath)) {
            File::makeDirectory($savePath, 0777, true);
        }

        if (!File::isDirectory($thumbPath)) {
            File::makeDirectory($thumbPath, 0777, true);
        }

        $img = Image::make($image);

        $imgName = array_pop($urlPart);

        $img->save($savePath . '/' . $imgName);

        $img->fit(148, 184, function ($constraint) {
            $constraint->upsize();
        });
        $img->save($thumbPath . '/' . $imgName);

        $repository->update([
            'image' => $imgName,
            'is_crawler' => 1
        ], $this->data['id']);
    }
}
