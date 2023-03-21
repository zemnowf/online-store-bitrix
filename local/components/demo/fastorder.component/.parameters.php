<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    "PARAMETERS" => array(
        "PRODUCT_ID" => array(
            "NAME" => "ID товара",
            "PARENT" => "BASE",
            "TYPE" => "STRING",
            "DEFAULT" => "1"
        ),
        "ORDER_TYPE" => array(
            "NAME" => "Тип заказа",
            "PARENT" => "BASE",
            "TYPE" => "STRING",
            "DEFAULT" => "1"
        ),
    ),
);