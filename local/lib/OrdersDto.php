<?php

namespace Lib;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Sale\Order;

class OrdersDto
{
    public function __construct()
    {
    }

    /**
     * @throws LoaderException
     * @throws ArgumentException
     */
    public static function getOrders(): array
    {
        Loader::includeModule('sale');

        $ordersId = Order::getList([
            'select' => [
                "ID"
            ]
        ]);

        $ordersResultDto = [];

        foreach ($ordersId as $orderId) {
            $order = Order::load($orderId['ID']);
            $ordersValues = [
                'dateInsert' => $order->getField('DATE_INSERT')->toString(),
                'dateUpdate' => $order->getField('DATE_UPDATE')->toString(),
                'personTypeId' => (int)$order->getField('PERSON_TYPE_ID'),
                'statusId' => $order->getField('STATUS_ID'),
                'price' => $order->getField('PRICE'),
                'discountValue' => $order->getField('DISCOUNT_VALUE'),
                'userId' => $order->getField('USER_ID'),
                'accountnumber' => $order->getField('ACCOUNT_NUMBER'),
                'payed' => $order->getField('PAYED'),
            ];

            $userProperties = [];
            $orderProperties = [];
            $propertyCollection = $order->getPropertyCollection();

            foreach ($propertyCollection as $property) {
                if ($property->getProperty()['USER_PROPS'] == 'Y') {
                    $userProperties[] = [
                        'code' => $property->getField('CODE'),
                        'value' => $property->getField('VALUE')
                    ];
                } else {
                    $orderProperties[] = [
                        'code' => $property->getField('CODE'),
                        'value' => $property->getField('VALUE')
                    ];
                }
            }

            $basketItems = [];
            $basket = $order->getBasket();
            foreach ($basket as $id => $basketItem) {
                $basketItems[$id] = [
                    'productId' => $basketItem->getField('PRODUCT_ID'),
                    'name ' => $basketItem->getField('NAME'),
                    'price' => $basketItem->getField('PRICE'),
                    'basePrice' => $basketItem->getField('BASE_PRICE'),
                    'quantity' => (int)$basketItem->getField('QUANTITY'),
                    'discountPrice' => $basketItem->getField('DISCOUNT_PRICE')
                ];
            }

            $ordersResultDto[$orderId['ID']] = [
                'ordersValues' => $ordersValues,
                'userProperties' => $userProperties,
                'orderProperties' => $orderProperties,
                'basketItems' => $basketItems
            ];
        }

        return $ordersResultDto;
    }


}