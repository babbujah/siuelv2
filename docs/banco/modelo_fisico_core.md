## Pessoa

### Tabela
pessoa

### Chave Primária
- pessoa_id BIGINT PK

### Chave Estrangeira
- system_user_id -> system_user.id

### Campos
- pessoa_id BIGINT PK
- system_user_id BIGINT FK NULL
- nome VARCHAR(150) NOT NULL
- nome_social VARCHAR(150) NULL
- cpf VARCHAR(14) UNIQUE NULL
- rg VARCHAR(30) NULL
- data_nascimento DATE NULL
- genero VARCHAR(20) NULL
- email VARCHAR(150) NULL
- telefone_principal VARCHAR(20) NULL
- status CHAR(1)
- data_criacao TIMESTAMP
- data_modificacao TIMESTAMP

## PessoaResponsavel

### Tabela
pessoa_responsavel

### Chave Primária
- pessoa_responsavel_id BIGINT PK

### Chave Estrangeira
- membro_juvenil_id -> pessoa.pessoa_id
- responsavel_id -> pessoa.pessoa_id

### Campos
- pessoa_responsavel_id BIGINT PK
- membro_juvenil_id BIGINT FK
- responsavel_id BIGINT FK
- parentesco VARCHAR(50)
- responsavel_principal BOOLEAN
- recebe_comunicado BOOLEAN
- permite_saida BOOLEAN
- status CHAR(1)
- data_criacao DATETIME NULL
- data_modificacao DATETIME NULL

## GrupoEscoteiro

### Tabela
grupo_escoteiro

### Chave Primária
- grupo_id BIGINT UNSIGNED AUTO_INCREMENT

### Campos
- grupo_id BIGINT UNSIGNED NOT NULL
- registro_ueb VARCHAR(30) NULL
- distrito VARCHAR(100) NULL
- numero VARCHAR(20) NOT NULL
- nome VARCHAR(150) NOT NULL
- data_fundacao DATE NULL
- cidade VARCHAR(100) NULL
- uf CHAR(2) NULL
- status CHAR(1) NOT NULL DEFAULT '1'
- data_criacao DATETIME NULL
- data_modificacao DATETIME NULL

### Índices
- PK grupo_id
- INDEX numero
- INDEX nome

### Regras
- Representa um Grupo Escoteiro.
- Deve permitir futuramente múltiplos grupos.


## UnidadeEscoteira

### Tabela
unidade_escoteira

### Chave Primária
- unidade_escoteira_id BIGINT UNSIGNED AUTO_INCREMENT

### Chaves Estrangeiras
- grupo_id → grupo_escoteiro.grupo_id
- ramo_id → ramo.ramo_id

### Campos
- unidade_escoteira_id BIGINT UNSIGNED NOT NULL
- grupo_id BIGINT UNSIGNED NOT NULL
- ramo_id BIGINT UNSIGNED NOT NULL
- nome VARCHAR(120) NOT NULL
- descricao TEXT NULL
- status CHAR(1) NOT NULL DEFAULT '1'
- data_criacao DATETIME NULL
- data_modificacao DATETIME NULL

### Índices
- PK unidade_escoteira_id
- INDEX grupo_id
- INDEX ramo_id

### Regras
- Representa Alcateia, Tropa Escoteira, Tropa Sênior e Clã Pioneiro.
- Cada Unidade Escoteira pertence a um Grupo Escoteiro.
- Cada Unidade Escoteira pertence a um Ramo.

## Ramo

### Tabela
ramo

### Chave Primária
- ramo_id BIGINT UNSIGNED AUTO_INCREMENT

### Campos
- ramo_id BIGINT UNSIGNED NOT NULL
- nome VARCHAR(80) NOT NULL
- sigla VARCHAR(20) NOT NULL
- idade_minima TINYINT UNSIGNED NULL
- idade_maxima TINYINT UNSIGNED NULL
- cor VARCHAR(20) NULL
- status CHAR(1) NOT NULL DEFAULT '1'
- data_criacao DATETIME NULL
- data_modificacao DATETIME NULL

### Índices
- PK ramo_id
- UNIQUE nome
- UNIQUE sigla

### Regras
- Representa Filhotes, Lobinho, Escoteiro, Sênior e Pioneiro.


## Equipe

### Tabela
equipe

### Chave Primária
- equipe_id BIGINT UNSIGNED AUTO_INCREMENT

### Chaves Estrangeiras
- unidade_escoteira_id → unidade_escoteira.unidade_escoteira_id

### Campos
- equipe_id BIGINT UNSIGNED NOT NULL
- unidade_escoteira_id BIGINT UNSIGNED NOT NULL
- nome VARCHAR(120) NOT NULL
- descricao TEXT NULL
- tipo VARCHAR(50) NOT NULL
- cor VARCHAR(20) NULL
- status CHAR(1) NOT NULL DEFAULT '1'
- data_criacao DATETIME NULL
- data_modificacao DATETIME NULL

### Índices
- PK equipe_id
- INDEX unidade_escoteira_id
- INDEX tipo

### Regras
- Representa Matilha, Patrulha, Clã, Equipe de Interesse ou Equipe de Serviço.
- Cada Equipe pertence a uma Unidade Escoteira.


## Cargo

### Tabela
cargo

### Chave Primária
- cargo_id BIGINT UNSIGNED AUTO_INCREMENT

### Campos
- cargo_id BIGINT UNSIGNED NOT NULL
- nome VARCHAR(100) NOT NULL
- categoria VARCHAR(50)
- descricao TEXT NULL
- area VARCHAR(50) NULL
- nivel_permissao VARCHAR(50) NULL
- status CHAR(1) NOT NULL DEFAULT '1'
- data_criacao DATETIME NULL
- data_modificacao DATETIME NULL

### Índices
- PK cargo_id
- UNIQUE nome
- INDEX area

### Regras
- Representa funções exercidas dentro do Grupo Escoteiro.
- Não substitui o controle de acesso do Adianti.


## Vinculo

### Tabela
vinculo

### Chave Primária
- vinculo_id BIGINT UNSIGNED AUTO_INCREMENT

### Chaves Estrangeiras
- pessoa_id → pessoa.pessoa_id
- grupo_id → grupo_escoteiro.grupo_id
- ramo_id → ramo.ramo_id
- unidade_escoteira_id → unidade_escoteira.unidade_escoteira_id
- equipe_id → equipe.equipe_id
- cargo_id → cargo.cargo_id

### Campos
- vinculo_id BIGINT UNSIGNED NOT NULL
- pessoa_id BIGINT UNSIGNED NOT NULL
- grupo_id BIGINT UNSIGNED NOT NULL
- ramo_id BIGINT UNSIGNED NULL
- unidade_escoteira_id BIGINT UNSIGNED NULL
- equipe_id BIGINT UNSIGNED NULL
- cargo_id BIGINT UNSIGNED NULL
- usuario_responsavel_id INT UNSIGNED NULL
- data_inicio DATE NOT NULL
- data_fim DATE NULL
- status CHAR(1) NOT NULL DEFAULT '1'
- motivo_encerramento VARCHAR(100) NULL
- observacao TEXT NULL
- data_criacao DATETIME NULL
- data_modificacao DATETIME NULL

### Índices
- PK vinculo_id
- INDEX pessoa_id
- INDEX grupo_id
- INDEX ramo_id
- INDEX unidade_escoteira_id
- INDEX equipe_id
- INDEX cargo_id

### Regras
- Guarda o histórico completo de participação da pessoa.
- Uma pessoa pode possuir múltiplos vínculos.
- data_fim nula indica vínculo ativo.
- equipe_id pode ser nulo.
- cargo_id pode ser nulo.


## Integração com Adianti

Controle de acesso reutilizado:

- system_user
- system_group
- system_program
- system_user_group
- system_group_program

A entidade Pessoa poderá ser vinculada a system_user através do campo system_user_id.