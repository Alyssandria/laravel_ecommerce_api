<?php

namespace App\Services;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ProductService {
    /**
     * Fetches product data by ids
     * @return Collection
     */
    static function getProductDataByIds(Collection $ids) {
        $responses = collect(Http::pool(function (Pool $pool) use($ids) {
            return $ids->map(function (int $id) use($pool) {
                return $pool->as($id)->get(config('products.base') . "/${id}");
            })->all();
        }));


        return $responses->mapWithKeys(function (Response $response, int $key) {
            if(!$response->ok()){
                return [$key => null];
            }

            return [$key => $response->json()];
        });
    }

}
