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