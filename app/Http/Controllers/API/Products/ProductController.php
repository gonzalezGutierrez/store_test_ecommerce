<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Services\Products\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(ProductService $productService): \App\Http\Resources\Products\ProductCollection
    {
        return $productService->getAll();
    }

    public function search(ProductService $productService)
    {
        return $productService->search();
    }

    public function sort(ProductService $productService)
    {
        return $productService->sort();
    }

    public function store(ProductStoreRequest $request,ProductService $productService): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();
        return $productService->store($validatedData);
    }

    public function show(ProductService $productService,$id): \App\Http\Resources\Products\ProductResource
    {
        return $productService->getOne($id);
    }

    public function update(ProductStoreRequest $request,ProductService $productService,$id): \Illuminate\Http\JsonResponse
    {
        $validatedData  = $request->validated();
        return $productService->update($validatedData,$id);
    }

    public function destroy(ProductService $productService,$id): \Illuminate\Http\JsonResponse
    {
        return $productService->destroy($id);
    }

}
