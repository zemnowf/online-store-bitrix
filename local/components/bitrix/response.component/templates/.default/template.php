<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\UI\Extension;

Extension::load("ui.alerts");

?>

<div class="ui-alert ui-alert-success">
    <span class="ui-alert-message"><?=$arParams['RESPONSE_MSG']?></span>
</div>
