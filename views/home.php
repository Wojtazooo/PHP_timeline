<html lang="en">

<?php include  __DIR__ . '/common/header.html' ?>

<body>
    <?php include  __DIR__ . '/components/event-template.html' ?>
    <?php include __DIR__ . '/components/navigation-panel.html' ?>
    <?php include __DIR__ . '/modals/create/create-modal.html' ?>
    <?php include __DIR__ . '/modals/delete/delete-modal.html' ?>
    <?php include __DIR__ . '/modals/details/details-modal.html' ?>
    <div class="events-panel">
        <div class="events-container">
            <?php include  __DIR__ . '/modals/create/create-modal-button.html' ?>

            <div class="grid">
                <div id="timeline-column" class="timeline-col" style="grid-template-rows: repeat(50, 1rem)"></div>
                <div id="events-column" class="col" style="grid-template-rows: repeat(50, 1rem)">
                </div>
            </div>
        </div>
    </div>

</body>

<!-- components scripts -->
<script src=views/components/event-template.js></script>
<!-- Modals scripts -->
<script src=views/modals/details/details-modal.js></script>
<script src=views/modals/delete/delete-modal.js></script>

</html>