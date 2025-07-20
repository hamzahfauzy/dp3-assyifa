CREATE TABLE organizations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_id INT DEFAULT NULL,
    name VARCHAR(100) NOT NULL,
    record_type VARCHAR(100) NOT NULL,
    CONSTRAINT fk_organizations_parent_id FOREIGN KEY (parent_id) REFERENCES organizations(id) ON DELETE SET NULL
);

CREATE TABLE organization_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    organization_id INT NOT NULL,
    user_id INT NOT NULL,
    role VARCHAR(100) DEFAULT NULL,
    CONSTRAINT fk_organization_users_organization_id FOREIGN KEY (organization_id) REFERENCES organizations(id) ON DELETE CASCADE,
    CONSTRAINT fk_organization_users_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);