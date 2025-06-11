CREATE TABLE User (
    id INT PRIMARY KEY,
    lastname VARCHAR(50),
    firstname VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    address VARCHAR(255),
    password VARCHAR(255)
);

CREATE TABLE Post (
    id INT PRIMARY KEY,
    creator_id INT,
    title VARCHAR(255),
    content TEXT,
    created_at DATETIME,
    FOREIGN KEY (creator_id) REFERENCES User(id)
);

INSERT INTO User (id, lastname, firstname, email, address, password) VALUES
(1, 'Smith', 'John', 'john.smith@example.com', '123 Main St, Cityville', 'password123'),
(2, 'Doe', 'Jane', 'jane.doe@example.com', '456 Oak Ave, Townsville', 'securepass456'),
(3, 'Brown', 'Charlie', 'charlie.brown@example.com', '789 Pine Rd, Village', 'charlie789');

INSERT INTO Post (id, creator_id, title, content, created_at) VALUES
(1, 1, 'Adventures in Coding', 'Today I solved a tricky bug that had been haunting me for days. The feeling of finally seeing all tests pass was amazing!', '2023-10-01 10:00:00'),
(2, 1, 'A Day at the Hackathon', 'Spent 24 hours building a smart plant watering system with my team. We learned a lot and even won a prize for creativity!', '2023-10-02 11:00:00'),
(3, 2, 'Why I Love Open Source', 'Contributing to open source projects has helped me grow as a developer and connect with amazing people around the world.', '2023-10-03 12:00:00');