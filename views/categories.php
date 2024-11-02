<?php include  __DIR__ . '/common/header.html' ?>

<body>
    <?php include __DIR__ . '/components/category-template.html' ?>
    <?php include __DIR__ . '/modals/categories/create/create-modal.html' ?>
    <?php include __DIR__ . '/components/navigation-panel.html' ?>

    <div class="page-content">
        <?php include __DIR__ . '/modals/categories/create/create-modal-button.html' ?>
        <ul id="category-list" class="category-list">
        </ul>
    </div>
</body>

<script src=views/components/category-template.js></script>