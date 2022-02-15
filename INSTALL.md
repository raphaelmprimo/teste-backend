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

# Documentação API

- GET /links
- GET /export_links
- GET /link/{slug}
- POST /link
- POST /import_links
- PUT /link/{id}
- DELETE /link/{id}