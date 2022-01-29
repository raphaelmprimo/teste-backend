# Teste para desenvolvedor Backend na Clínica Experts

O desafio é desenvolver um **serviço de APIs para encurtar links** (como o [bitly](https://bitly.com/)).

Deverá ter um endpoint que recebe um link (obrigatório) e um identificador (opcional). Lembre-se que o identificador deve ser único, pois será utilizado como slug para o novo link. Quando não informado, deverá ser gerada uma string de 6 a 8 caracteres, incluindo letras e números.

Deve ser mantido o registro de todos os links que foram encurtados.

Fornecer também um endpoint para alteração e outro para exclusão de links já cadastrados.

Ao acessar um link encurtado, o sistema deve redirecionar o usuário para a página original, gerar um registro do acesso salvando alguns dados da requisição, como o IP, o User-Agent, e incrementar um contador de acessos do link encurtado.

Deve ser disponibilizado um endpoint que faça a listagem de todos os links encurtados e também suas métricas de acesso.

Também é necessária um endpoint que recebe um arquivo .CSV (disponibilizado em anexo) para importação de links em lote.

Disponibilizar um endpoint que exporta um relatório .CSV contendo todos os links cadastrados, seus respectivos identificadores e o número de acessos.


# Instruções
- Criar um fork deste repositório
- Fique à vontade para usar bibliotecas/componentes externos
- Seguir princípios **CLEAN CODE**
- Escrever o código em **INGLÊS**
- Utilize os comentários dos commits para documentar o processo de desenvolvimento
- Documentar como rodar o projeto

# Requisitos
- O projeto deve ser desenvolvido com o framework Laravel
- Utilizar um banco de dados relacional (MySQL/MariaDB/PostgreSQL)
- Utilizar o conceito de API REST com retornos em formato JSON
- Criar os endpoints de cadastro, alteração, exclusão e listagem dos links
- Criar um endpoint que receberá um arquivo .csv para importação de links
- Criar um endpoint que proverá um arquivo .csv para exportará de links
- Fazer o redirecionamento para a página original ao acessar o link encurtado
