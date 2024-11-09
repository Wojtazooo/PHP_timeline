$(document).ready(function () {
    const successToastDiv = `<div id="success-toast" class="toast success">xxx</div>`;
    const warningToastDiv = `<div id="warning-toast" class="toast warning">xxx</div>`;
    const errorToastDiv = `<div id="error-toast" class="toast error">xxx</div>`;
    $('body').append(successToastDiv);
    $('body').append(warningToastDiv);
    $('body').append(errorToastDiv);
});

function showToastForApiError(xhr) {
    const httpStatusCode = xhr.status;

    let message;
    try {
        const responseObject = JSON.parse(xhr.responseText);
        message = responseObject.message;
    } catch (e) {
        message = xhr.responseText;
    }

    if (httpStatusCode >= 500) {
        showErrorToast(message);
    } else if (httpStatusCode >= 400) {
        showWarningToast(message);
    } else {
        throw new Error('http status code is not error');
    }
}

function showToastForSuccessResponse(response) {
    const responseObject = JSON.parse(response);
    const message = responseObject.message;

    showSuccessToast(message);
}

function showSuccessToast(message) {
    showToast('#success-toast', message)
}

function showWarningToast(message) {
    showToast('#warning-toast', message)
}

function showErrorToast(message) {
    showToast('#error-toast', message)
}

function showToast(id, message) {
    $('#success-toast').hide();
    $('#warning-toast').hide();
    $('#error-toast').hide();

    $(id).text(message);
    $(id).show().delay(2000).fadeOut(200);
}