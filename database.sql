-- Cipta pangkalan data
CREATE DATABASE IF NOT EXISTS facility_booking;
USE facility_booking;

-- Jadual 1: facilities
CREATE TABLE IF NOT EXISTS facilities (
    facility_id INT AUTO_INCREMENT PRIMARY KEY,
    facility_name VARCHAR(100) NOT NULL,
    facility_type VARCHAR(50) NOT NULL,
    location VARCHAR(100) NOT NULL,
    capacity INT NOT NULL,
    status VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Jadual 2: bookings
CREATE TABLE IF NOT EXISTS bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    facility_id INT NOT NULL,
    booking_name VARCHAR(100) NOT NULL,
    booking_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    booking_created DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_facility FOREIGN KEY (facility_id) 
        REFERENCES facilities(facility_id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data contoh awal (Dummy Data) untuk memudahkan rakan buat testing
INSERT INTO facilities (facility_name, facility_type, location, capacity, status) VALUES
('Discussion Room', 'Meeting Room', 'Block A', 20, 'Unavailable'),
('Computer Lab 1', 'Computer Lab', 'Block B', 30, 'Available'),
('Seminar Room', 'Seminar Room', 'Block C', 50, 'Available');