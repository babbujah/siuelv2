## Diagrama Conceitual do Core

mermaid
classDiagram

class Pessoa
class Contato
class Endereco
class PessoaResponsavel
class GrupoEscoteiro
class UnidadeEscoteira
class Ramo
class Equipe
class Cargo
class Vinculo

Pessoa --> Contato
Pessoa --> Endereco

Pessoa --> PessoaResponsavel

GrupoEscoteiro --> UnidadeEscoteira

Ramo --> UnidadeEscoteira

UnidadeEscoteira --> Equipe

Pessoa --> Vinculo

Cargo --> Vinculo
Equipe --> Vinculo
Ramo --> Vinculo