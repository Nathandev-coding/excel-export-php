CREATE TABLE patients(
    id int AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(20) NOT NULL,
    prennom VARCHAR(20) NOT NULL,
    age int NOT NULL,
    sexe VARCHAR(20) NOT NULL,
    telephone int NOT NULL,
    adresse VARCHAR(50)NOT NULL,
    created_at DATE current_timestamp()	

);