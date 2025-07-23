-- migration-1.sql

CREATE TABLE standard_parameters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT DEFAULT NULL,
    description TEXT DEFAULT NULL,
    target_description TEXT DEFAULT NULL,
    achievement_strategy TEXT DEFAULT NULL,
    budget FLOAT(11,2) DEFAULT NULL,
    record_type VARCHAR(50) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE target_indicators (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parameter_id INT DEFAULT NULL,
    description TEXT DEFAULT NULL,
    achievement_target FLOAT(11,2) DEFAULT NULL,
    baseline FLOAT(11,2) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (parameter_id) REFERENCES standard_parameters(id) ON DELETE CASCADE
);

CREATE TABLE performances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parameter_id INT DEFAULT NULL,
    indicator_id INT DEFAULT NULL,
    description TEXT DEFAULT NULL,
    status VARCHAR(50) DEFAULT NULL,
    weight_target INT DEFAULT NULL,
    actual_target INT DEFAULT NULL,
    actual_value INT DEFAULT NULL,
    start_date DATE DEFAULT NULL,
    end_date DATE DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (parameter_id) REFERENCES standard_parameters(id) ON DELETE CASCADE,
    FOREIGN KEY (indicator_id) REFERENCES target_indicators(id) ON DELETE CASCADE
);

CREATE TABLE performance_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    performance_id INT DEFAULT NULL,
    description TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (performance_id) REFERENCES performances(id) ON DELETE CASCADE
);

CREATE TABLE performance_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    performance_id INT DEFAULT NULL,
    user_id INT DEFAULT NULL,
    content TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (performance_id) REFERENCES performances(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE performance_users (
    performance_id INT NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY (performance_id, user_id),
    FOREIGN KEY (performance_id) REFERENCES performances(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE performance_files (
    performance_id INT NOT NULL,
    file_name VARCHAR(100) NOT NULL,
    file_url VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (performance_id, file_name),
    FOREIGN KEY (performance_id) REFERENCES performances(id) ON DELETE CASCADE
);
