CREATE DATABASE eventsDb;

USE eventsDb;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    color VARCHAR(7) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    start DATETIME NOT NULL,
    end DATETIME NOT NULL,
    description TEXT,
    picture VARCHAR(255),
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE SET NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO
    categories
VALUES (
        1,
        'Sport event',
        '#d57676',
        '2024-11-09 13:17:27',
        '2024-11-10 09:37:55'
    ),
    (
        2,
        'Concert',
        '#6165cc',
        '2024-11-09 13:27:50',
        '2024-11-10 09:37:50'
    ),
    (
        3,
        'Politics',
        '#76c874',
        '2024-11-10 10:38:15',
        '2024-11-10 10:38:15'
    );

INSERT INTO
    events
VALUES (
        2,
        'ROGUE Invitational',
        '2024-11-08 00:00:00',
        '2024-11-10 00:00:00',
        'New year, new venue. The 2024 Rogue Invitational is headed to Scotland.\n\nThe 6th annual Rogue Invitational will be held November 8-10 at P&J Live in Aberdeen, Scotland.\n\nThere are few places on earth as intimately tied to historic feats of strength as Scotland, which makes it a natural fit to host this year’s event. This sixth edition will continue its tradition of showcasing the biggest names in CrossFit and Strongman for a weekend of competition and community.',
        'https://assets.teca.co.uk/images/events/_1440x600_crop_center-center_none/Website-Event-Listing.jpg',
        1,
        '2024-11-09 13:17:49',
        '2024-11-10 10:36:51'
    ),
    (
        3,
        'USA election 2024',
        '2024-11-03 00:00:00',
        '2024-11-07 00:00:00',
        'The 2024 United States presidential election was the 60th quadrennial presidential election, held on Tuesday, November 5, 2024.[3] The Republican Party\'s ticket—Donald Trump, who was the 45th president of the United States from 2017 to 2021, and JD Vance, the junior U.S. senator from Ohio—defeated the Democratic Party\'s ticket—Kamala Harris, the incumbent U.S. vice president, and Tim Walz, the governor of Minnesota.[4][5] Trump and Vance are scheduled to be inaugurated as the 47th president and the 50th vice president on January 20, 2025, after their formal election by the Electoral College.',
        'https://ocdn.eu/pulscms-transforms/1/fT0ktkpTURBXy82OWNjNjlhNjRkMmEyYzhmODYwNjBhMDZjNDY2Nzc5OC5qcGeSlQMAAM0IwM0E7JMFzQSwzQKk',
        3,
        '2024-11-09 13:18:21',
        '2024-11-10 11:06:06'
    ),
    (
        4,
        'UEFA Nations League',
        '2024-11-01 00:00:00',
        '2024-11-07 00:00:00',
        'The UEFA Nations League is an international football competition played by the senior men\'s national teams of the member associations of UEFA, the sport\'s European governing body.[1]',
        'https://cdn.resfu.com/media/img_news/cartel-de-las-selecciones-clasificadas-para-la-liga-de-naciones--uefa.jpg?size=1000x&lossy=1',
        1,
        '2024-11-10 10:41:52',
        '2024-11-10 11:24:40'
    ),
    (
        5,
        'Polonia - ŁKS Łódź',
        '2024-11-08 00:00:00',
        '2024-11-08 00:00:00',
        'Polonia - ŁKS Łódź mecz pierwszej klasy piłki nożnej w Polsce.',
        'https://radiolodz.pl/wp-content/uploads/2024/11/LKS-Lodz-vs-Polonia-Warszawa-Fot-Sebastian-Szwajkowski-26.jpg',
        1,
        '2024-11-10 10:44:11',
        '2024-11-10 10:44:11'
    ),
    (
        6,
        'Daria Zawiałow Trasa Pete Stop',
        '2024-11-04 00:00:00',
        '2024-11-08 00:00:00',
        'Z Fryderykiem za Album Roku Pop i po sukcesie wiosennej trasy koncertowej Daria Zawiałow zaprasza na drugi przystanek koncertowej odsłony albumu Dziewczyna Pop.',
        'https://goodtaste.pl/wp-content/uploads/2024/04/DARIA-ZAWIALOW-WWW.png',
        2,
        '2024-11-10 10:46:01',
        '2024-11-10 10:46:47'
    );

INSERT INTO
    `users`
VALUES (
        1,
        'asdf',
        '$2y$10$TWOGcn52WbEc1Max4VyHd.NSfwvjdsX33Pg1EzHwhRgD52nb4Gr8m',
        '2024-11-09 13:16:41'
    ),
    (
        2,
        'admin',
        '$2y$10$7NrxXuvBphPd47EXgoXILOvZqqgRdVyVR/jlKoWhHWCq/E17J0cre',
        '2024-11-09 13:17:07'
    ),
    (
        3,
        'WojciechUlaski',
        '$2y$10$NKO7MsjErOspYfKyXct/YuVIGtzo9I1QjGYLRNnTyhkpzOSeX4hvy',
        '2024-11-10 11:39:29'
    );