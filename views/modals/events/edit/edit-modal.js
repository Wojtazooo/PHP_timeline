eventIdToUpdate = undefined;

$(document).ready(function () {
    const modal = $('#editEventDetailsModal')

    const datePickerSettings = {
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2100"
    };

    modal.find("#editEventStart").datepicker(datePickerSettings);
    modal.find("#editEventEnd").datepicker(datePickerSettings);

    apiGetCategories(response => {

        const categories = response.result;

        categories.forEach((category, index) => {
            $("#editCategoriesSelect").append(
                $('<option>', {
                    value: category.id,
                    text: category.name,
                    css: { 'background-color': category.color }
                }));

            if (index === 0) {
                $("#editCategoriesSelect").css("background-color", category.color);
            }
        });

    });

    $('#editCategoriesSelect').change(function () {
        var selectedOptionColor = $(this).find(":selected").css("background-color");
        $('#editCategoriesSelect').css("background-color", selectedOptionColor)
    });
});

$('.close').on('click', function () {
    $('#editEventDetailsModal').fadeOut();
});

$('#editEventForm').on('submit', function (e) {
    e.preventDefault();

    const title = $('#editEventTitle').val();
    const start = $('#editEventStart').val();
    const end = $('#editEventEnd').val();
    const description = $('#editEventDescription').val();
    const picture = $('#editEventPicture').val();
    const categoryId = $('#editCategoriesSelect').val();

    const data = {
        id: eventIdToUpdate,
        title: title,
        start: start,
        end: end,
        description: description,
        picture: picture,
        categoryId: categoryId
    }

    apiUpdateEvent(data, (response) => {
        showToastForSuccessResponse(response);
        $('#editEventDetailsModal').fadeOut();
        refreshEvents();
    })
});

function openEditEventDetailsModal(e) {
    e.stopPropagation();
    var selectedEventId = $(this).data('id');
    eventIdToUpdate = selectedEventId;
    selectedEvent = events.find(e => e.id == eventIdToUpdate);
    console.log(selectedEvent);

    const modal = $('#editEventDetailsModal')
    modal.fadeIn();

    modal.find('#editEventTitle').val(selectedEvent.title);
    modal.find('#editEventStart').val(selectedEvent.start);
    modal.find('#editEventEnd').val(selectedEvent.end);
    modal.find('#editEventDescription').val(selectedEvent.description);
    modal.find('#editEventPicture').val(selectedEvent.picture);
    $('#editCategoriesSelect').css("background-color", selectedEvent.categoryColor)
    modal.find('#editCategoriesSelect').val(selectedEvent.categoryId);
}
