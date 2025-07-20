CREATE TABLE organization_presences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    organization_id INT DEFAULT NULL,
    user_id INT NOT NULL,
    record_type VARCHAR(100) NOT NULL,
    start_at DATETIME NOT NULL,
    end_at DATETIME NOT NULL,
    description TEXT NULL,
    
    CONSTRAINT fk_organization_presences_organization_id FOREIGN KEY (organization_id) REFERENCES organizations(id) ON DELETE CASCADE,
    CONSTRAINT fk_organization_presences_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE organization_presence_media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    presence_id INT NOT NULL,
    media_id INT NOT NULL,
    status VARCHAR(100) NOT NULL,
    updated_by INT NOT NULL,
    
    CONSTRAINT fk_organization_presence_media_presence_id FOREIGN KEY (presence_id) REFERENCES organization_presences(id) ON DELETE CASCADE,
    CONSTRAINT fk_organization_presence_media_media_id FOREIGN KEY (media_id) REFERENCES media(id) ON DELETE CASCADE,
    CONSTRAINT fk_organization_presence_media_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE CASCADE
);