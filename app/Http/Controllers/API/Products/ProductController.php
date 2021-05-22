<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Services\Products\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(ProductService $productService): \App\Http\Resources\Products\ProductCollection
    {
        return $productService->getAll();
    }

    public function search(ProductService $productService): \App\Http\Resources\Products\ProductCollection
    {
        return $productService->search();
    }

    public function sort(ProductService $productService): \App\Http\Resources\Products\ProductCollection
    {
        return $productService->sort();
    }

    public function store(ProductStoreRequest $request,ProductService $productService): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();
        return $productService->store($validatedData);
    }

    public function show(ProductService $productService,$id,$slug): \App\Http\Resources\Products\ProductResource
    {
        return $productService->getOne($id);
    }

    public function update(ProductUpdateRequest $request,ProductService $productService,$id): \Illuminate\Http\JsonResponse
    {
        $validatedData  = $request->validated();
        return $productService->update($validatedData,$id);
    }

    public function destroy(ProductService $productService,$id): \Illuminate\Http\JsonResponse
    {
        return $productService->destroy($id);
    }

}
