<?php

namespace Lib;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;

class Label
{
    const HLBLOCK_ID = 4;

    public static function getLabels(): array
    {
        Loader::IncludeModule("highloadblock");

        $hlblock = HighloadBlockTable::getById(self::HLBLOCK_ID)->fetch();
        $entity = HighloadBlockTable::compileEntity($hlblock);
        $entityDataClass = $entity->getDataClass();

        //"select" => array("*")
        $result = $entityDataClass::getList(["select" => ["*"]]);

        $params = array();
        while ($arRow = $result->fetch()) {
            $params[$arRow["UF_XML_ID"]] = $arRow;
        }

        return $params;
    }
}