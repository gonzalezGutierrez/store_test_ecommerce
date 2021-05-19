<?php


namespace App\Services\Products;


use App\Http\Resources\Products\ProductCollection;
use App\Http\Resources\Products\ProductResource;
use App\Models\Product;
use App\Services\BaseServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ProductService implements  BaseServiceInterface
{
    
    public function getAll(): ProductCollection
    {
        $products = Product::where('status',1)
            ->orderBy('id','DESC')
            ->paginate(10);

        return new ProductCollection($products);
    }

    public function getOne($id): ProductResource
    {
        $product = Product::where('id',$id)->first();
        return new ProductResource($product);
    }

    public function store($request): \Illuminate\Http\JsonResponse
    {
        $request['slug'] = $this->generateSlug($request['name']);

        Product::create($request);

        return response()->json('Product saved successfully',Response::HTTP_CREATED);
    }

    public function update($request, $id): \Illuminate\Http\JsonResponse
    {
        $request['slug'] = $this->generateSlug($request['name']);

        $product = Product::where('id',$id)->first();

        Product::update($request);

        return response()->json('Product updated successfully',Response::HTTP_OK);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {

        $product = Product::where('id',$id)->first();

        $product->update(['status'=>0]);

        return response()->json('Product deleted successfully',Response::HTTP_OK);

    }

    private function generateSlug($name): string
    {
        $slug = Str::slug($name);
        $newSlug = $slug;
        $next = 2;

        while (Product::IssetSlug($newSlug))
        {
            $newSlug = $slug . '-' . $next;
            $next++;
        }

        return $newSlug;
    }
}
