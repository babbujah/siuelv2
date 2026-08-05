/*
====================================================
SIUEL V2
CORE V1
====================================================
Autor: Bruno Cesar Lopes da Silva
Objetivo: Estrutura inicial do CORE
====================================================
*/

-- =================================================
-- GRUPO ESCOTEIRO
-- =================================================

CREATE TABLE grupo_escoteiro (
    grupo_id BIGINT NOT NULL AUTO_INCREMENT,

    numero VARCHAR(20) NOT NULL,
    nome VARCHAR(150) NOT NULL,

    registro_ueb VARCHAR(30) NULL,
    distrito VARCHAR(100) NULL,

    data_fundacao DATE NULL,

    cidade VARCHAR(100) NULL,
    uf CHAR(2) NULL,

    status CHAR(1) NOT NULL DEFAULT '1',

    data_criacao DATETIME NULL,
    data_modificacao DATETIME NULL,

    PRIMARY KEY (grupo_id)
);

-- =================================================
-- RAMO
-- =================================================

CREATE TABLE ramo (
    ramo_id BIGINT NOT NULL AUTO_INCREMENT,

    nome VARCHAR(80) NOT NULL,
    sigla VARCHAR(20) NOT NULL,

    idade_minima TINYINT,
    idade_maxima TINYINT,

    cor VARCHAR(20),

    status CHAR(1) NOT NULL DEFAULT '1',

    data_criacao DATETIME NULL,
    data_modificacao DATETIME NULL,

    PRIMARY KEY (ramo_id),

    UNIQUE KEY uk_ramo_nome (nome),
    UNIQUE KEY uk_ramo_sigla (sigla)
);

-- =================================================
-- CARGA INICIAL DOS RAMOS
-- =================================================

INSERT INTO ramo
(
    nome,
    sigla,
    idade_minima,
    idade_maxima
)
VALUES
('Filhotes','FIL',4,7),
('Lobinho','LOB',6,10),
('Escoteiro','ESC',11,14),
('Sênior','SEN',15,17),
('Pioneiro','PIO',18,22);

-- =================================================
-- UNIDADE ESCOTEIRA
-- =================================================

CREATE TABLE unidade_escoteira (
    unidade_escoteira_id BIGINT NOT NULL AUTO_INCREMENT,

    grupo_id BIGINT NOT NULL,
    ramo_id BIGINT NOT NULL,

    nome VARCHAR(120) NOT NULL,

    descricao TEXT NULL,

    status CHAR(1) NOT NULL DEFAULT '1',

    data_criacao DATETIME NULL,
    data_modificacao DATETIME NULL,

    PRIMARY KEY (unidade_escoteira_id),

    INDEX idx_unidade_grupo (grupo_id),
    INDEX idx_unidade_ramo (ramo_id),

    CONSTRAINT fk_unidade_grupo
        FOREIGN KEY (grupo_id)
        REFERENCES grupo_escoteiro(grupo_id),

    CONSTRAINT fk_unidade_ramo
        FOREIGN KEY (ramo_id)
        REFERENCES ramo(ramo_id)
);

-- =================================================
-- EQUIPE
-- =================================================

CREATE TABLE equipe (
    equipe_id BIGINT NOT NULL AUTO_INCREMENT,

    unidade_escoteira_id BIGINT NOT NULL,

    nome VARCHAR(120) NOT NULL,

    descricao TEXT NULL,

    tipo VARCHAR(50) NOT NULL,

    cor VARCHAR(20) NULL,

    status CHAR(1) NOT NULL DEFAULT '1',

    data_criacao DATETIME NULL,
    data_modificacao DATETIME NULL,

    PRIMARY KEY (equipe_id),

    INDEX idx_equipe_unidade (
        unidade_escoteira_id
    ),

    INDEX idx_equipe_tipo (
        tipo
    ),

    CONSTRAINT fk_equipe_unidade
        FOREIGN KEY (unidade_escoteira_id)
        REFERENCES unidade_escoteira(unidade_escoteira_id)
);

-- =================================================
-- PESSOA
-- =================================================

CREATE TABLE pessoa (
    pessoa_id INT NOT NULL AUTO_INCREMENT,

    nome VARCHAR(150) NOT NULL,

    cpf VARCHAR(11) NULL,

    data_nascimento DATE NOT NULL,

    genero CHAR(1) NULL,

    tipo_pessoa VARCHAR(30) NULL,

    status VARCHAR(20) DEFAULT '1',

    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,

    data_modificacao DATETIME NULL,

    PRIMARY KEY (pessoa_id)
);

-- =================================================
-- CONTATO
-- =================================================

CREATE TABLE contato (
    contato_id INT NOT NULL AUTO_INCREMENT,

    pessoa_id INT NULL,

    telefone1 VARCHAR(20) NULL,
    telefone2 VARCHAR(20) NULL,

    email VARCHAR(150) NULL,

    PRIMARY KEY (contato_id),

    KEY fk_contato_pessoa (pessoa_id),

    CONSTRAINT fk_contato_pessoa
        FOREIGN KEY (pessoa_id)
        REFERENCES pessoa (pessoa_id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
);

-- =================================================
-- ENDERECO
-- =================================================

CREATE TABLE endereco (
    endereco_id INT NOT NULL AUTO_INCREMENT,

    pessoa_id INT NULL,

    logradouro VARCHAR(255) NULL,
    numero VARCHAR(20) NULL,
    bairro VARCHAR(100) NULL,
    complemento VARCHAR(150) NULL,
    cidade VARCHAR(100) NULL,
    cep VARCHAR(10) NULL,

    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_modificacao DATETIME NULL,

    PRIMARY KEY (endereco_id),

    KEY fk_endereco_pessoa (pessoa_id),

    CONSTRAINT fk_endereco_pessoa
        FOREIGN KEY (pessoa_id)
        REFERENCES pessoa (pessoa_id)
);

-- =================================================
-- PESSOA RESPONSAVEL
-- =================================================

CREATE TABLE pessoa_responsavel (
    pessoa_responsavel_id BIGINT NOT NULL AUTO_INCREMENT,

    membro_juvenil_id INT NOT NULL,
    responsavel_id INT NOT NULL,

    parentesco VARCHAR(50) NULL,

    responsavel_principal BOOLEAN NOT NULL DEFAULT FALSE,

    recebe_comunicado BOOLEAN NOT NULL DEFAULT TRUE,

    permite_saida BOOLEAN NOT NULL DEFAULT FALSE,

    status CHAR(1) NOT NULL DEFAULT '1',

    data_criacao DATETIME NULL,
    data_modificacao DATETIME NULL,

    PRIMARY KEY (pessoa_responsavel_id),

    INDEX idx_pr_membro (
        membro_juvenil_id
    ),

    INDEX idx_pr_responsavel (
        responsavel_id
    ),

    CONSTRAINT fk_pr_membro
        FOREIGN KEY (membro_juvenil_id)
        REFERENCES pessoa(pessoa_id),

    CONSTRAINT fk_pr_responsavel
        FOREIGN KEY (responsavel_id)
        REFERENCES pessoa(pessoa_id)
);

-- =================================================
-- VINCULO
-- =================================================

CREATE TABLE vinculo (
    vinculo_id BIGINT NOT NULL AUTO_INCREMENT,

    pessoa_id INT NOT NULL,

    grupo_id BIGINT NOT NULL,

    ramo_id BIGINT NULL,

    unidade_escoteira_id BIGINT NULL,

    equipe_id BIGINT NULL,

    cargo_id BIGINT NULL,

    usuario_responsavel_id INT NULL,

    data_inicio DATE NOT NULL,

    data_fim DATE NULL,

    status CHAR(1) NOT NULL DEFAULT '1',

    motivo_encerramento VARCHAR(100) NULL,

    observacao TEXT NULL,

    data_criacao DATETIME NULL,

    data_modificacao DATETIME NULL,

    PRIMARY KEY (vinculo_id),

    INDEX idx_vinculo_pessoa (pessoa_id),
    INDEX idx_vinculo_grupo (grupo_id),
    INDEX idx_vinculo_ramo (ramo_id),
    INDEX idx_vinculo_unidade (unidade_escoteira_id),
    INDEX idx_vinculo_equipe (equipe_id),
    INDEX idx_vinculo_cargo (cargo_id),

    CONSTRAINT fk_vinculo_pessoa
        FOREIGN KEY (pessoa_id)
        REFERENCES pessoa(pessoa_id),

    CONSTRAINT fk_vinculo_grupo
        FOREIGN KEY (grupo_id)
        REFERENCES grupo_escoteiro(grupo_id),

    CONSTRAINT fk_vinculo_ramo
        FOREIGN KEY (ramo_id)
        REFERENCES ramo(ramo_id),

    CONSTRAINT fk_vinculo_unidade
        FOREIGN KEY (unidade_escoteira_id)
        REFERENCES unidade_escoteira(unidade_escoteira_id),

    CONSTRAINT fk_vinculo_equipe
        FOREIGN KEY (equipe_id)
        REFERENCES equipe(equipe_id),

    CONSTRAINT fk_vinculo_cargo
        FOREIGN KEY (cargo_id)
        REFERENCES cargo(cargo_id)
);