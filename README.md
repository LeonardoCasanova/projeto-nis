## DESAFIO BACK END GESUAS

Este programa foi desenvolvido em Symphony que cadastra o nome do Cidadão e gerar o número único do NIS. Também é possível realizar a consulta do cidadão pelo número NIS que foi criado.

# Ferramentas Utilizadas:
* Symphony
* Docker
* MYSQL
* TWIG 

# Necessário ter a versão PHP 8.1

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

# Realizando testes com PHPUnit

Executar o seguinte comando:

```
$ sudo apt-get install php-mbstring
```

Vá até a pasta project:

```
$ cd project
```

Crie um Banco de Dados de Teste:

```
php bin/console doctrine:database:create --env=test

```

Renomeie o arquivo de phpunit.xml.dist para phpunit.xml

Rode a migration de teste:

```
php bin/console doctrine:migrations:migrate --env=test
```

Rode o comando: 

```
$ vendor/bin/phpunit
```
