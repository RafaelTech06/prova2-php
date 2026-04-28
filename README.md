# Sistema de Tarefas (To-Do List) - Avaliação PHP

Este projeto é uma aplicação de gerenciamento de tarefas desenvolvida para a avaliação de Desenvolvimento de Sistemas.

## Tecnologias Utilizadas
- PHP 8
- Banco de Dados MySQL
- Bootstrap 5 (Framework de Layout)
- PDO para conexão segura
- Sessões para autenticação

## Banco de Dados
Para rodar o projeto, execute o script abaixo no seu SGBD (como o phpMyAdmin) para criar o banco de dados e as tabelas:

```sql
CREATE DATABASE tarefas;
USE tarefas;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50) NOT NULL,
  senha VARCHAR(32) NOT NULL
);

CREATE TABLE tarefas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(100) NOT NULL,
  descricao TEXT,
  status ENUM('pendente', 'concluida') DEFAULT 'pendente',
  usuario_id INT NOT NULL,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Inserindo o usuário de teste
INSERT INTO usuarios (usuario, senha) VALUES ('admin', MD5('123456'));
```

## Como rodar o projeto
1. Crie o banco de dados usando o script acima.
2. Certifique-se de que a senha do seu MySQL no XAMPP é `ceub123456` ou altere no arquivo `conexao.php`.
3. Coloque a pasta do projeto no `htdocs` do XAMPP.
4. Acesse `http://localhost/prova2-php/login.php` no seu navegador.

## Usuário de Teste
- **Login:** admin
- **Senha:** 123456
