
<?php

class EventWithPosition
{
    public Event $event;
    public int $rowStartPosition;
    public int $rowEndPosition;

    public function __construct(Event $event, float $startPosition, float $endPosition)
    {
        $this->event = $event;
        $this->rowStartPosition = floor($startPosition);
        $this->rowEndPosition = floor($endPosition);
    }
}

function getEventsWithPositions(array $events, $numberOfRowsToDivideColumn): array
{
    $startTimestamps = array_map(function (Event $event) {
        return $event->getStart();
    }, $events);
    array_multisort($startTimestamps, SORT_ASC, $events);
    $firstTimestamp = reset($events)->getStart();

    $lastTimestamp = null;
    foreach ($events as $event) {
        if ($lastTimestamp === null || $event->getEnd() > $lastTimestamp) {
            $lastTimestamp = $event->getEnd();
        }
    }

    $totalDifference = $lastTimestamp - $firstTimestamp;
    $ticksPerRow = $totalDifference / $numberOfRowsToDivideColumn;

    $timestampsWithRowPosition = array_map(function (Event $event) use ($firstTimestamp, $ticksPerRow) {
        $rowStartPosition = ($event->getStart() - $firstTimestamp) / $ticksPerRow;
        if ($rowStartPosition == 0) {
            $rowStartPosition++;
        }

        $rowEndPosition = ($event->getEnd() - $firstTimestamp) / $ticksPerRow;

        if ($rowEndPosition - $rowStartPosition < 2) {
            $rowEndPosition = $rowStartPosition + 2;
        }

        return new EventWithPosition($event, $rowStartPosition, $rowEndPosition);
    }, $events);

    return  $timestampsWithRowPosition;
}


?>
