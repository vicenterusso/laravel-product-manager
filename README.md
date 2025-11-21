# Sistema de Administração de Produtos

Sistema simples de gerenciamento de produtos com CRUD completo e atualização de estoque via upload de CSV.

## 🚀 Funcionalidades

- ✅ CRUD completo de produtos (Criar, Listar, Editar, Excluir)
- ✅ Upload de imagens para produtos
- ✅ Importação de CSV para atualização de estoque
- ✅ Processamento assíncrono de CSV com Jobs/Queues
- ✅ Autenticação de usuários (Laravel Breeze)
- ✅ Interface responsiva com Tailwind CSS
- ✅ Validação completa de dados

## 📋 Requisitos

- PHP 8.2 ou superior
- Composer
- Node.js e NPM
- MySQL 8.0 ou superior
- Redis (para queues - opcional em desenvolvimento)

## 🔧 Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/vicenterusso/laravel-product-manager.git
cd laravel-product-manager
```

### 2. Instale as dependências PHP

```bash
composer install
```

### 3. Instale as dependências JavaScript

```bash
npm install
```

### 4. Configure o ambiente

```bash
cp .env.example .env
php artisan key:generate
```

Edite o arquivo `.env` e configure seu banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_products
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Execute as migrations

```bash
php artisan migrate
```

### 6. Crie o link simbólico para storage

```bash
php artisan storage:link
```

### 7. Compile os assets

```bash
npm run dev
```

### 8. Inicie o servidor

```bash
php artisan serve
```

### 9. (Opcional) Inicie o queue worker para processar CSVs

```bash
php artisan queue:work
```

Acesse: http://localhost:8000

## 📦 Estrutura do Banco de Dados

### Tabela: products

| Campo | Tipo | Descrição |
|-------|------|----------|
| id | bigint | ID único do produto |
| name | string | Nome do produto |
| reference | string | Referência (ID do CSV) |
| photo | string | Caminho da foto |
| quantity | decimal | Quantidade em estoque |
| created_at | timestamp | Data de criação |
| updated_at | timestamp | Data de atualização |

## 📄 Formato do CSV

O sistema aceita CSVs com o seguinte formato:

```
Referência;Código;Produto;Quantidade
24;24;ELÉTRICA;1.130,00
21;21;ABRAÇADEIRA;27.807,00
```

**Observações:**
- Separador: ponto e vírgula (;)
- Decimal: vírgula (,)
- A coluna "Referência" é usada para fazer o match com os produtos cadastrados
- Apenas a quantidade será atualizada no banco de dados

## 🔐 Autenticação

O sistema utiliza Laravel Breeze para autenticação. Para criar um usuário:

1. Acesse a página de registro
2. Crie sua conta
3. Faça login

Ou via tinker:

```bash
php artisan tinker

User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password')
]);
```

## 🎨 Tecnologias Utilizadas

- **Laravel 11** - Framework PHP
- **Laravel Breeze** - Autenticação
- **Tailwind CSS** - Framework CSS
- **Alpine.js** - JavaScript reativo
- **MySQL** - Banco de dados
- **Redis** - Queue driver (opcional)

## 🤝 Contribuindo

Contribuições são bem-vindas! Sinta-se livre para abrir issues e pull requests.

## 📝 Licença

Este projeto é open source e está disponível sob a [Licença MIT](LICENSE).

## 👨‍💻 Autor

Vicente Russo - [@vicenterusso](https://github.com/vicenterusso)

---

**Desenvolvido com ❤️ usando Laravel**