<?php

namespace Test\Service;

use PHPUnit\Framework\TestCase;
use App\Service\ProductHandler;

/**
 * Class ProductHandlerTest
 */
class ProductHandlerTest extends TestCase
{
    private $products = [
        [
            'id' => 1,
            'name' => 'Coca-cola',
            'type' => 'Drinks',
            'price' => 10,
            'create_at' => '2021-04-20 10:00:00',
        ],
        [
            'id' => 2,
            'name' => 'Persi',
            'type' => 'Drinks',
            'price' => 5,
            'create_at' => '2021-04-21 09:00:00',
        ],
        [
            'id' => 3,
            'name' => 'Ham Sandwich',
            'type' => 'Sandwich',
            'price' => 45,
            'create_at' => '2021-04-20 19:00:00',
        ],
        [
            'id' => 4,
            'name' => 'Cup cake',
            'type' => 'Dessert',
            'price' => 35,
            'create_at' => '2021-04-18 08:45:00',
        ],
        [
            'id' => 5,
            'name' => 'New York Cheese Cake',
            'type' => 'Dessert',
            'price' => 40,
            'create_at' => '2021-04-19 14:38:00',
        ],
        [
            'id' => 6,
            'name' => 'Lemon Tea',
            'type' => 'Drinks',
            'price' => 8,
            'create_at' => '2021-04-04 19:23:00',
        ],
    ];

    public function testGetTotalPrice()
    {
        $service = new ProductHandler();
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $price = $product['price'] ?: 0;
            $totalPrice += $price;
        }

        $this->assertEquals($service->getTotalPrice($this->products), $totalPrice);
    }

    public function filterTypeAndPriceSort()
    {
        $result = [];
        $lastestPrice = NULL;
        $service = new ProductHandler();
        $products = $service->filterByType($this->products, 'dessert');
        $products = $service->sortByPrice($products);
        foreach ($products as $product) {
            $result[] = [$product['type'], $product['price'], $lastestPrice];
            $lastestPrice = $product['price'];
        }
        return $result;
    }

    public function createAtToTimestamp()
    {
        $result = [];
        $service = new ProductHandler();
        $products = $service->createAtToTimestamp($this->products);
        foreach ($this->products as $key => $product) {
            $result[] = [$products[$key]['create_at'], $product['create_at']];
        }
        return $result;
    }

    /**
     * 测试类型过滤和排序方法
     *
     * @dataProvider filterTypeAndPriceSort
     */
    public function testFilterTypeAndPriceSort($type, $price, $lastestPrice)
    {
        if($lastestPrice !== NULL) {
            $this->assertEquals($lastestPrice >= $price, true);
        }
        $this->assertEquals(strtolower($type), 'dessert');
    }

    /**
     * 测试创建日期转换
     *
     * @dataProvider createAtToTimestamp
     */
    public function testCreateAtToTimestamp($timestamp, $date)
    {
        $this->assertEquals($timestamp == strtotime($date), true);
    }
}