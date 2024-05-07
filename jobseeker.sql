-- Create DB
CREATE DATABASE IF NOT EXISTS jobseeker;

-- Use the database
USE jobseeker;

-- Create the t_user table
CREATE TABLE IF NOT EXISTS t_user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    status VARCHAR(1) NOT NULL CHECK (status IN ('0', '1')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP
);

-- Create the user sample data
INSERT INTO t_user (email, password, status) VALUES ('test@mail.com', '$2a$12$SuEZs7fdMRLQiRX796K6neRAKyxHQ11A.HA5ofJgwpX1Fh4ZG1Mbq', '1');

-- Create the t_candidate table
CREATE TABLE IF NOT EXISTS t_candidate (
    candidate_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone_number VARCHAR(20) UNIQUE NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    dob DATE,
    pob VARCHAR(255),
    gender VARCHAR(1) NOT NULL CHECK (gender IN ('F', 'M')),
    year_exp INT NOT NULL,
    last_salary VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP
);

--Create sample data for t_candidate
INSERT INTO t_candidate (email, phone_number, full_name, dob, pob, gender, year_exp, last_salary) VALUES (
    'test@mail.com', '08123456789', 'Test Candidate', '1990-01-01', 'Jakarta', 'M', 5, '10000000');

-- Create the t_vacancy table
CREATE TABLE IF NOT EXISTS t_vacancy (
    vacancy_id INT AUTO_INCREMENT PRIMARY KEY,
    vacancy_name VARCHAR(255) NOT NULL,
    minimum_exp INT NOT NULL,
    created_date DATETIME NOT NULL,
    expired_date DATETIME NOT NULL,
    flag_status VARCHAR(1) NOT NULL CHECK (flag_status IN ('0', '1')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP,
    INDEX idx_created_date (created_date)
);

-- Create sample data for t_vacancy
INSERT INTO t_vacancy (vacancy_name, minimum_exp, created_date, expired_date, flag_status) VALUES (
    'Software Engineer', 3, '2021-01-01 00:00:00', '2021-04-01 00:00:00', '1');

-- Create the t_application table
CREATE TABLE IF NOT EXISTS t_application (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT,
    vacancy_id INT,
    application_date DATETIME,
    application_status VARCHAR(1) NOT NULL CHECK (application_status IN ('0', '1', '2')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP,
    FOREIGN KEY (candidate_id) REFERENCES t_candidate(candidate_id),
    FOREIGN KEY (vacancy_id) REFERENCES t_vacancy(vacancy_id)
);

-- Create trigger for setting expired_date in t_vacancy
DELIMITER //
CREATE TRIGGER IF NOT EXISTS set_expired_date BEFORE INSERT ON t_vacancy
FOR EACH ROW
BEGIN
    SET NEW.expired_date = NEW.created_date + INTERVAL 3 MONTH;
END;
//
DELIMITER ;
