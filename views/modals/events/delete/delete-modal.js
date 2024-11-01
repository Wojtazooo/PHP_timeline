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

    console.log($(this));
    console.log('open delete modal of title = ', title, ', id = ', eventId);

    $('#deleteModalTitle').text(`Are you want to delete '${title}'?`);
    $('#deleteModal').fadeIn();
    $('#deleteYesButton').off();
    $('#deleteYesButton').on('click', (_) => handleDeleteConfimationClicked(eventId))
}

function handleDeleteConfimationClicked(eventId) {
    console.log('deletion of ', eventId, ' confirmed');
    apiDeleteEvent(eventId, () => refreshEvents(), () => { $('#deleteModal').fadeOut() });
    ;

}



