INSERT INTO users (name, surname, email, password, role_id) VALUES 
('John', 'Doe', 'john@example.com', 'hashed_password', 1), 
('Admin', 'User', 'admin@example.com', 'hashed_password', 2)
ON CONFLICT DO NOTHING;