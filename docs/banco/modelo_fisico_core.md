# Pessoa

## Chave Primária

- pessoa_id

## Campos

- pessoa_id
- nome
- cpf
- data_nascimento
- genero
- email
- telefone_principal
- tipo_pessoa
- status
- data_criacao
- data_modificacao

## Regras

- CPF deve ser único
- Nome é obrigatório
- Status é obrigatório
- Data de criação automática
- Data de modificação automática

# PessoaResponsavel

## Chave Primária

- pessoa_responsavel_id

## Chaves Estrangeiras

- pessoa_id → Pessoa
- responsavel_id → Pessoa

## Campos

- pessoa_responsavel_id
- pessoa_id
- responsavel_id
- parentesco
- responsavel_principal

## Regras

- Uma pessoa pode possuir vários responsáveis
- Um responsável pode possuir vários dependentes
- Deve existir apenas um responsável principal

# Ramo

## Chave Primária

- ramo_id

## Campos

- ramo_id
- nome
- sigla
- idade_minima
- idade_maxima
- cor
- status

## Regras

- Nome único
- Sigla única

# Equipe

## Chave Primária

- equipe_id

## Chaves Estrangeiras

- ramo_id → Ramo

## Campos

- equipe_id
- ramo_id
- nome
- tipo
- cor
- status

## Regras

- Cada equipe pertence a um ramo

# Cargo

## Chave Primária

- cargo_id

## Campos

- cargo_id
- nome
- descricao
- area
- status

## Regras

- Nome único

# Vinculo

## Chave Primária

- vinculo_id

## Chaves Estrangeiras

- pessoa_id → Pessoa
- ramo_id → Ramo
- equipe_id → Equipe
- cargo_id → Cargo

## Campos

- vinculo_id
- pessoa_id
- ramo_id
- equipe_id
- cargo_id
- data_inicio
- data_fim
- status
- observacao

## Regras

- Uma pessoa pode possuir vários vínculos
- Vínculo guarda histórico
- Data fim pode ser nula

# Usuario

## Chave Primária

- usuario_id

## Chave Estrangeira

- pessoa_id → Pessoa

## Campos

- usuario_id
- pessoa_id
- login
- email_login
- ultimo_acesso
- ativo

## Regras

- Login único
- Pessoa possui apenas um usuário