DESAFIO BACK END GESUAS

Este programa foi desenvolvido em Symphony que cadastra o nome do Cidadão e gerar o número único do NIS. Também é possível realizar a consulta do cidadão pelo número NIS que foi criado.

Ferramentas Utilizadas:
Symphony
Docker
MYSQL
TWIG 

Como executar o projeto:

Execute sudo nano /etc/hosts e adicione a linha 127.0.0.1 mysql_container ao arquivo. Isso ajudará a rodar o comando php bin/console doctrine:database:create mais para frente.

Instalar o composer:

$ cd project
$ composer update

Subir o Docker:
$ docker-compose up --build

Criar o banco de dados:
$ php bin/console doctrine:database:create

Executar o arquivo da migration:

$ php bin/console doctrine:migrations:migrate

