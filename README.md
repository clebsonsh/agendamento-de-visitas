# Agendamento de Visitas

Este projeto é uma aplicação de agendamento de visitas, dividida em um frontend e um backend.

## Backend

O backend desta aplicação é desenvolvido em PHP e utiliza as seguintes tecnologias:

*   **PHP**: Linguagem de programação do lado do servidor.
*   **Pecee Simple Router**: Um roteador simples e eficiente para PHP.
*   **Dotenv (vlucas/phpdotenv)**: Para carregar variáveis de ambiente de um arquivo `.env`.
*   **Respect/Validation**: Biblioteca de validação de dados.
*   **MariaDB**: Sistema de gerenciamento de banco de dados relacional.

## Frontend

O frontend desta aplicação é construído com as seguintes tecnologias:

*   **React**: Biblioteca JavaScript para construção de interfaces de usuário.
*   **Vite**: Ferramenta de build de frontend moderna.
*   **TypeScript**: Superset do JavaScript que adiciona tipagem estática.
*   **Material-UI (MUI)**: Biblioteca de componentes React para um design elegante e responsivo.
*   **React Query (TanStack Query)**: Biblioteca para gerenciamento de estado assíncrono, cache e sincronização de dados do servidor.
*   **React Router**: Biblioteca para roteamento declarativo no React.

## Docker & Docker Compose

Ambos o backend e frontend possuem arquivos `docker-compose.yml` em seus respectivos diretórios. Isso permite a conteinerização e orquestração de ambas as partes da aplicação usando Docker Compose.

Para levantar a aplicação completa (backend e frontend) usando Docker Compose:

1.  Navegue até o diretório `backend` e inicie o backend:

    ```bash
    cd backend
    cp .env.example .env
    docker compose up -d --build
    ```

    O backend estará disponível em `http://localhost:8000`.

2.  Navegue até o diretório `frontend` e inicie o frontend:

    ```bash
    cd frontend
    cp .env.example .env
    docker compose up -d --build
    ```

    O frontend estará disponível em `http://localhost:3000`.

## Qualidade de Código e Testes

Para garantir a qualidade do código, manutenibilidade e a corretude das funcionalidades, o projeto utiliza as seguintes ferramentas:

*   **PHPStan**: Ferramenta de análise estática que verifica a consistência e a corretude do código, ajudando a identificar bugs antes mesmo da execução.
*   **Pint**: Um formatador de código PHP que garante um estilo de código consistente em todo o projeto, seguindo as convenções da comunidade.
*   **Pest PHP**: Um framework de testes elegante e focado no desenvolvedor, utilizado para escrever testes unitários e de integração.
*   **Strict Types**: A declaração `declare(strict_types=1);` é utilizada em todo o código para garantir uma tipagem mais rigorosa, prevenindo erros de tipo e melhorando a previsibilidade do código.

Para executar as ferramentas de qualidade de código e os testes, utilize os seguintes comandos a partir do diretório `backend`:

- Executar o PHPStan para análise estática
```bash
docker compose exec php-fpm composer phpstan
```

- Executar o Pint para formatar o código
```bash
docker compose exec php-fpm composer pint
```

- Executar os testes com o Pest PHP
```bash
docker compose exec php-fpm composer pest
```

