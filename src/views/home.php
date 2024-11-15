<html lang="en">

<?php include  __DIR__ . '/common/header.html' ?>

<body>
    <?php include  __DIR__ . '/components/event-template.html' ?>
    <?php include __DIR__ . '/modals/events/create/create-modal.html' ?>
    <?php include __DIR__ . '/modals/events/delete/delete-modal.html' ?>
    <?php include __DIR__ . '/modals/events/edit/edit-modal.html' ?>
    <?php include __DIR__ . '/modals/events/details/details-modal.html' ?>
    <?php include __DIR__ . '/common/navigation-panel.html' ?>

    <div class="page-content">
        <?php include  __DIR__ . '/modals/events/create/create-modal-button.html' ?>

        <div class="grid">
            <div id="timeline-column" class="timeline-col" style="grid-template-rows: repeat(50, 1rem)"></div>
            <div id="events-column" class="col" style="grid-template-rows: repeat(50, 1rem)">
                <div id="loadEventsSpinner" class="loader" style="display: none"></div>
            </div>
        </div>
    </div>

</body>

<!-- components scripts -->
<script src=views/components/event-template.js></script>
<script src=views/common/navigation-panel.js></script>
<!-- Modals scripts -->
<script src=views/modals/events/details/details-modal.js></script>
<script src=views/modals/events/delete/delete-modal.js></script>
<script src=views/modals/events/edit/edit-modal.js></script>


</html>