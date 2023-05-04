function sendCallback(arParams) {
    const form = document.querySelector('.feedback-form form');
    const formData = new FormData(form);

    BX.ajax
        .runComponentAction('bitrix:main.feedback', 'ajaxRequest', {
            mode: 'class',
            method: 'POST',
            signedParameters: arParams,
            data: formData,
        })
        .then(
            (response) => {
                if (response.status === 'success') {
                    clearAlerts();
                    const successMsg = document.getElementById('success-msg');
                    successMsg.innerHTML = response.data.html;
                    form.reset();
                }
            },
            (response) => {
                if (response.status === 'error') {
                    clearAlerts();
                    const errorMsgs = response.errors[0].message;
                    for (key in errorMsgs) {
                        const uiAlert = document.querySelector(`.${key} > .ui-alert`);
                        uiAlert.querySelector('.ui-alert-message').innerHTML =
                            errorMsgs[key];
                        uiAlert.classList.remove('ui-alert-hidden');
                    }
                }
            }
        );
}

function clearAlerts() {
    const uiAlerts = document.querySelectorAll('.ui-alert');
    uiAlerts.forEach((element) => {
        element.classList.add('ui-alert-hidden');
        element.querySelector('.ui-alert-message').innerHTML = '';
    });
}