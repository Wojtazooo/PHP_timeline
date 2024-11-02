$('.close').on('click', function () {
    $('#deleteModal').fadeOut();
});

$('#deleteNoButton').on('click', function () {
    $('#deleteModal').fadeOut();
});

function openDeleteModal(e) {
    e.stopPropagation();

    var eventId = $(this).data('id');
    var title = $(this).data('title');

    $('#deleteModalTitle').text(`Are you want to delete '${title}'?`);
    $('#deleteModal').fadeIn();
    $('#deleteYesButton').off();
    $('#deleteYesButton').on('click', (_) => handleDeleteConfimationClicked(eventId))
}

function handleDeleteConfimationClicked(eventId) {
    apiDeleteEvent(eventId, (response) => {
        showToastForSuccessResponse(response);
        refreshEvents();
    }, () => { $('#deleteModal').fadeOut() });
}



