-- File: create_rsvp_table.sql

-- Hapus tabel jika sudah ada
DROP TABLE IF EXISTS rsvp;

-- Buat tabel rsvp
CREATE TABLE rsvp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    jumlah INT NOT NULL,
    status TINYINT NOT NULL,
    phone_number VARCHAR(20),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tambahkan beberapa data contoh jika diperlukan
-- INSERT INTO rsvp (name, jumlah, status, phone_number) VALUES ('John Doe', 2, 1, '+62895399611119');
