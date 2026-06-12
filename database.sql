-- បង្កើត Database
CREATE DATABASE IF NOT EXISTS it_asset_db;
USE it_asset_db;

-- បង្កើតតារាង equipment
CREATE TABLE IF NOT EXISTS equipment (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    serial_number VARCHAR(100) UNIQUE,
    category VARCHAR(100),
    status VARCHAR(50),
    assigned_to VARCHAR(255),
    purchase_date DATE,
    price DECIMAL(10,2),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- បញ្ចូលទិន្នន័យសាកល្បង
INSERT INTO equipment (name, serial_number, category, status, assigned_to, purchase_date, price, notes) VALUES
('Laptop Dell XPS 15', 'SN-DELL-001', 'កុំព្យូទ័រ', 'កំពុងប្រើប្រាស់', 'សុខ សុភ័ក្រ', '2024-01-15', 1299.99, 'Laptop for development team'),
('Monitor LG 24 inch', 'SN-LG-002', 'ម៉ូនីទ័រ', 'ស្តុកទុក', 'ឃុន សុផល', '2024-02-20', 249.99, 'Spare monitor'),
('Cisco Router', 'SN-CSCO-003', 'បណ្តាញ', 'កំពុងជួសជុល', 'ម៉ែន រតនា', '2023-11-10', 899.99, 'Network router for main office'),
('Keyboard Mechanical', 'SN-KB-004', 'គ្រឿងបន្ថែម', 'កំពុងប្រើប្រាស់', 'ចាន់ ធីតា', '2024-03-05', 89.99, 'Gaming keyboard'),
('UPS 1000VA', 'SN-UPS-005', 'គ្រឿងបន្ថែម', 'ស្តុកទុក', 'ផៃ រតនា', '2024-01-20', 159.99, 'Backup power');