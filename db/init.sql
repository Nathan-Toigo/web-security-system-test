CREATE TABLE User (
    id INT PRIMARY KEY AUTO_INCREMENT,
    lastname VARCHAR(50),
    firstname VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    address VARCHAR(255),
    password VARCHAR(255)
);

CREATE TABLE Post (
    id INT PRIMARY KEY AUTO_INCREMENT,
    creator_id INT,
    title VARCHAR(255),
    content TEXT,
    created_at DATETIME,
    FOREIGN KEY (creator_id) REFERENCES User(id)
);

CREATE TABLE Document (
    id INT PRIMARY KEY AUTO_INCREMENT,
    path VARCHAR(255)
);

INSERT INTO User (lastname, firstname, email, address, password) VALUES
('Smith', 'John', 'john.smith@example.com', '123 Main St, Cityville', 'password123'),
('Doe', 'Jane', 'jane.doe@example.com', '456 Oak Ave, Townsville', 'securepass456'),
('Brown', 'Charlie', 'charlie.brown@example.com', '789 Pine Rd, Village', 'charlie789');

INSERT INTO Post (creator_id, title, content, created_at) VALUES
(1, 'Adventures in Coding', 'Today I solved a tricky bug that had been haunting me for days. The feeling of finally seeing all tests pass was amazing!', '2023-10-01 10:00:00'),
(1, 'A Day at the Hackathon', 'Spent 24 hours building a smart plant watering system with my team. We learned a lot and even won a prize for creativity!', '2023-10-02 11:00:00'),
(2, 'Why I Love Open Source', 'Contributing to open source projects has helped me grow as a developer and connect with amazing people around the world.', '2023-10-03 12:00:00');

INSERT INTO Document (path) VALUES
('Document1.txt'),
('Document2.txt'),
('Document3.txt'),
('Document4.txt');