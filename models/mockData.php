<?php
$category1 = new Category(1, 'Music', '#FF5733');
$category2 = new Category(2, 'Sports', '#33FF57');

$event1 = new Event(1, 'Concert', strtotime('20-10-2024'), strtotime('28-10-2024'), 'Live music event', 'concert.jpg', $category1->getId());
$event2 = new Event(2, 'Art Exhibition', strtotime('25-10-2024'), strtotime('28-10-2024'), 'Contemporary art showcase', 'art.jpg', $category1->getId());
$event3 = new Event(3, 'Tech Conference', strtotime('30-10-2024'), strtotime('31-10-2024'), 'Latest trends in technology', 'tech.jpg', $category2->getId());
$event4 = new Event(4, 'Food Festival', strtotime('10-11-2024'),  strtotime('11-11-2024'), 'Celebration of local cuisine', 'foodfest.jpg', $category1->getId());
$event5 = new Event(5, 'Charity Gala', strtotime('15-10-2024'), strtotime('25-10-2024'), 'Fundraising event for a good cause', 'gala.jpg', $category1->getId());
$event6 = new Event(6, 'Yoga Retreat', strtotime('20-11-2024'), strtotime('22-11-2024'), 'Wellness and relaxation program', 'yoga.jpg', $category2->getId());
$event7 = new Event(7, 'Film Premiere', strtotime('25-11-2024'), strtotime('28-11-2024'), 'Premiere of a new blockbuster', 'film.jpg', $category1->getId());
$event8 = new Event(8, 'Book Fair', strtotime('01-12-2024'), strtotime('05-12-2024'), 'Annual book fair event, very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very very long very long very long very long very long very long very long very long very long very long very long very long', 'bookfair.jpg', $category2->getId());
$event9 = new Event(9, 'Marathon', strtotime('05-11-2024'), strtotime('05-11-2024'), 'City-wide marathon event', 'marathon.jpg', $category2->getId());
$event10 = new Event(10, 'Football Match', strtotime('22-10-2024'), strtotime('22-10-2024'), 'Championship final', 'football.jpg', $category2->getId());
$event10 = new Event(11, 'Football Match', strtotime('22-10-2024'), strtotime('22-10-2024'), 'Championship final', 'football.jpg', $category2->getId());


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
