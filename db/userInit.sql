CREATE TABLE User (
    id INT PRIMARY KEY,
    lastname VARCHAR(50),
    firstname VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    address VARCHAR(255),
    password VARCHAR(255)
);

INSERT INTO User (id, lastname, firstname, email, address, password) VALUES
(1, 'Smith', 'John', 'john.smith@example.com', '123 Main St, Cityville', 'password123'),
(2, 'Doe', 'Jane', 'jane.doe@example.com', '456 Oak Ave, Townsville', 'securepass456'),
(3, 'Brown', 'Charlie', 'charlie.brown@example.com', '789 Pine Rd, Village', 'charlie789');