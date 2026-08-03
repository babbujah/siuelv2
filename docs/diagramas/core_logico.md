# Diagrama Lógico do Core

```mermaid
classDiagram

class Pessoa {
    pessoa_id
    nome
    cpf
    data_nascimento
    genero
    email
    telefone_principal
    tipo_pessoa
    status
    data_criacao
    data_modificacao
}

class PessoaResponsavel {
    pessoa_responsavel_id
    pessoa_id
    responsavel_id
    parentesco
    responsavel_principal
}

class GrupoEscoteiro {
    grupo_id
    numero
    nome
    cidade
    uf
    status
}

class Ramo {
    ramo_id
    nome
    sigla
    idade_minima
    idade_maxima
    cor
    status
}

class Equipe {
    equipe_id
    ramo_id
    nome
    tipo
    cor
    status
}

class Cargo {
    cargo_id
    nome
    descricao
    area
    status
}

class Vinculo {
    vinculo_id
    pessoa_id
    ramo_id
    equipe_id
    cargo_id
    data_inicio
    data_fim
    status
    observacao
}

class Usuario {
    usuario_id
    pessoa_id
    login
    email_login
    ultimo_acesso
    ativo
}

class Perfil {
    perfil_id
    nome
    descricao
}

class Permissao {
    permissao_id
    nome
    descricao
}

class UsuarioPerfil {
    usuario_perfil_id
    usuario_id
    perfil_id
}

GrupoEscoteiro "1" --> "0..*" Ramo : possui
 
Ramo "1" --> "0..*" Equipe : possui
 
Pessoa "1" --> "0..*" Vinculo : possui
 
Vinculo --> "1" Ramo : pertence
Vinculo --> "0..1" Equipe : participa
Vinculo --> "0..1" Cargo : exerce
 
Pessoa "1" --> "0..1" Usuario : possui
 
Usuario "1" --> "0..*" UsuarioPerfil : possui
 
Perfil "1" --> "0..*" UsuarioPerfil : vincula
 
Pessoa "1" --> "0..*" PessoaResponsavel : membro_juvenil
 
Pessoa "1" --> "0..*" PessoaResponsavel : responsavel