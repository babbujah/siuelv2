## Diagrama Lógico do Core

```mermaid
classDiagram

class Pessoa {
    pessoa_id
    nome
    cpf
    data_nascimento
    genero
    tipo_pessoa
    status
}

class Contato {
    contato_id
    pessoa_id
    telefone1
    telefone2
    email
}

class Endereco {
    endereco_id
    pessoa_id
    logradouro
    numero
    bairro
    complemento
    cidade
    cep
}

class PessoaResponsavel {
    pessoa_responsavel_id
    membro_juvenil_id
    responsavel_id
    parentesco
    responsavel_principal
    recebe_comunicado
    permite_saida
}

class GrupoEscoteiro {
    grupo_id
    numero
    nome
}

class Ramo {
    ramo_id
    nome
    sigla
}

class UnidadeEscoteira {
    unidade_escoteira_id
    grupo_id
    ramo_id
    nome
}

class Equipe {
    equipe_id
    unidade_escoteira_id
    nome
    tipo
}

class Cargo {
    cargo_id
    nome
    categoria
    area
    nivel_permissao
}

class Vinculo {
    vinculo_id
    pessoa_id
    grupo_id
    ramo_id
    unidade_escoteira_id
    equipe_id
    cargo_id
    data_inicio
    data_fim
    status
}

Pessoa "1" --> "0..1" Contato : possui

Pessoa "1" --> "0..1" Endereco : possui

Pessoa "1" --> "0..*" PessoaResponsavel : membro

Pessoa "1" --> "0..*" PessoaResponsavel : responsavel

GrupoEscoteiro "1" --> "0..*" UnidadeEscoteira : possui

Ramo "1" --> "0..*" UnidadeEscoteira : organiza

UnidadeEscoteira "1" --> "0..*" Equipe : possui

Pessoa "1" --> "0..*" Vinculo : possui

Vinculo --> GrupoEscoteiro

Vinculo --> Ramo

Vinculo --> UnidadeEscoteira

Vinculo --> Equipe

Vinculo --> Cargo