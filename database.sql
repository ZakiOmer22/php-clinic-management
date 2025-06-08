CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'doctor', 'receptionist') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender ENUM('male', 'female') DEFAULT 'male',
    phone VARCHAR(20),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    doctor_name VARCHAR(100),
    appointment_date DATE,
    status ENUM('Pending', 'Completed', 'Cancelled', 'In Progress') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS prescriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    medicine TEXT,
    dosage VARCHAR(100),
    notes TEXT,
    prescribed_at DATE,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS lab_tests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    test_type VARCHAR(100),
    results TEXT,
    status ENUM('Pending', 'Completed') DEFAULT 'Pending',
    test_date DATE,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE SET NULL
);


INSERT INTO users (username, password, role) VALUES (
    'admin',
    'admin123',
    'admin'
);