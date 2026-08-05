#### Pessoa

pessoa_id

nome
cpf

data_nascimento

genero

tipo_pessoa

status

data_criacao
data_modificacao

Obs.: Ajustar futuramente para não ter mais tipo_pessoa. Deixar essa responsabilidade com Vínculo

#### Contato

contato_id

pessoa_id

telefone1
telefone2

email

#### Endereco

endereco_id

pessoa_id

logradouro
numero

bairro
complemento

cidade

cep

data_criacao
data_modificacao

### PessoaResponsavel

pessoa_responsavel_id

membro_juvenil_id

responsavel_id

parentesco

responsavel_principal

recebe_comunicado

permite_saida

### Unidade Escoteira

unidade_escoteira_id

grupo_id

ramo_id

nome

status

descricao

### Ramo

ramo_id

nome
sigla

idade_minima
idade_maxima

cor

status

### Equipe

equipe_id

ramo_id

nome

descricao

tipo

cor

status

### Cargo

cargo_id

nome

categoria

descricao

area

nivel_permissao

status

Exemplo nome:

- Chefe de Seção
- Assistente de Seção
- Diretor Presidente
- Diretor Financeiro
- Diretor Administrativo
- Diretor de Métodos Educativos
- Comissão Fiscal
- Técnico de Informática

Exemplo categoria:

- Escotista
- Diretoria
- Técnico
- Fiscal
- Apoio

Exemplo área:

- Administrativo
- Educativo
- Apoio
- Diretoria

### Vínculo

grupo_id

unidade_escoteira_id

usuario_responsavel_id

vinculo_id

pessoa_id

ramo_id

equipe_id

cargo_id

data_inicio
data_fim

status

motivo_encerramento

observacao

data_criacao
data_modificacao

Exemplo:

2026
Lobinho

2029
Escoteiro

2034
Sênior

2045
Escotista

### Grupo Escoteiro

grupo_id

registro_ueb

distrito

numero

nome

data_fundacao

cidade

uf

status

### Usuario [ADIANTI]

Implementação delegada ao Adianti Framework

Equivalência prevista:

system_user

### Perfil [ADIANTI]

Implementação delegada ao Adinati Framework

Equivalência prevista:

system_group

### Permissao [ADIANTI]

Implementação delegada ao Adianti Framework

Equivalência prevista:

system_program