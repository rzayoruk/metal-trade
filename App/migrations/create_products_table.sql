CREATE TABLE IF NOT EXISTS products(
    id SERIAL PRIMARY KEY,
    category_id INT REFERENCES categories(id) ON DELETE CASCADE,
    user_id INT REFERENCES users(id) ON DELETE SET NULL,
    title VARCHAR(255) NOT NULL,
    keywords TEXT,
    description TEXT,
    detail TEXT,
    price float8 NOT NULL,
    quantity INT DEFAULT 1,
    minquantity INT DEFAULT 1,
    tax INT DEFAULT 18,
    image VARCHAR(255),
    status BOOLEAN DEFAULT TRUE,
    slug VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CHECK (quantity >= minquantity)
    );


-- trigger func
CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER set_updated_at
BEFORE UPDATE ON products --important
FOR EACH ROW
EXECUTE FUNCTION update_updated_at_column();