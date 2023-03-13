<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Lib\Label;

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult['HLB_LABELS'] = Label::getLabels();

if (is_object($this->__component)) {
    $this->__component->SetResultCacheKeys([('HLB_LABELS')]);
}
