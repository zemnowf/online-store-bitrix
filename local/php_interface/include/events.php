<?php
IncludeModuleLangFile(__FILE__);

// файл /bitrix/php_interface/init.php
// регистрируем обработчик
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate",
    array("CounterEventHadler", "OnBeforeIBlockElementUpdateHandler"));

class CounterEventHadler
{
    // создаем обработчик события "OnBeforeIBlockElementUpdate"
    public static function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        echo "handler start\n";
        //при замене элемента каталога
        if ($arFields["IBLOCK_ID"] == IBLOCK_CATALOG) {
            echo "iblock_id = 2\n";
            //если элемент не активен
            if ($arFields["ACTIVE"] == "N") {
                echo "element disactive\n";
                $arSelect = array(
                    "ID",
                    "IBLOCK_ID",
                    "NAME",
                    "SHOW_COUNTER"
                );
                $arFilter = array(
                    "IBLOCK_ID" => IBLOCK_CATALOG,
                    "ID" => $arFields["ID"],
            );
                $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                $arItems = $res->Fetch();

                if ($arItems["SHOW_COUNTER"] > MAX_COUNT) {
                    global $APPLICATION;
                    $counterExceptionText = GetMessage("COUNTER_TEXT", array("#COUNT#" => $arItems["SHOW_COUNTER"]));
                    $APPLICATION->throwException($counterExceptionText);
                    return false;
                }
            }
        }
    }
}