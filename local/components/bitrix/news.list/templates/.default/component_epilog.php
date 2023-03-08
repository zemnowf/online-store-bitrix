<?php
if (isset($arResult['DATE_FIRST_NEWS'])) {
    echo "PROPERTY SETTING";
    $APPLICATION->SetPageProperty("specialdate", $arResult["DATE_FIRST_NEWS"]);
} else echo "PROPERTY FAIL";