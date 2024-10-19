<?php
function random_color_part()
{
    return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
}

function random_color()
{
    return random_color_part() . random_color_part() . random_color_part();
}
?>

<html>

<head>
    <link rel="stylesheet" href="styles.css">
</head>

    <body>
        <div class="events-container">
            <div class="grid">
                <div class="timeline-col"> timeline </div>
                <?php
                $columns = 13;
                $rows = 10;
                for ($columnIndex = 1; $columnIndex <= $columns; $columnIndex++) { ?>
                    <div class="col">
                        
                        <?php
                        for ($rowIndex = 1; $rowIndex <= $rows; $rowIndex++) { ?>
                            <div class="event"> <?= $columnIndex ?> - <?= $rowIndex ?> </div>
                        <?php } ?>

                    </div>
                <?php } ?>
            </div>
        </div>
    </body>

</html>