<?php
$columns = 3;
$rows = 11;

for ($columnIndex = 1; $columnIndex <= $columns; $columnIndex++) {
    $currentRow = 1;
?>
    <div class="col" style="grid-template-rows: repeat(<?= $numberOfRowsToDivideColumn ?>, 10px">

        <?php
        for ($rowIndex = 1; $rowIndex <= $rows; $rowIndex++) {
            $currentRow += $rowIndex;
        ?>
            <div class="event" style="grid-row: <?= $currentRow - $rowIndex ?> / <?= $currentRow ?>">
                <?= $columnIndex ?> - <?= $rowIndex ?> </div>
        <?php } ?>
    </div>
<?php } ?>