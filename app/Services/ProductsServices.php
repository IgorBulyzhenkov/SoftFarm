<?php

namespace App\Services;

use App\Http\Requests\ProductsPostRequest;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductsServices
{
    /**
     * @return \Illuminate\Http\JsonResponse
     *
     * Повертає список всіх продуктів.
     * Реалізовано фільтр по назві, кількості продукту, мінімальна ціна, максимальна ціна, фільтр по ціні ВІД та ДО
     */
    public function getProducts($request): \Illuminate\Http\JsonResponse
    {
        $query = Products::query();

        if ($request->filled('name')) {
            $query->where('name', 'ILIKE', '%' . $request->input('name') . '%');
        }

        if ($request->filled('count_product')) {
            $query->where('count_product', $request->input('count_product'));
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        if ($request->filled(['price_from', 'price_to'])) {
            $query->whereBetween('price', [
                $request->input('price_from'),
                $request->input('price_to')
            ]);
        }

        return response()->json([
            'status'            => true,
            'message'           => 'Success',
            'data'              => $query->get(),
            'count_products'    => $query->count()
        ],200);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     *
     * Створює один продукт
     */
    public function createProducts($data): \Illuminate\Http\JsonResponse
    {
        try {

            DB::beginTransaction();

            $request = new ProductsPostRequest();

            $rules = $request->rules();

            $validate = Validator::make($data, $rules);

            if($validate->fails()){
                return response()->json([
                    'status'    => false,
                    'message'   => $validate->errors()->getMessages()
                ],400);
            }

            $product = new Products();

            $product->fill($data);
            $product->save();

            DB::commit();

            return response()->json([
                'status'    => true,
                'message'   => 'Success',
                'data'      => $product
            ],201);

        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json([
                'status'            => false,
                'message'           => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * Повертає один продукт
     */
    public function showProducts($id): \Illuminate\Http\JsonResponse
    {
        $product = Products::query()->find($id);

        if(!$product){
            return response()->json([
                'status'    => false,
                'message'   => 'Not found'
            ], 404);
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Success',
            'data'      => $product
        ],200);
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * Оновлює один продукт
     */
    public function updateProducts($data, $id): \Illuminate\Http\JsonResponse
    {
        try {

            DB::beginTransaction();

            $request = new ProductsPostRequest();

            $rules = $request->rules();

            $validate = Validator::make($data, $rules);

            if($validate->fails()){
                return response()->json([
                    'status'    => false,
                    'message'   => $validate->errors()->getMessages()
                ],400);
            }

            $product = Products::query()->find($id);

            if(!$product){
                return response()->json([
                    'status'    => false,
                    'message'   => 'Not found'
                ], 404);
            }

            $product->fill($data);
            $product->update();

            DB::commit();

            return response()->json([
                'status'    => true,
                'message'   => 'Success',
                'data'      => $product
            ],200);

        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json([
                'status'            => false,
                'message'           => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * Видаляє один продукт
     */
    public function deleteProducts($id): \Illuminate\Http\JsonResponse
    {
        $product = Products::query()->find($id);

        if(!$product){
            return response()->json([
                'status'    => false,
                'message'   => 'Not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Deleted successfully'
        ],204);
    }
}
