
# Cars2You Pratics

Este projeto consiste em um sistema de gerenciamento de veículos, contendo tanto o backend quanto o frontend. O backend foi desenvolvido com Laravel, e o frontend com Nuxt.js (Vue 3). 

Repositório do projeto: [https://github.com/SamuelvLopes/cars2you.pratics.me](https://github.com/SamuelvLopes/cars2you.pratics.me)

## Índice

- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Estrutura de Pastas](#estrutura-de-pastas)
- [Backend - Laravel](#backend---laravel)
  - [Instalação](#instalação-do-backend)
  - [Configuração](#configuração-do-backend)
  - [Uso](#uso-do-backend)
- [Frontend - Nuxt.js](#frontend---nuxtjs)
  - [Instalação](#instalação-do-frontend)
  - [Configuração](#configuração-do-frontend)
  - [Uso](#uso-do-frontend)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Tecnologias Utilizadas

- **Backend:**
  - Laravel 9
  - Docker (Laravel Sail)
- **Frontend:**
  - Nuxt.js 3
  - Vue.js 3
  - Bulma (CSS Framework)
  - Pinia (State Management)
  - Vite (Build Tool)

## Estrutura de Pastas

```bash
cars2you.pratics.me
├── back-end
│   ├── app
│   ├── artisan
│   ├── composer.json
│   ├── docker-compose.yml
│   ├── .env.example
│   ├── package.json
│   ├── README.md
│   ├── tests
│   └── ...
├── docs
├── front-end
│   ├── dist
│   ├── node_modules
│   ├── public
│   ├── src
│   │   ├── app
│   │   ├── views
│   │   │   ├── components
│   │   │   ├── pages
│   │   │   │   ├── Home.vue
│   │   │   │   └── VehicleForm.vue
│   │   ├── App.vue
│   │   ├── main.js
│   ├── .env
│   ├── package.json
│   ├── vite.config.js
│   └── ...
├── .env.sample
└── README.md
```

## Backend - Laravel

### Instalação do Backend

1. Clone o repositório:
   ```bash
   git clone https://github.com/SamuelvLopes/cars2you.pratics.me.git
   ```
2. Navegue até o diretório `back-end`:
   ```bash
   cd cars2you.pratics.me/back-end
   ```
3. Instale as dependências do Composer:
   ```bash
   composer install
   ```

### Configuração do Backend

1. Crie o arquivo `.env` a partir do `.env.example`:
   ```bash
   cp .env.example .env
   ```
2. Gere a chave da aplicação:
   ```bash
   ./vendor/bin/sail artisan key:generate
   ```
3. Ajuste as configurações do banco de dados no arquivo `.env`.

4. Inicie o ambiente Docker:
   ```bash
   ./vendor/bin/sail up -d
   ```

5. Rode as migrações para criar as tabelas no banco de dados:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

6. Opcional: Rode os seeders para popular o banco de dados:
   ```bash
   ./vendor/bin/sail artisan db:seed
   ```

### Uso do Backend

Para iniciar o servidor, use:
```bash
./vendor/bin/sail artisan serve
```

## Frontend - Nuxt.js

### Instalação do Frontend

1. Navegue até o diretório `front-end`:
   ```bash
   cd cars2you.pratics.me/front-end
   ```
2. Instale as dependências do NPM:
   ```bash
   npm install
   ```

### Configuração do Frontend

1. Crie o arquivo `.env` para configurar a URL da API do backend:
   ```
   VITE_API_URL=http://localhost:8000/api
   ```

### Uso do Frontend

Para iniciar o servidor de desenvolvimento, use:
```bash
npm run dev
```

O frontend estará disponível em `http://localhost:3000`.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue ou enviar um pull request.
