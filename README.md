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
