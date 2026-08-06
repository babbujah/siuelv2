# Core V1

## Status

Concluído

Data: 06/08/2026

## Estruturas Implementadas

- pessoa
- contato
- endereco
- grupo_escoteiro
- ramo
- unidade_escoteira
- equipe
- cargo
- pessoa_responsavel
- vinculo

## Objetivo

Fornecer infraestrutura básica para todos os módulos do SIUEL V2.

## Validações Realizadas

### Jovem

Pessoa → Ramo → Unidade → Equipe

### Escotista

Pessoa → Cargo → Unidade

### Diretor

Pessoa → Cargo → Grupo Escoteiro

### Técnico

Pessoa → Cargo → Grupo Escoteiro

## Resultado

Core V1 validado e pronto para implementação da camada de aplicação.

## Próxima Fase

Implementação dos Models e CRUDs do Core.