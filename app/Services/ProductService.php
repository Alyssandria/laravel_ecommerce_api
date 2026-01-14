<?php

namespace App\Services;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ProductService {
    /**
     * Fetches product data by ids
     * @return Collection
     */

    public string $base;

    public function __construct(){
        $this->base = config('products.base');
    }

    public function categories(): JsonResponse {
        $response = Http::get($this->base . "/categories");

        if(!$response->ok()){
            return response()->json([
                'success' => false,
                'message' => "Something went wrong, please try again later",
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => "Categories retrieved successfully",
            'data' => collect($response->json())->map(function (array $category) {
                return [
                    'name' => $category['name'],
                    'slug' => $category['slug']
                ];
            })
        ]);

    }
    /**
     * @param array<int,mixed> $params
     */
    public function get(int $productId, array $params): JsonResponse {
        $query = [
            'select' => isset($params['select']) ? $params['select'] : null,
        ];

        $response = Http::get($this->base . "/{$productId}", $query);

        if(!$response->ok() and !$response->notFound()){
            return response()->json([
                'success' => false,
                'message' =>  'Something went wrong, please try again later'
            ], 500);
        }

        if($response->notFound()){
            return response()->json([
                'success' => false,
                'message' =>  'Specific product cannot be found',
                'product_id' => $productId
            ], $response->status());
        }

        return response()->json([
            'success' => true,
            'message' => "Product successfully retrieved",
            'data' => $response->json()
        ]);
    }
    /**
     * @param Collection<array-key,mixed> $ids
     */
    public function getProductDataByIds(Collection $ids) {
        $responses = collect(Http::pool(function (Pool $pool) use($ids) {
            return $ids->map(function (int $id) use($pool) {
                return $pool->as($id)->get(self::$base . "${id}");
            })->all();
        }));


        return $responses->mapWithKeys(function (Response $response, int $key) {
            if(!$response->ok()){
                return [$key => null];
            }

            return [$key => $response->json()];
        });
    }
    /**
     * @param array<int,mixed> $params
     */
    public function getMany(array $params): JsonResponse {
        $query = [
            'limit' => isset($params['limit']) ? $params['limit'] : null,
            'skip' => isset($params['skip']) ? $params['skip'] : null,
            'sortBy' => isset($params['sortBy']) ? $params['sortBy'] : null,
            'order' => isset($params['order']) ? $params['order'] : null,
            'select' => isset($params['select']) ? $params['select'] : null,
        ];

        $uri = "";
        if (isset($params['search'])) {
            $uri = $this->base . "/search";
            $query['q'] = $params['search'];
        } else {
            $uri = $this->base;
        }

        $response = Http::get($uri, $query);

        // TODO: Handle 500 error better
        if(!$response->ok()){
            return response()->json([
                'success' => false,
                'message' => "Something went wrong, please try again later",
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => "Products successfully retrieved",
            'data' => $response->json()
        ]);
    }
    /**
     * @param array<int,mixed> $params
     */
    public function getManyByCategory(string $category, array $params): JsonResponse {
        $query = [
            'limit' => isset($params['limit']) ? $params['limit'] : null,
            'skip' => isset($params['skip']) ? $params['skip'] : null,
            'sortBy' => isset($params['sortBy']) ? $params['sortBy'] : null,
            'order' => isset($params['order']) ? $params['order'] : null,
            'select' => isset($params['select']) ? $params['select'] : null,
        ];


        $uri = "";
        if (isset($params['search'])) {
            $uri = $this->base . "/search";
            $query['q'] = $params['search'];
        } else {
            $uri = $this->base . "/category/{$category}";
        }

        $response = Http::get($uri, $query);


        // TODO: Handle 500 error better
        if(!$response->ok()){
            return response()->json([
                'success' => false,
                'message' => "Something went wrong, please try again later",
            ], 500);
        }


        $json = collect($response->json());

        if(isset($params['search'])){
            $products = collect($json->get('products'));

            [$inSearch, $notInSearch] = $products->partition(function ($product) use ($category) {
                return $product['category'] === $category;
            });

            return response()->json([
                'success' => true,
                'message' => "Products successfully retrieved",
                'data' => [
                    'in_category' => $inSearch,
                    'not_in_category' => $notInSearch,
                    'total' => $json->get('total'),
                    'skip' => $json->get('skip'),
                    'limit' => $json->get('limit'),
                ]
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "Products successfully retrieved",
            'data' => $json
        ]);


    }
}
