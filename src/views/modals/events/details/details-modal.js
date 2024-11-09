function openDetailsModal() {
    var title = $(this).data('title');
    var description = $(this).data('description');
    var start = $(this).data('start');
    var end = $(this).data('end');
    var picture = $(this).data('picture');
    var categoryName = $(this).data('categoryname');
    var categoryColor = $(this).data('categorycolor');

    $('#modalTitle').text(title);
    $('#description').text(description);
    $('#start').text(start);
    $('#end').text(end);
    $('#eventDetailsPicture').attr('src', picture);
    $('#category').text(categoryName);
    $('#category').css('background-color', categoryColor)


    $('#eventDetailsModal').fadeIn();
}

$('.close').on('click', function () {
    $('#eventDetailsModal').fadeOut();
});