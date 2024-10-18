<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'data' => $this->collection->transform(function ($product) {
        //         return [
        //             'id' => $product->id,
        //             'name' => $product->name,
        //             'description' => $product->description,
        //             'price' => $product->price,
        //             'stock' => $product->stock,
        //             'imageUrl' => $product->image_url,
        //         ];
        //     }),
        //     'meta' => [
        //         'totalProducts' => $this->collection->count(),
        //     ],
        // ];
        return parent::toArray($request);

    }
}
