CREATE DATABASE biblioteca_crud;
USE biblioteca_crud;

CREATE TABLE autores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    ano DATE NOT NULL
);

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    genero VARCHAR(30) NOT NULL,
    ano DATE NOT NULL,
    autores_id INT NOT NULL,
    FOREIGN KEY (autores_id) REFERENCES autores(id)
);

CREATE TABLE leitores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone INT NOT NULL
);

CREATE TABLE emprestimos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_emprestimos DATE NOT NULL,
    data_devolucao DATE NOT NULL,
    livros_id INT NOT NULL,
    leitores_id INT NOT NULL,
    FOREIGN KEY (livros_id) REFERENCES livros(id),
    FOREIGN KEY (leitores_id) REFERENCES leitores(id)
);

