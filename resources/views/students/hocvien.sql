CREATE DATABASE quanlyhocvien;
USE quanlyhocvien;

CREATE TABLE hocvien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_sv VARCHAR(10) NOT NULL,
    ho_ten VARCHAR(100) NOT NULL,
    gioi_tinh ENUM('Nam', 'Nữ') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    dia_chi VARCHAR(255) NOT NULL
);
