INSERT INTO categories (title) VALUES
('Machine Part'), 
('Raw Material'),
('Copper Plate')
ON CONFLICT DO NOTHING;