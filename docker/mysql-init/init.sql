USE test_db;

CREATE TABLE IF NOT EXISTS _test_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255),
    password VARCHAR(255),
    b64 VARCHAR(255)
);
