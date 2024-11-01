<?php

include_once '../../utilitites.php';
include_once '../../database/DatabaseConnection.php';
include_once '../../models/Event.php';


function getEvents()
{
    $mysqli = connectToDatabase();
    $sqlQuery = "SELECT id, title, start, end, description, picture FROM events";

    $result = $mysqli->query($sqlQuery);

    if ($result->num_rows > 0) {
        $results = $result->fetch_all(MYSQLI_ASSOC);

        $resultsMappedToEvents = array_map(function ($result) {
            $id = $result['id'];
            $title = $result['title'];
            $start = strtotime($result['start']);
            $end = strtotime($result['end']);
            $description = $result['description'];
            $picture = $result['picture'];

            // TODO: change it when implementing categories
            $event = new Event($id, $title, $start, $end, $description, $picture, 1);
            return $event;
        }, $results);

        return $resultsMappedToEvents;
    } else {
        return [];
    }
}

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

    public function getRowsLength()
    {
        return $this->rowEndPosition - $this->rowStartPosition;
    }
}

/**
 * @return EventWithposition[]
 */
function getEventsWithPositions(array $events, $numberOfRowsToDivideColumn): array
{
    if (count($events) == 0) {
        return [];
    }

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

if (getRequestMethod() === 'GET') {
    error_log('GET events endpoint');

    try {
        $result = getEventsWithPositions(getEvents(), 50);

        send_response(200, 'Events fetched succesfully', $result);
    } catch (Exception $e) {
        send_response(500, 'Failed to get events.');
    }
} else {
    send_response(500, 'Invalid http request.');
}
