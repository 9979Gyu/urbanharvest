DROP TABLE IF EXISTS BOOKING;
DROP TABLE IF EXISTS PLOT;
DROP TABLE IF EXISTS GARDEN;
DROP TABLE IF EXISTS ANSWER;
DROP TABLE IF EXISTS QUESTION;
DROP TABLE IF EXISTS USER;
DROP TABLE IF EXISTS ROLE;

CREATE TABLE IF NOT EXISTS ROLE (
    roleID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    status INT NOT NULL
);

CREATE TABLE IF NOT EXISTS USER (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    contactNo VARCHAR(255) UNIQUE NOT NULL,
    homeAddress VARCHAR(255) NOT NULL,
    status INT NOT NULL,
    password TEXT NOT NULL,
    roleID INT NOT NULL,
    CONSTRAINT FOREIGN KEY (roleID) REFERENCES ROLE(roleID) 
);

CREATE TABLE IF NOT EXISTS GARDEN (
    gardenID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    status INT NOT NULL
);

CREATE TABLE IF NOT EXISTS PLOT (
    plotID INT AUTO_INCREMENT PRIMARY KEY,
    size VARCHAR(255) NOT NULL,
    availability INT NOT NULL,
    status INT NOT NULL,
    gardenID INT NOT NULL,
    CONSTRAINT FOREIGN KEY (gardenID) REFERENCES GARDEN(gardenID)
);

CREATE TABLE IF NOT EXISTS BOOKING (
    bookingID INT AUTO_INCREMENT PRIMARY KEY,
    bookDateTime DateTime NOT NULL,
    paymentStatus INT NOT NULL,
    paymentDateTime DateTime,
    paidAmount DECIMAL(8, 2),
    bookYear INT NOT NULL,
    bookApproval INT NOT NULL,
    isExtend INT NOT NULL,
    status INT NOT NULL,
    plotID INT NOT NULL,
    userID INT NOT NULL,
    CONSTRAINT FOREIGN KEY (plotID) REFERENCES PLOT(plotID),
    CONSTRAINT FOREIGN KEY (userID) REFERENCES USER(userID)
);

CREATE TABLE IF NOT EXISTS QUESTION (
    questionID INT AUTO_INCREMENT PRIMARY KEY,
    sentence VARCHAR(255) NOT NULL,
    status INT NOT NULL
);

CREATE TABLE IF NOT EXISTS ANSWER (
    answerID INT AUTO_INCREMENT PRIMARY KEY,
    answerSentence VARCHAR(255) NOT NULL,
    status INT NOT NULL,
    questionID INT NOT NULL,
    userID INT NOT NULL,
    CONSTRAINT FOREIGN KEY (questionID) REFERENCES QUESTION(questionID),
    CONSTRAINT FOREIGN KEY (userID) REFERENCES USER(userID)
);

INSERT INTO ROLE (name, description, status) VALUES
("Admin", "People who are responsible for managing staff", 1),
("Staff", "People who are responsible for managing customers, gardens, and bookings", 1),
("Customer", "People who use the system to book a plot", 1);

INSERT INTO USER (firstName, lastName, email, contactNo, homeAddress, roleID, status, password) VALUES
("Yu Qin", "Gui", "yuqin1161@gmail.com", "0129231224", "Taman Desa Idaman", 1, 1, "$2y$10$jeEqDXuloNsvSCb.ecKBhew6IW02MSI/DQ1OZ1FtYL4yC7lsoZrnm"),
("is me", "Customer", "customer@gmail.com", "0129232345", "Taman Desa Idaman", 3, 1, "$2y$10$dCVTF.1P/gUO.R6Pce5Fw.fNAHAh1lDm3WjJzEW5kvDStmK2S.cnS");

INSERT INTO GARDEN (name, address, status) VALUES
('Taman Desa Idaman', 'Taman Desa Idaman, 76100, Durian Tunggal, Melaka', 1),
('Taman Nuri Sentosa', 'Kampung Tengah, 76100 Durian Tunggal, Melaka', 1),
('Taman Daya', 'Taman Daya, 81100 Johor Bahru, Johor', 1);

INSERT INTO PLOT (size, gardenID, status, availability) VALUES
('12 x 30', 1, 1, 1),
('12 x 30', 2, 1, 1),
('12 x 30', 3, 1, 1);

INSERT INTO QUESTION (sentence, status) VALUES
("What high school did you attend?", 1),
("In which city were you born?", 1),
("What is the name of your first pet?", 1),
("What is your favorite movie?", 1),
("What is the name of your favorite teacher from school?", 1);