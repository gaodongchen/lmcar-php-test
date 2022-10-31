<?php

namespace App\Service;

class ProductHandler
{
    /**
     * 商品总价格
     *
     * @param array $products
     * @return float
     */
    public function getTotalPrice(array $products): float
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $price = floatval($product['price'] ?? 0);
            $totalPrice += $price;
        }
        return $totalPrice;
    }

    /**
     * 商品类型过滤
     *
     * @param array $products
     * @param string $type
     * @return array
     */
    public function filterByType(array $products, string $type): array
    {
        $result = [];
        $type = strtolower($type);
        foreach ($products as $product) {
            if (isset($product['type']) && strtolower($product['type']) == $type) {
                $result[] = $product;
            }
        }
        return $result;
    }

    /**
     * 按价格排序
     *
     * @param array $products
     * @param int $sort 排序方向 SORT_DESC-倒排（默认）;SORT_ASC-正排
     * @return array
     */
    public function sortByPrice(array $products, int $sort=SORT_DESC): array 
    {
        $sortArr = [];
        foreach ($products as $key => $product) {
            $sortArr[$key] = $product['price'];
        }
        array_multisort($sortArr, $sort, $products);
        return $products;
    }

    /**
     * 创建时间转换成时间戳
     *
     * @param array $products
     * @return array
     */
    public function createAtToTimestamp(array $products): array
    {
        foreach ($products as $key => $product) {
            $timestamp = strtotime($product['create_at']);
            $products[$key]['create_at'] = $timestamp;
        }
        return $products;
    }
}