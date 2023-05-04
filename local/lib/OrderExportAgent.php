<?php

namespace Lib;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\LoaderException;
use CAgent;

class OrderExportAgent
{
    public function __construct()
    {
    }

    public static function start()
    {
        self::stop();
        return CAgent::AddAgent('Lib\OrderExportAgent::export();');
    }

    public static function stop()
    {
        CAgent::RemoveAgent('Lib\OrderExportAgent::export();');
    }

    /**
     * @throws LoaderException
     * @throws ArgumentException
     */
    public static function export(): string
    {
        $ordersResultDto = OrdersDto::getOrders();
        OrdersToXmlService::exportToXml($ordersResultDto);

        return 'Lib\OrderExportAgent::export();';
    }
}