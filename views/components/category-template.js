$(document).ready(function () {
    refreshCategories();
});

function refreshCategories() {
    apiGetCategories((response) => {
        renderCategories(response.result)
    })
}

function renderCategories(categories) {
    $('#category-list').empty();

    const categoryTemplate = document.getElementById("category-template");
    categories.forEach(category => {
        const clone = categoryTemplate.content.cloneNode(true);

        clone.querySelector('.category-name').textContent = category.name;
        clone.querySelector('.category-color').style = `background-color: ${category.color}`;



        const deleteButton = clone.querySelector('#delete-button')
        deleteButton.setAttribute('data-id', category.id);
        deleteButton.addEventListener('click', deleteButtonHandler);

        $('#category-list').append(clone);
    });
}

function deleteButtonHandler() {
    var categoryId = $(this).data('id');
    console.log('delete', categoryId);
    apiDeleteCategory(categoryId, (response) => {
        showToastForSuccessResponse(response);
        refreshCategories();
    }, () => { })
}