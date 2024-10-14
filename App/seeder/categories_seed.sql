INSERT INTO categories (id, parent_id, title) VALUES
(0,0, 'Main Category') 
ON CONFLICT DO NOTHING;
INSERT INTO categories (parent_id, title) VALUES
(0, 'Machine Part'), 
(0, 'Raw Material'),
(0, 'Copper Plate')
ON CONFLICT DO NOTHING;