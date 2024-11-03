// -------------- Events ------------------
function apiGetEvents(successResponseCallback) {
    $.ajax({
        url: 'api/controllers/events/getEvents.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            successResponseCallback(response);
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        }
    });
}

function apiCreateEvent(data, successResponseCallback, completeCallback) {
    $.ajax({
        url: 'api/controllers/events/createEvent.php',
        type: 'POST',
        data: data,
        success: function (response) {
            successResponseCallback(response)
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        },
        complete: function () {
            completeCallback();
        }
    });
}

function apiDeleteEvent(eventId, successResponseCallback, completeCallback) {
    $.ajax({
        url: 'api/controllers/events/deleteEvent.php',
        type: 'DELETE',
        data: { id: eventId },
        success: function (response) {
            successResponseCallback(response);
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        },
        complete: function () {
            completeCallback();
        }
    });
}

// -------------- Categories ------------------
function apiGetCategories(successResponseCallback) {
    $.ajax({
        url: 'api/controllers/categories/getCategories.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            successResponseCallback(response);
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        }
    });
}

function apiCreateCategory(data, successResponseCallback, completeCallback) {
    $.ajax({
        url: 'api/controllers/categories/createCategory.php',
        type: 'POST',
        data: data,
        success: function (response) {
            successResponseCallback(response)
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        },
        complete: function () {
            completeCallback();
        }
    });
}

function apiUpdateCategory(data, successResponseCallback, completeCallback) {
    $.ajax({
        url: 'api/controllers/categories/updateCategory.php',
        type: 'PUT',
        data: data,
        success: function (response) {
            successResponseCallback(response)
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        },
        complete: function () {
            completeCallback();
        }
    });
}

function apiDeleteCategory(categoryId, successResponseCallback, completeCallback) {
    $.ajax({
        url: 'api/controllers/categories/deleteCategory.php',
        type: 'DELETE',
        data: { id: categoryId },
        success: function (response) {
            successResponseCallback(response);
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        },
        complete: function () {
            completeCallback();
        }
    });
}

// -------------- Users ------------------ 
function apiLogin(data, successResponseCallback, completeCallback) {
    $.ajax({
        url: 'api/controllers/users/login.php',
        type: 'POST',
        data: data,
        success: function (response) {
            successResponseCallback(response)
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        },
        complete: function () {
            completeCallback();
        }
    });
}

function apiRegister(data, successResponseCallback, completeCallback) {
    $.ajax({
        url: 'api/controllers/users/register.php',
        type: 'POST',
        data: data,
        success: function (response) {
            successResponseCallback(response)
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        },
        complete: function () {
            completeCallback();
        }
    });
}

function apiCheckSesion(successResponseCallback, completeCallback) {
    $.ajax({
        url: 'api/controllers/users/session_check.php',
        type: 'GET',
        success: function (response) {
            successResponseCallback(response)
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        },
        complete: function () {
            completeCallback();
        }
    });
}

function apiLogOut(successResponseCallback, completeCallback) {
    $.ajax({
        url: 'api/controllers/users/logout.php',
        type: 'POST',
        success: function (response) {
            successResponseCallback(response)
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        },
        complete: function () {
            completeCallback();
        }
    });
}

function apiGetUser(userId, successResponseCallback, completeCallback) {
    $.ajax({
        url: 'api/controllers/users/getUser.php',
        type: 'GET',
        data: { userId },
        success: function (response) {
            successResponseCallback(response)
        },
        error: function (xhr, status, error) {
            showToastForApiError(xhr);
        },
        complete: function () {
            completeCallback();
        }
    });
}