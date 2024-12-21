<?php

namespace App\Http\Controllers;

use App\Services\ProductsServices;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected ProductsServices $productsServices;

    public function __construct(ProductsServices $productsServices){
        $this->productsServices = $productsServices;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     *
     * Отримає список всіх продуктів
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->productsServices->getProducts($request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Створює один продукт
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->productsServices->createProducts($request->all());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * Отримує один продукт
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        return $this->productsServices->showProducts($id);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * Оновлює один продукт
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        return $this->productsServices->updateProducts($request->all(), $id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * Видаляє один продукт
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        return $this->productsServices->deleteProducts($id);
    }
}
