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

        const editButton = clone.querySelector('#edit-button')
        editButton.setAttribute('data-id', category.id);
        editButton.setAttribute('data-name', category.name);
        editButton.setAttribute('data-color', category.color);
        editButton.addEventListener('click', editButtonHandler);

        $('#category-list').append(clone);
    });
}

function deleteButtonHandler() {
    var categoryId = $(this).data('id');
    apiDeleteCategory(categoryId, (response) => {
        showToastForSuccessResponse(response);
        refreshCategories();
    }, () => { })
}

function editButtonHandler() {
    var categoryId = $(this).data('id');
    var categoryName = $(this).data('name');
    var categoryColor = $(this).data('color');

    openEditCategoryModal(categoryId, categoryName, categoryColor);
}