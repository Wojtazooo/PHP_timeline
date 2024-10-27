function openDetailsModal() {
    console.log('event clicked');
    console.log($(this));
    var title = $(this).data('title');
    var description = $(this).data('description');
    var start = $(this).data('start');
    var end = $(this).data('end');

    $('#modalTitle').text(title);
    $('#description').text(description);
    $('#start').text(start);
    $('#end').text(end);

    $('#eventDetailsModal').fadeIn();
}

$('.close').on('click', function () {
    $('#eventDetailsModal').fadeOut();
});