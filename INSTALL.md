# Como instalar e rodar o projeto

- Crie um clone deste repositório:
```
  $ git clone https://github.com/raphaelmprimo/teste-backend.git
```
- Crie um arquivo **.env** seguindo como base o arquivo **.env.example**, alterando as configurações do banco de dados.
- Faça a instalação das dependências necessárias:
```
  composer install
```
- Faça a migração das tabelas do banco de dados:
```
  php artisan migrate
```
- Rode o projeto através do código:
```
  php artisan serve
```

# API endpoints

- GET /api/links
```
Endpoint para listagem de todos os links com sistema de paginação.

Parâmetro: page (opcional)
```

- GET /api/export_links
```
Endpoint para exportar todos os links no formato CSV.
```

- GET /api/link/{slug}
```
Endpoint para acessar os dados de um link específico através do slug, contabilizando o acesso.
```

- POST /api/link
```
Endpoint para a criação de um novo link.

Parâmetros: url, slug (opcional)
```

- POST /api/import_links
```
Endpoint para a importação de um arquivo CSV para cadastro em massa de links.

Parâmetro: csv (arquivo)
```

- PUT /api/link/{id}
```
Endpoint para a edição dos dados de um link.

Parâmetros: url, slug (opcional)
```

- DELETE /api/link/{id}
```
Endpoint para a remoção de um link.
```