<?php include  __DIR__ . '/common/header.html' ?>

<body>
    <?php include __DIR__ . '/components/category-template.html' ?>
    <?php include __DIR__ . '/components/navigation-panel.html' ?>

    <h1>Event Categories</h1>

    <ul id="category-list" class="category-list">
    </ul>

    <!-- <ul id="category-list" class="category-list">
        <li class="category-item" data-id="cat001">
            <div class="category-color" style="background-color: #FF5733;"></div>
            <span class="category-name">Music</span>
        </li>
        <li class="category-item" data-id="cat002">
            <div class="category-color" style="background-color: #33C1FF;"></div>
            <span class="category-name">Art</span>
        </li>
        <li class="category-item" data-id="cat003">
            <div class="category-color" style="background-color: #75FF33;"></div>
            <span class="category-name">Technology</span>
        </li>
        <li class="category-item" data-id="cat004">
            <div class="category-color" style="background-color: #FF33F6;"></div>
            <span class="category-name">Sports</span>
        </li>
        <li class="category-item" data-id="cat005">
            <div class="category-color" style="background-color: #FFC133;"></div>
            <span class="category-name">Education</span>
        </li>
    </ul> -->
</body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const categories = document.querySelectorAll('.category-item');
        categories.forEach(category => {
            category.addEventListener('click', () => {
                const id = category.getAttribute('data-id');
                alert(`Category ID: ${id}`);
            });
        });
    });
</script>
<script src=views/components/category-template.js></script>