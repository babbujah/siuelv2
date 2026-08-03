USE siuelv2negociodb;

CREATE TABLE siuelv2negociodb.pessoa (
    pessoa_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL,
    genero ENUM('M', 'F'),
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_modificacao DATETIME
);

CREATE TABLE siuelv2negociodb.endereco (
	endereco_id INT AUTO_INCREMENT PRIMARY KEY,
	pessoa_id INT,
	logradouro VARCHAR(255),
	numero VARCHAR(10),
	bairro VARCHAR(255),
	complemento VARCHAR(255),
	cidade VARCHAR(255),
	cep VARCHAR(10),
	data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
	data_modificacao DATETIME,
	
	CONSTRAINT fk_endereco_pessoa
		FOREIGN KEY(pessoa_id)
		REFERENCES pessoa(pessoa_id)
);

CREATE TABLE siuelv2negociodb.contato(
	contato_id INT AUTO_INCREMENT PRIMARY KEY,
	pessoa_id INT,
	telefone1 VARCHAR(11),
	telefone2 VARCHAR(11),
	email VARCHAR(128),
	
	CONSTRAINT fk_contato_pessoa
		FOREIGN KEY(pessoa_id)
		REFERENCES pessoa(pessoa_id)
);