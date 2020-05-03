<?php


namespace App\Http\Controllers;


use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $result = $this->productRepository->paginate();
        return response()->json($result['data']);
    }
}
