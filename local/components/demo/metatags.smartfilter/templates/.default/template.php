<?

/**
 * @var CBitrixComponentTemplate $this
 * @var CMain $APPLICATION
 */

CJSCore::Init();
?>

<script>
    BX.ready(function(){
        const h1 = BX('pagetitle');
        h1.innerHTML = '<?=$APPLICATION->ShowTitle() . $this->getComponent()->getFilter(); ?>';
        document.querySelector('title').innerHTML = '<?=$APPLICATION->ShowTitle() .
        $this->getComponent()->getFilter(); ?>';
    });
</script>
