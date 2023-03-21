function sendOrder(arParams, productId = '') {

    const form = BX(`fast-order-form_${productId}`);
    const formData = new FormData(form);

    BX.ajax
        .runComponentAction('demo:fastorder.component', 'ajaxRequest', {
            mode: 'class',
            method: 'POST',
            signedParameters: arParams,
            data: formData,
        })
        .then(
            (response) => {
                if (response.status === 'success') {
                    form.reset();
                    if (response.data.status === 'success') {
                        const successMsg = document.getElementById('success-msg');
                        successMsg.innerHTML = response.data.message;
                        form.reset();
                    }
                    if (response.data.status === 'error') {
                        const errorMsg = document.getElementById('success-msg');
                        errorMsg.innerHTML = response.data.message;
                        form.reset();
                    }
                    BX.addClass(BX(`fast-order_${productId}`), 'hidden');
                }
            },
        );
}

function clickFastOrderButton(productId = '') {
    if (BX.hasClass(BX(`fast-order_${productId}`), 'hidden')) {
        BX.removeClass(BX(`fast-order_${productId}`), 'hidden');
    } else BX.addClass(BX(`fast-order_${productId}`), 'hidden');
}
