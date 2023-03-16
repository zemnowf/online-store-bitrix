<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\UI\Extension;

Extension::load("ui.forms");
Extension::load("ui.buttons");
Extension::load("ui.alerts");

$signedParameters = $this->getComponent()->getSignedParameters();

?>
<div class="feedback-form">
    <h2>Форма обратной связи</h2>
    <form onsubmit="sendCallback('<?= $signedParameters ?>'); return false;">
        <div class="name">
            <div class="ui-ctl ui-ctl-textbox">
                <input type="text" name="name" class="ui-ctl-element"
                       placeholder="<?= GetMessage("MFT_NAME") ?>">
            </div>
            <div class="ui-alert ui-alert-danger ui-alert-hidden">
                <span class="ui-alert-message"></span>
            </div>
        </div>
        <div class="surname">
            <div class="ui-ctl ui-ctl-textbox">
                <input type="text" name="surname" class="ui-ctl-element"
                       placeholder="<?= GetMessage("MFT_SURNAME") ?>">
            </div>
            <div class="ui-alert ui-alert-danger ui-alert-hidden">
                <span class="ui-alert-message"></span>
            </div>
        </div>
        <div class="company">
            <div class="ui-ctl ui-ctl-textbox">
                <input type="text" name="company" class="ui-ctl-element"
                       placeholder="<?= GetMessage("MFT_COMPANY") ?>">
            </div>
        </div>

        <div class="department">
            <div class="ui-ctl ui-ctl-after-icon ui-ctl-dropdown">
                <div class="ui-ctl-after ui-ctl-icon-angle"></div>
                <select name="department" class="ui-ctl-element">
                    <option selected disabled value=""><?= GetMessage("MFT_DEPARTMENT") ?></option>
                    <option value="<?= GetMessage("MFT_DEPARTMENT_SALES") ?>">
                        <?= GetMessage("MFT_DEPARTMENT_SALES") ?></option>
                    <option value="<?= GetMessage("MFT_DEPARTMENT_SUPPORT") ?>">
                        <?= GetMessage("MFT_DEPARTMENT_SUPPORT") ?></option>
                    <option value="<?= GetMessage("MFT_DEPARTMENT_EDU") ?>">
                        <?= GetMessage("MFT_DEPARTMENT_EDU") ?></option>
                    <option value="<?= GetMessage("MFT_DEPARTMENT_SUPPLIES") ?>">
                        <?= GetMessage("MFT_DEPARTMENT_SUPPLIES") ?></option>
                </select>
            </div>
        </div>
        <div class="message">
            <div class="ui-ctl ui-ctl-textarea">
				<textarea name="message" class="ui-ctl-element"
                          placeholder="<?= GetMessage("MFT_MESSAGE") ?>"></textarea>
            </div>
        </div>
        <div class="picture">
            <label class="ui-ctl ui-ctl-file-drop">
                <div class="ui-ctl-label-text">
                    <span>Загрузить картинку</span>
                    <small>Перетащить с помощью drag'n'drop</small>
                </div>
                <input type="file" name="picture" class="ui-ctl-element" accept=".png,.jpeg,.jpg,.webp">
            </label>
        </div>
        <button class="ui-btn ui-btn-primary"
                type="submit"><?= GetMessage("MFT_SUBMIT") ?>
        </button>
        <div class="success-msg" id="success-msg"></div>
    </form>
</div>