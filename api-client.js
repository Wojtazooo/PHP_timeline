
function apiGetEvents(successResponseCallback) {
    $.ajax({
        url: 'api/controllers/events/getEvents.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            successResponseCallback(response);
        },
        error: function (xhr, status, error) {
            alert(status + ': ' + error + ' - ' + xhr.responseText);
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
            alert(status + ': ' + error + ' - ' + xhr.responseText);
        },
        complete: function () {
            completeCallback();
        }
    });
}