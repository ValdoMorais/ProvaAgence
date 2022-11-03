# ProvaAgence
 Pacote de avaliacao da Agence Brasil
 -Controle de actividades online terminada em Laravel
 
Instalação
$ git clone https://github.com/danilomeneghel/prova_agence.git

$ cd prova_agence

$ composer install
Crie um banco de dados com o nome "caol" no seu Mysql.
Você encontra o dump na raiz do projeto (caol.sql) e pode efetuar importação da seguinte forma:

$ mysql -u <your user> -p <your password>

mysql> create database `caol`;

mysql> use `caol`;

mysql> source caol.sql
Volte o terminal, verifique o arquivo .env e efetue a configuração correta para conexão do seu banco de dados.

Depois de realizado isso, rode o projeto:

$ php artisan serve
Abra em seu navegador:

http://localhost:8000/

Login
Para poder se logar no sistema é só criar um novo usuário clicando no link "Criar uma conta".

Ou pode logar usuando o usuário Admin já cadastrado:

- Usuário: admin@admin.com
- Senha: 1234
Demonstração
Para ver o sistema rodando online basta acessar o link abaixo:

http://provaagence.herokuapp.com

License
Este projeto está licenciado sob The MIT License (MIT).
