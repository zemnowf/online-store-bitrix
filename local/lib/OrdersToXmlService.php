<?php

namespace Lib;

use Bitrix\Main\XmlWriter;

class OrdersToXmlService
{
    public function __construct()
    {
    }

    public static function exportToXml(array $ordersResult)
    {
        $export = new XmlWriter(array(
            'file' => '/upload/orders/export.xml',
            'create_file' => true,
            'charset' => 'UTF-8',
            'lowercase' => false
        ));

        $export->openFile();
        $export->writeBeginTag("orders");

        foreach ($ordersResult as $id => $orderValues) {
            $export->writeBeginTag("order id=\"$id\"");
            $export->writeItem($orderValues['ordersValues']);

            $export->writeBeginTag('properties');

            $export->writeBeginTag('userProperties');
            foreach ($orderValues['userProperties'] as $userProperties) {

                $export->writeBeginTag('property code="' . $userProperties['code'] . '"');
                $export->writeFullTag('value', $userProperties['value']);
                $export->writeEndTag('property');
            }
            $export->writeEndTag('userProperties');

            $export->writeBeginTag('orderProperties');
            foreach ($orderValues['orderProperties'] as $orderProperties) {
                $export->writeBeginTag("property code=\"" . $orderProperties['code'] . "\"");
                $export->writeItem([$orderProperties['value']]);
                $export->writeEndTag('property');
            }
            $export->writeEndTag('orderProperties');

            $export->writeEndTag('properties');

            $export->writeBeginTag('basketItems');
            foreach ($orderValues['basketItems'] as $id => $basketItem) {
                $export->writeBeginTag("basketItem id=\"$id\"");
                $export->writeItem($basketItem, '');
                $export->writeEndTag('basketItem');
            }
            $export->writeEndTag('basketItems');

            $export->writeEndTag('order');

            $export->writeEndTag("orders");
            $export->closeFile();
        }
    }
}