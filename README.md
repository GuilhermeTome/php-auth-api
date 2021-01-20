# PHP AUTH API

Esse projeto é uma API simples para autenticação usando JWT

## Sobre o projeto

- Foi feito utilizando PHP 7.4.8
- Banco de dados MySQL na versão 5.7 (suporta pgsql)
- Ambiente de desenvolvimento em docker
- Estrutura seguindo o padrão MVCe autoloader do composer
- Seguindo PSR 1, PSR 4 e PSR 7

## Executar o projeto

- Primeiro de tudo você precisa clonar ele com o seguinte comando:
```
git clone https://github.com/GuilhermeTome/php-auth-api.git
```

- Entrar na pasta do projeto e criar o arquivo de configurações
```
cd ./php-auth-api
cp configurations.sample.php configurations.php
```

#### Rodando com docker

- Para subir o projeto com docker deve rodar o seguinte comando
```
docker-composer up -d
```

- Instalando banco de dados
```
docker exec -i php_auth_api_mysql sh -c 'exec mysql -uroot -ppassword' < ./database/mysql_base.sql
```

- Ele estará disponível em [http://localhost:8090](http://localhost:8090)

#### Rodando sem docker

- Instalar as dependências do composer 
```
composer install
```

- Iniciar o servidor interno do php
```
php -S 0.0.0.0:8090 -t /public
``` 

- Em configurations.php você deve colocar os dados de acesso ao seu banco

- Ele estará disponível em [http://localhost:8090](http://localhost:8090)

## Conteúdo externo

- [Documentação no Postman](https://documenter.getpostman.com/view/11519258/TVzYetp7#b40552b5-0ce5-4497-8b8d-9a4f396bc600)