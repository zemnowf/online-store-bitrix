<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    "PARAMETERS" => array(
        "CATALOG_IBLOCK_ID" => array(
            "NAME" => "ID Инфоблока Каталог",
            "TYPE" => "STRING",
            "DEFAULT" => "3",
            "PARENT" => "BASE",
        ),
        "CATALOG_SECTION_CODE" => array(
            "NAME" => "Символьный код раздела",
            "TYPE" => "STRING",
            "DEFAULT" => "1",
            "PARENT" => "BASE",
        ),
        "SMART_FILTER_PATH" => array(
            "NAME" => "Строка фильтра",
            "TYPE" => "STRING",
            "DEFAULT" => "",
            "PARENT" => "BASE",
        ),
    )
);