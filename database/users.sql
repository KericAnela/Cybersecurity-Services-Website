CREATE DATABASE IF NOT EXISTS cybersecurity_services;
USE cybersecurity_services;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    username VARCHAR(80) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(30) NULL,
    account_type ENUM('admin', 'analyst', 'client') NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_account_type CHECK (account_type IN ('admin', 'analyst', 'client'))
);