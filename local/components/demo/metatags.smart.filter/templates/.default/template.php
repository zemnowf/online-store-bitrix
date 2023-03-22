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
        h1.innerHTML = '<?= $this->getComponent()->getFilter(); ?>';
        document.querySelector('title').innerHTML = '<?= $this->getComponent()->getFilter(); ?>';
    });
</script>
