<?php
class Event
{
    private int $id;
    private string $title;
    private int $unixStart;
    private int $unixEnd;
    private string $description;
    private string $picture;
    private int $categoryId;

    public function __construct(int $id, string $title, int $start, int $end, string $description, string $picture, int $categoryId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->unixStart = $start;
        $this->unixEnd = $end;
        $this->description = $description;
        $this->picture = $picture;
        $this->categoryId = $categoryId;
    }

    public function getStart(): int
    {
        return $this->unixStart;
    }

    public function getStartFormatted($format = 'd-m-Y'): string
    {
        return date($format, $this->unixStart);
    }

    public function getEnd(): int
    {
        return $this->unixEnd;
    }

    public function getEndFormatted($format = 'd-m-Y'): string
    {
        return date($format, $this->unixEnd);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }
}

class Category
{
    private $id;
    private $name;
    private $color;

    public function __construct($id, $name, $color)
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
    }

    function getId()
    {
        return $this->id;
    }
}

$category1 = new Category(1, 'Music', '#FF5733');
$category2 = new Category(2, 'Sports', '#33FF57');

$event1 = new Event(1, 'Concert', strtotime('20-10-2024'), strtotime('20-10-2024'), 'Live music event', 'concert.jpg', $category1->getId());
$event2 = new Event(2, 'Art Exhibition', strtotime('25-10-2024'), strtotime('25-10-2024'), 'Contemporary art showcase', 'art.jpg', $category1->getId());
$event3 = new Event(3, 'Tech Conference', strtotime('30-10-2024'), strtotime('31-10-2024'), 'Latest trends in technology', 'tech.jpg', $category2->getId());
$event4 = new Event(4, 'Food Festival', strtotime('10-11-2024'),  strtotime('11-11-2024'), 'Celebration of local cuisine', 'foodfest.jpg', $category1->getId());
$event5 = new Event(5, 'Charity Gala', strtotime('15-11-2024'), strtotime('15-11-2024'), 'Fundraising event for a good cause', 'gala.jpg', $category1->getId());
$event6 = new Event(6, 'Yoga Retreat', strtotime('20-11-2024'), strtotime('22-11-2024'), 'Wellness and relaxation program', 'yoga.jpg', $category2->getId());
$event7 = new Event(7, 'Film Premiere', strtotime('28-11-2024'), strtotime('28-11-2024'), 'Premiere of a new blockbuster', 'film.jpg', $category1->getId());
$event8 = new Event(8, 'Book Fair', strtotime('01-12-2024'), strtotime('03-12-2024'), 'Annual book fair event', 'bookfair.jpg', $category2->getId());
$event9 = new Event(9, 'Marathon', strtotime('05-11-2024'), strtotime('05-11-2024'), 'City-wide marathon event', 'marathon.jpg', $category2->getId());
$event10 = new Event(10, 'Football Match', strtotime('22-10-2024'), strtotime('22-10-2024'), 'Championship final', 'football.jpg', $category2->getId());


$categories = [
    $category1,
    $category2
];

$events = [
    $event1,
    $event2,
    $event3,
    $event4,
    $event5,
    $event6,
    $event7,
    $event8,
    $event9,
    $event10,
];

$numberOfRowsToDivideColumn = 200;
?>

<html>

<head>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="events-container">
        <div class="grid">
            <div class="timeline-col">
                <?php

                $startTimestamps = array_map(function (Event $event) {
                    // return strtotime($event->getStart()); 
                    return $event->getStart();
                }, $events);

                $endTimestamps = array_map(function (Event $event) {
                    return $event->getEnd();
                }, $events);

                sort($startTimestamps);

                foreach ($startTimestamps as &$timestamp) {
                    echo '<p>';
                    echo date('d-m-Y', $timestamp);
                    echo '</p>';
                }
                ?>
            </div>
            <!-- <?php include 'grid-template-rows-demo.php' ?> -->

            <div class="col">
                <?php foreach ($events as $event): ?>
                    <div class="event">
                        <h2> <?php echo $event->getTitle(); ?></h2>
                        <p><strong>Date:</strong> <?php echo $event->getStartFormatted(); ?> - <?php echo $event->getEndFormatted(); ?></p>
                        <p><strong>Description:</strong> <?php echo $event->getDescription(); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>