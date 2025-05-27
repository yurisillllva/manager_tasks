# Gerenciador de tarefas - Laravel

Aplicação de gerenciamento de tarefas com autenticação JWT e interface Blade + TailwindCSS.

## Pré-requisitos

- PHP 8.2+
- Composer 2.8+
- MySQL 5.7+
- Node.js 16+ (para assets)
- Extensões PHP: mbstring, xml, curl, mysql

## Como rodar localmente

1. **Clonar repositório**
```bash
git clone https://github.com/yurisillllva/manager_tasks.git
cd manager_tasks
```

2. **Instalar dependências**
```bash
composer install
npm install
```

3. **Configurar ambiente**
```bash
cp .env.example .env
```

Editar o .env com suas credenciais do MySQL:

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=task_manager

DB_USERNAME=seu_usuario

DB_PASSWORD=sua_senha

4. **Gerar chave JWT**
```bash
php artisan jwt:secret
```

## Migrations e Seeders

### Rodar migrations
```bash
php artisan migrate
```

### Popular dados iniciais
```bash
php artisan migrate:fresh --seed
```

# Executar a aplicação

## Iniciar servidor
```bash
php artisan serve
```

### Não é obrigatório - Compilar assets
```bash
npm run dev
```

## A aplicação estará disponível em: http://localhost:8000