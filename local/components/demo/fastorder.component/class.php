<?php

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use Bitrix\Main\Context;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Order;
use Bitrix\Sale\Delivery\Services\Manager;
use Bitrix\Sale\PaySystem\Manager as PaymentManager;

class FastOrder extends CBitrixComponent implements Controllerable
{

    public function configureActions(): array
    {
        return [
            'ajaxRequest' => [
                'prefilters' => []
            ],
        ];
    }

    public function onPrepareComponentParams($arParams): array
    {
        return $arParams;
    }

    protected function listKeysSignedParameters()
    {
        return [
            'PRODUCT_ID',
            'ORDER_TYPE'
        ];
    }

    public function executeComponent()
    {
        $this->includeComponentTemplate();
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    public function ajaxRequestAction()
    {
        Loader::includeModule("catalog");
        Loader::includeModule("sale");

        $request = Context::getCurrent()->getRequest();
        $phoneNumber = $request['phone'];

        global $USER;
        if ($USER->isAuthorized()) {
            $userId = $USER->getID();
        } else {
            $userId = Fuser::getId();
        }

        if ($this->arParams['ORDER_TYPE'] === 'PRODUCT') {
            $basket = Basket::create(SITE_ID);

            $item = $basket->createItem("catalog", $this->arParams['PRODUCT_ID']);
            $item->setFields(array(
                "PRODUCT_PROVIDER_CLASS" => "\Bitrix\Catalog\Product\CatalogProvider",
                "QUANTITY" => 1
            ));
        } else {
            $basket = Basket::loadItemsForFUser($userId, Context::getCurrent()->getSite());
        }

        $order = Order::create(SITE_ID, $userId);
        $order->setPersonTypeId(2);
        $order->setBasket($basket);

        $shipmentCollection = $order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem(Manager::getObjectById(2));

        $shipmentItemCollection = $shipment->getShipmentItemCollection();

        foreach ($basket as $basketItem) {
            $item = $shipmentItemCollection->createItem($basketItem);
            $item->setQuantity($basketItem->getQuantity());
        }

        $paymentCollection = $order->getPaymentCollection();
        $payment = $paymentCollection->createItem(PaymentManager::getObjectById(2));
        $payment->setField("SUM", $order->getPrice());
        $payment->setField("CURRENCY", $order->getCurrency());

        $properties = $order->getPropertyCollection();
        foreach ($properties as $property) {
            if ($property->getField('CODE') == 'PHONE') {
                $property->setValue($phoneNumber);
            }
            if ($property->getField('CODE') == 'FASTORDER') {
                $property->setValue("Y");
            }
        }

        $result = $order->save();
        if (!$result->isSuccess())
        {
            return ['status' => 'error', 'message' => "Ошибка при оформлении заказа"];
        } else return ['status' => 'success', 'message' => "Заказ оформлен"];
    }

}