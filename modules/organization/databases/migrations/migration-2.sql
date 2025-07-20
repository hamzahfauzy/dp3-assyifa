CREATE TABLE organization_positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_id INT DEFAULT NULL,
    organization_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    record_type VARCHAR(100) NOT NULL,
    CONSTRAINT fk_organization_positions_organization_id FOREIGN KEY (organization_id) REFERENCES organizations(id) ON DELETE CASCADE,
    CONSTRAINT fk_organization_positions_parent_id FOREIGN KEY (parent_id) REFERENCES organization_positions(id) ON DELETE SET NULL
);

CREATE TABLE organization_user_positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    organization_user_id INT NOT NULL,
    position_id INT NOT NULL,
    start_at DATE NOT NULL,
    end_at DATE NOT NULL,
    CONSTRAINT fk_organization_user_positions_organization_user_id FOREIGN KEY (organization_user_id) REFERENCES organization_users(id) ON DELETE CASCADE,
    CONSTRAINT fk_organization_user_positions_position_id FOREIGN KEY (position_id) REFERENCES organization_positions(id) ON DELETE CASCADE
);