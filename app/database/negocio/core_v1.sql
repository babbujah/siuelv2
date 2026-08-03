/*
=========================================
SIUEL V2
CORE V1
=========================================
*/

SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE grupo_escoteiro (
    grupo_id BIGINT UNSIGNED AUTO_INCREMENT,

    registro_ueb VARCHAR(30),
    distrito VARCHAR(100),

    numero VARCHAR(20) NOT NULL,
    nome VARCHAR(150) NOT NULL,

    data_fundacao DATE,

    cidade VARCHAR(100),
    uf CHAR(2),

    status CHAR(1) NOT NULL DEFAULT '1',

    data_criacao DATETIME,
    data_modificacao DATETIME,

    PRIMARY KEY (grupo_id),

    INDEX idx_grupo_numero (numero),
    INDEX idx_grupo_nome (nome)
);


SET FOREIGN_KEY_CHECKS = 1;