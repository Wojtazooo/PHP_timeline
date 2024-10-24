<?php include 'models/Event.php' ?>
<?php include 'models/Category.php' ?>
<?php include 'models/mockData.php' ?>
<?php include 'get-event-with-positions.php' ?>

<?php
$numberOfRowsToDivideColumn = 50;
$rowHeight = '1fr'
?>

<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <?php include './modals/create/createModal.html' ?>
    <?php include './modals/details/detailsModal.html' ?>
    <div class="events-container">
        <?php include './modals/create/createModalButton.html' ?>
        <div class="grid">
            <div class="timeline-col" style="grid-template-rows: repeat(<?= $numberOfRowsToDivideColumn ?>, <?= $rowHeight ?>)">
                <?php
                $eventsWithPositions = getEventsWithPositions($events, $numberOfRowsToDivideColumn);
                ?>

                <?php foreach ($eventsWithPositions as $eventWithPosition):
                ?>
                    <div class="timeline-timestamp" style="grid-row: <?= $eventWithPosition->rowStartPosition ?> / <?= $eventWithPosition->rowStartPosition ?>">
                        &#x2022;<?= date('d-m-Y', $eventWithPosition->event->getStart()) ?>
                    </div>
                <?php endforeach; ?>

            </div>

            <div class="col" style="grid-template-rows: repeat(<?= $numberOfRowsToDivideColumn ?>,  <?= $rowHeight ?>)">
                <?php foreach ($eventsWithPositions as $eventWithPosition):
                    $event = $eventWithPosition->event;
                ?>
                    <div
                        class="event"
                        style="grid-row: <?= $eventWithPosition->rowStartPosition ?> / <?= $eventWithPosition->rowEndPosition ?>"
                        data-id="<?= $event->getId() ?>"
                        data-name="<?= $event->getTitle() ?>"
                        data-description="<?= $event->getDescription() ?>"
                        data-start="<?= $event->getStartFormatted() ?>"
                        data-end="<?= $event->getEndFormatted() ?>">
                        <div class="main-info">
                            <span> <strong><?php echo $event->getTitle(); ?> </strong> (<?php echo $event->getStartFormatted(); ?> - <?php echo $event->getEndFormatted(); ?>)</span>
                        </div>

                        <!-- <?php if ($eventWithPosition->getRowsLength() > 2): ?>
                            <div class="additional-info">
                                <span>Description: <?php echo $event->getDescription(); ?></span>
                            </div>
                        <?php endif; ?> -->

                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Modal -->
        </div>
    </div>
</body>

</html>