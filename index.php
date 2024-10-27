<html lang="en">

<head>
    <title>Graphic Journal</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src=./api-client.js></script>
    <!-- component templates -->
    <?php include './components/event-template.html' ?>
</head>

<body>
    <?php include './modals/create/createModal.html' ?>
    <div class="events-container">
        <?php include './modals/create/createModalButton.html' ?>

        <div class="grid">
            <div id="timeline-column" class="timeline-col" style="grid-template-rows: repeat(50, 1rem)"></div>
            <div id="events-column" class="col" style="grid-template-rows: repeat(50, 1rem)">
            </div>
        </div>
    </div>
    <?php include './modals/details/detailsModal.html' ?>
</body>

<!-- components scripts -->
<script src=./components/event-template.js></script>
<!-- Modals scripts -->
<script src=./modals/details/detailsModal.js></script>

</html>