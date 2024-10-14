INSERT INTO roles (role) VALUES ('member'), ('admin') 
ON CONFLICT DO NOTHING;

