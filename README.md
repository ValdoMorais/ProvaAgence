# ProvaAgence
 Pacote de avaliacao da Agence Brasil
 -Controle de actividades online terminada em Laravel
 
Instalação
$ git clone https://github.com/ValdoMoraisFlor/ProvaAgence.git

$ cd ProvaAgence

$ composer install
Crie um banco de dados com o nome "prova_agencedb" no seu Mysql.
Você encontra o arquivo na raiz do projeto (prova_agencedb.sql) e pode efetuar importação da seguinte forma:


$ mysql -u <your user> -p <your password>

    
mysql> create database `prova_agencedb`;

    
mysql> use `prova_agencedb`;

    
mysql> source prova_agencedb.sql
Volte o terminal, verifique o arquivo .env e efetue a configuração correta para conexão do seu banco de dados.

    
Depois de realizado isso, rode o projeto:
$ php artisan serve
    
    
Abra em seu navegador:
http://localhost:8000/

    
Login
Para poder se logar no sistema é só criar um novo usuário clicando no link "Registrar", no canto superior direito
Ou pode logar usuando o usuário Admin já cadastrado:

- Usuário: admin@admin.com
- Senha: 1234


License
Este projeto está licenciado sob The MIT License (MIT).
