## DESAFIO BACK END GESUAS

Este programa foi desenvolvido em Symphony que cadastra o nome do Cidadão e gerar o número único do NIS. Também é possível realizar a consulta do cidadão pelo número NIS que foi criado.

# Ferramentas Utilizadas:
* Symphony
* Docker
* MYSQL
* TWIG 

# 🔧 Instalação:
 Executar o comando:

```
sudo nano /etc/hosts
```
Adicione a linha 127.0.0.1 mysql_container ao arquivo. Isso ajudará a rodar o comando php bin/console doctrine:database:create mais para frente.

Instalar o composer:

```
$ cd project
$ composer update
```

Subir o Docker:

```
$ docker-compose up --build
```

Criar o banco de dados:

```
$ php bin/console doctrine:database:create
```

Executar o arquivo da migration:

```
$ php bin/console doctrine:migrations:migrate
```

# Caminhos para utilização do sistema

http://localhost:8741/ - Tela Principal para cadastrar o Cidadão

http://localhost:8741/pesquisar/numero-nis - Tela de pesquisa do Cidadão onde numero-nis deve ser o número gerado para ser feita a pesquisa. Ex: http://localhost:8741/pesquisar/77284023678