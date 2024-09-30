
# Cars2You - Sistema de Gerenciamento de Veículos

Este projeto consiste em um sistema completo para gerenciamento de veículos, incluindo backend em Laravel e frontend em Vue.js, utilizando Vite para o desenvolvimento rápido e eficiente.

## Índice

- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Estrutura de Pastas](#estrutura-de-pastas)
- [Instalação](#instalação)
  - [Backend](#backend)
  - [Frontend](#frontend)
- [Configuração](#configuração)
- [Uso](#uso)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Tecnologias Utilizadas

### Backend
- PHP (Laravel)
- MySQL
- Sail (Docker)

### Frontend
- Vue 3
- Vite
- Axios
- Bulma (CSS Framework)

## Estrutura de Pastas

```bash
cars2you.pratics.me/
├── back-end/
│   ├── app/
│   ├── config/
│   ├── database/
│   ├── public/
│   ├── routes/
│   ├── tests/
│   ├── .env.example
│   ├── docker-compose.yml
│   ├── artisan
│   ├── composer.json
│   └── ...
├── front-end/
│   ├── public/
│   ├── src/
│   │   ├── app/
│   │   ├── views/
│   │   │   ├── components/
│   │   │   └── pages/
│   │   ├── assets/
│   │   ├── App.vue
│   │   ├── main.js
│   │   └── style.css
│   ├── index.html
│   ├── package.json
│   └── vite.config.js
└── README.md
```

## Instalação

### Backend

1. Clone o repositório:
   ```bash
   git clone https://github.com/SamuelvLopes/cars2you.pratics.me.git
   ```
2. Navegue até o diretório do backend:
   ```bash
   cd cars2you.pratics.me/back-end
   ```
3. Instale as dependências PHP:
   ```bash
   composer install
   ```
4. Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente:
   ```bash
   cp .env.example .env
   ```
5. Inicie o ambiente Docker com Laravel Sail:
   ```bash
   ./vendor/bin/sail up -d
   ```
6. Gere a chave da aplicação e rode as migrações do banco de dados:
   ```bash
   ./vendor/bin/sail artisan key:generate
   ./vendor/bin/sail artisan migrate --seed
   ```

### Frontend

1. Navegue até o diretório do frontend:
   ```bash
   cd cars2you.pratics.me/front-end
   ```
2. Instale as dependências do Node.js:
   ```bash
   npm install
   ```
3. Crie o arquivo `.env` e configure as variáveis de ambiente para apontar para o backend:
   ```bash
   cp .env.sample .env
   ```

## Configuração

No arquivo `.env` do frontend, adicione a URL da API para se comunicar com o backend:
```
VITE_API_URL=http://localhost:3000
```

## Uso

### Backend
Para iniciar o backend, execute o comando (no diretório `back-end`):
```bash
./vendor/bin/sail up
```

### Frontend
Para iniciar o frontend, execute o comando (no diretório `front-end`):
```bash
npm run dev
```
O frontend estará disponível em `http://localhost:5173`.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue ou enviar um pull request.

