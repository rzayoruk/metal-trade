INSERT INTO roles (type) VALUES ('member'), ('admin') 
ON CONFLICT DO NOTHING;

