CREATE DATABASE IF NOT EXISTS cybersecurity_services;
USE cybersecurity_services;

-- Drop tables in reverse order of dependencies
DROP TABLE IF EXISTS documents;
DROP TABLE IF EXISTS consultations;
DROP TABLE IF EXISTS regulatory_updates;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    username VARCHAR(80) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(30) NULL,
    account_type ENUM('admin', 'analyst', 'client') NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(50) NOT NULL,
    base_price DECIMAL(10, 2) NOT NULL
);

CREATE TABLE regulatory_updates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    content TEXT NOT NULL,
    published_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_regulatory_author FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE consultations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    scheduled_date DATETIME,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_consultation_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_consultation_service FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    consultation_id INT DEFAULT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_document_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_document_consultation FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE SET NULL
);

-- ==========================================
-- Sample Data
-- ==========================================

-- Insert Users
INSERT INTO users (full_name, email, username, password_hash, phone, account_type) VALUES
('Sarah Connor', 'sarah.c@cyberdyne.com', 'sconnor', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1-555-0192', 'admin'),
('Alex Vance', 'alex.v@cyberdefense.io', 'avance', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1-555-0143', 'analyst'),
('John Doe', 'john.doe@enterprise.com', 'jdoe', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1-555-0188', 'client'),
('Jane Smith', 'jane@fintechcorp.com', 'jsmith', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1-555-0177', 'client');

-- Insert Services
INSERT INTO services (title, description, category, base_price) VALUES
('Vulnerability Assessment', 'Comprehensive network and application security scan to identify known vulnerabilities.', 'Assessment', 1200.00),
('Penetration Testing', 'Simulated cyberattack against your systems to check for exploitable vulnerabilities.', 'Testing', 3500.00),
('Compliance Audit (ISO 27001)', 'Detailed review of organizational security controls against ISO 27001 standards.', 'Compliance', 2500.00);

-- Insert Regulatory Updates
INSERT INTO regulatory_updates (author_id, title, content, published_at) VALUES
(1, 'New GDPR Compliance Guidelines for 2026', 'The European Union has updated data retention requirements for cloud-stored PII...', '2026-06-01 09:00:00'),
(1, 'Critical Patch Notice: Enterprise Frameworks', 'All organizations utilizing legacy authentication frameworks must upgrade by Q3...', '2026-06-05 14:30:00');

-- Insert Consultations
INSERT INTO consultations (user_id, service_id, status, scheduled_date, notes) VALUES
(3, 1, 'Confirmed', '2026-06-10 10:00:00', 'Initial scoping meeting for cloud infrastructure audit.'),
(4, 2, 'Pending', '2026-06-12 14:30:00', 'Discussing scope for web application pen testing.');

-- Insert Documents
INSERT INTO documents (user_id, consultation_id, file_name, file_path) VALUES
(3, 1, 'network_topology_2026.pdf', '/uploads/secure/network_topology_2026.pdf'),
(4, 2, 'app_architecture_overview.docx', '/uploads/secure/app_architecture_overview.docx');