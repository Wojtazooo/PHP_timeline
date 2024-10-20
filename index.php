<?php include 'models/Event.php' ?>
<?php include 'models/Category.php' ?>
<?php include 'models/mockData.php' ?>
<?php include 'get-event-with-positions.php' ?>

<?php
$numberOfRowsToDivideColumn = 55;
$rowHeight = '1rem'
?>

<html>

<head>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="events-container">
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
                    <div class="event" style="grid-row: <?= $eventWithPosition->rowStartPosition ?> / <?= $eventWithPosition->rowEndPosition ?>">
                        <div class="main-info">
                            <span> <strong><?php echo $event->getTitle(); ?> </strong> (<?php echo $event->getStartFormatted(); ?> - <?php echo $event->getEndFormatted(); ?>)</span>
                        </div>

                        <?php if ($eventWithPosition->getRowsLength() > 2): ?>
                            <div class="additional-info">
                                <span>Description: <?php echo $event->getDescription(); ?></span>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>