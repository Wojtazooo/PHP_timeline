<html>

<head>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="events-container">
        <div class="grid">
            <div class="timeline-col"> timeline </div>
            <?php
            $columns = 11;
            $rows = 11;

            for ($columnIndex = 1; $columnIndex <= $columns; $columnIndex++) {
                $currentRow = 1;
            ?>
                <div class="col" style="grid-template-rows: repeat(100, 1fr)">

                    <?php
                    for ($rowIndex = 1; $rowIndex <= $rows; $rowIndex++) {
                        $currentRow += $rowIndex;
                    ?>
                        <div class="event" style="grid-row: <?= $currentRow - $rowIndex ?> / <?= $currentRow ?>">
                            <?= $columnIndex ?> - <?= $rowIndex ?> </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>