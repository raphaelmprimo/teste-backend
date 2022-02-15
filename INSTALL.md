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

- GET /links
```
Parâmetro: page (opcional)
```
- GET /export_links
- GET /link/{slug}
- POST /link
```
Parâmetros: url, slug (opcional)
```
- POST /import_links
```
Parâmetro: csv (arquivo)
```
- PUT /link/{id}
```
Parâmetros: url, slug (opcional)
```
- DELETE /link/{id}