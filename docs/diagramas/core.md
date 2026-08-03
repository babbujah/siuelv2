# Diagrama Concentual do Core

```mermaid
classDiagram

class Pessoa
class Responsavel
class Vinculo
class Ramo
class Equipe
class Cargo

Pessoa "1" --> "0..*" Vinculo : possui

Vinculo --> "1" Ramo : pertence
Vinculo --> "0..1" Equipe : participa
Vinculo --> "0..*" Cargo : exerce

Pessoa "1" --> "0..*" Responsavel : possui
Responsavel "1" --> "0..*" Pessoa : responsavel_por

