CREATE DATABASE cantina;

USE cantina;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    preco DECIMAL(10,2),
    imagem VARCHAR(255)
);

INSERT INTO produtos (nome, preco, imagem) VALUES
    ('Lasanha à Bolonhesa', 45.00, 'lasanha.png'),
    ('Spaghetti ao Pesto', 36.50, 'spaghetti.jpg'),
    ('Tiramisu Tradicional', 22.00, 'tiramisu.jpg');

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100),
    produto_id INT,
    quantidade INT,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);
