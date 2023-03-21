<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CBitrixComponentTemplate $this
 * @var array $arParams
 */

use \Bitrix\Main\UI\Extension;

Extension::load("ui.forms");
Extension::load("ui.buttons");

$signedParameters = $this->getComponent()->getSignedParameters();
?>
<div class="fast-order-component">
    <div class="fast-order-button-wrapper">
        <button class="ui-btn ui-btn-success" onclick="clickFastOrderButton(<?= $arParams['PRODUCT_ID'] ?>);">
            Купить в один клик
        </button>
    </div>
    <div class="fast-order hidden" id="fast-order_<?= $arParams['PRODUCT_ID']; ?>">
        <form onsubmit="sendOrder('<?= $signedParameters ?>', <?= $arParams['PRODUCT_ID'] ?>); return false;"
              class="fast-order-form"
              id="fast-order-form_<?= $arParams['PRODUCT_ID'] ?>">
            <div class="ui-ctl ui-ctl-textbox">
                <input type="text"
                       class="ui-ctl-element"
                       name="phone"
                       placeholder="+375331234567"
                >
            </div>
            <div class="ui-btn-split ui-btn-sm">
                <button class="ui-btn ui-btn-sm" type="submit">Купить</button>
            </div>
        </form>
    </div>
    <div class="success-msg" id="success-msg"></div>
</div>
