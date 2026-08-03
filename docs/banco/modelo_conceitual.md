# Modelo Conceitual do SIUEL V2

### Objetivo

O SIUEL V2 é um sistema de gestão escoteira destinado ao apoio das atividades administrativas, operacionais e educativas do Grupo Escoteiro.

O sistema deverá permitir o gerenciamento de pessoas, patrimônio, programa educativo, eventos, documentação, relatórios e demais processos necessários à administração e desenvolvimento das atividades escoteiras.

## Domínio Core

O domínio Core representa os elementos fundamentais do sistema e serve de base para todos os demais módulos.

## Pessoa

Representa qualquer pessoa cadastrada no sistema.
Uma pessoa pode assumir diferentes papéis dentro do Grupo Escoteiro ao longo de sua trajetória.

Pode ser:

- Jovem
- Responsável
- Escotista
- Diretor
- Técnico
- Colaborador

A pessoa possuirá um único cadastro, independentemente de quantas funções exerça.

## Responsável

Representa uma pessoa responsável legal por um ou mais membros juvenis.
Um responsável pode estar vinculado a diversos membros juvenis.
Um membro juvenil pode possuir mais de um responsável

Exemplos:

- Pai
- Mãe
- Avô
- Tutor legal

## Unidade Escoteira
 
Representa uma unidade organizacional do Grupo Escoteiro.
 
Exemplos:
 
- Alcateia
- Tropa Escoteira
- Tropa Sênior
- Clã Pioneiro
 
Cada Unidade Escoteira está associada a um Ramo.

## Ramo

Representa uma divisão do programa educativo dos Escoteiros do Brasil.

Pode ser:

- Filhotes
- Lobinho
- Escoteiro
- Sênior
- Pioneiro

Os ramos possuem regras, progressões e estruturas próprias.

## Equipe

Representa uma subdivisão organizacional de um ramo.

Exemplos:

- Matilhas
- Patrulhas
- Clã
- Equipe de interesse
- Equipe de serviço

Cada equipe pertence a um ramo.

Observação:

O Clã Pioneiro é tratado como uma equipe única, pois o Ramo Pioneiro não utiliza equipes fixas. Eles tem apenas equipes de interesse que são de caráter flexível e variável.

## Cargo

Representa uma função exercida por uma pessoa dentro da estrutura organizacional.

Exemplos:

- Chefe de Seção
- Escotista
- Diretor
- Assistente

Um cargo determina responsabilidades e permissões dentro do sistema.

# Vínculo

Representa a participação de uma pessoa dentro da estrutura do Grupo Escoteiro (ramo/equipe/cargo).

O vínculo conecta uma pesoa a:

- Ramo
- Equipe
- Cargo

Uma mesma pessoa poderá possuir vários vínculos ao longo da vida.

Exemplos:

- Lobinho em 2025
- Escoteiros em 2028
- Escotista em 2038

## Domínio Patrimônio

Responsável pela gestão e controle de bens e materiais do Grupo Escoteiro.

## Patrimônio

Representa qualquer bem ou material pertencente ao Grupo Escoteiro.

Exemplos:

- Barracas
- Lampiões
- Cordas
- Ferramentas
- Livros
- Projetores
- Material administrativo

Cada patrimônio deverá possuir informações de indentificação, quantidade e situação.

## Categoria de Partimônio

Agrupa bens semelhantes.

Exemplos:

- Acampamento
- Ferramentas
- Administrativo
- Tecnologia
- Segurança
- Cozinha

## Responsabilidade Patrimonial

Representa quem está responsável pela guarda e utilização de determinado patrimônio.

O responsável pode ser:

- Pessoa
- Equipe
- Ramo
- Grupo Escoteiro

Exemplos:

- Barraca da Patrulha Leão
- Caixa de primeiros socorros do Ramo Lobinho
- Projetor sob responsabilidade da Diretoria

## Movimentação Patrimonial

Representa toda movimentação realizada sobre um patrimônio.

Exemplos:

- Entrada
- Compra
- Doação
- Transferência
- Empréstimo
- Devolução
- Baixa Patrimonial

Toda alteração patrimonial deverá gerar histórico.

## Situação Patrimonial

Representa o estado de conservação de um patrimônio.

Exemplos:

- Novo
- Bom
- Regular
- Necessita manutenção
- Em manutenção
- Inutilizado
- Baixado

## Domínio Educativo

Responsável pelo controle e acompanhamento do desenvolvimento dos membros juvenis e adultos.

## Programa Educativo

Representa a estrutura oficial de acompanhamento e de opotunidades para crescimento e desenvolvimento individual dentro das progressões do Movimento para os Escoteiros do Brasil.

Cada ramo possui seu próprio programa educativo baseado na faixa etária de cada membro juvenil.

## Conquista

Representa um nível, etapa ou objetivo de progressão.

Exemplos:

### Filhotes
- Tixa
- Lipe
- Nina
- Paco

### Lobinho
- Pata Tenra
- Saltador
- Rastreador
- Caçador
- Cruzeiro do Sul

### Escoteiro
- Pista
- Trilha
- Rumo
- Travessia
- Lis de Ouro

### Sênior
- Escalada
- Conquista
- Azimute
- Escoteiro da Pátria

### Pioneiro
- Comprometimento
- Cidadania
- Insígnia de B-P

Para todos os ramos teremos o período introdutório, que pode ser o Caminho ou a Acolhida. Essas são tarefas de caráter conceitual para que o membro juvenil entenda o que é o Movimento Escoteiro - MV e o Ramo ao qual está participando.
O Acolhimento é aplicado às crianças e jovens que estão tendo contato com o MV pela primeira vez e precisam entender os conceitos do MV. Já o Caminho é aplicado às crianças e jovens que já participam no MV dentro de algum ramo, estão próximos do período de transição para o próximo ramo e já conhecem o MV. Por isso, suas tarefas concentram-se, basicamente, no conhecimento e conceitos do próximo ramo que o membro juvenil irá passar.

## Item de Progressão

Representa uma atividade, requisito ou critério necessário para obtenção de uma conquista.

Cada item possui regras próprias definidas pelo programa educativo.

## Registro de Progressão

Representa a comprovação de realização de um Item de Progressão.

Deve armazenar:

- Pessoa
- Item
- Data
- Observação
- Validador

Opcionalmente poderá armazenar evidências.

## Evidência

Representa documentos ou comprovações utilizados para validar uma progressão.

Exemplos:

- Foto
- Documento PDF
- Vídeo
- Link
- Relatório

## Especialidade

Representa uma especialidade conquistada por um membro juvenil.

Cada especialidade possui requisitos próprios e pode ser registrada e acompanhada pelo sistema.

## Domínio Eventos

Responsável pela gestão das atividades tanto internas quanto externas do Grupo Escoteiro.

## Evento

Representa qualquer atividade realizada pelo Grupo Escoteiro.

Exemplos:

- Reunião
- Acampamento
- Curso
- Mutirão
- Acantonamento
- Jogo Noturno

## Participação

Representa a presença de uma pessoa em um evento.

Permite gerar relatórios de frequência e apoiar registros de progressão.

## Domínio Administrativo

Responsável pelo suporte à gestão estratégica do Grupo Escoteiro.

## Relatório

Representa consultas e indicadores gerados pelo sistema.

Exemplos:

- Relatório de patrimônio
- Relatório de progressão
- Relatório de frequência
- Relatório de participação
- Relatório gerencial

## Permissão

Define quais informações e funcionalidades cada usuário poderá acessar.

Exemplos:

### Jovem

Visualiza apenas suas informações.

### Responsável

Visualiza apenas os dependentes.

### Escotista

Visualiza apenas os membros de seus ramos.

### Diretor

Visualiza todas as informações do sistema.

# Observações Arquiteturais

O SIUEL V2 será desenvolvido utilizando o Adianti Framework.

Sempre que possível serão reutilizadas funcionalidades nativas do framework, evitando duplicação de recursos já existentes.

Entidades conceituais descritas neste documento representam o domínio de negócio e não necessariamente resultarão em tabelas próprias no banco de dados.

Algumas entidades poderão ser implementadas através das estruturas já fornecidas pelo framework.