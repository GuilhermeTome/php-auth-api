# PHP AUTH API

Esse projeto é uma API simples para autenticação usando JWT

![GitHub last commit](https://img.shields.io/github/last-commit/GuilhermeTome/php-auth-api)
![GitHub repository size](https://img.shields.io/github/repo-size/GuilhermeTome/php-auth-api?color=blue)

## Sobre o projeto

- Foi feito utilizando PHP 7.4.8
- Banco de dados MySQL na versão 5.7 (suporta pgsql)
- Ambiente de desenvolvimento em docker
- Estrutura seguindo o padrão MVC e autoloader do composer
- Seguindo PSR 1, PSR 4 e PSR 7

## Executar o projeto

- Primeiramente você precisa clonar ele com o seguinte comando:
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

## Arquivo de configuração

Esse arquivo é responsável por armazenar as configurações globais do sistema e não é versionado

### Internal configurations

Responsável pelas configurações de rotas do sistema, garantindo assim a integridade da estrutura.
```
/**
 * Internal configurations
 */
define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', __DIR__ . DS);

define('PATH_PUBLIC', PATH_ROOT . 'public' . DS);
define('PATH_UPLOAD', PATH_PUBLIC . 'uploads' . DS);

define('PATH_RESOURCE', PATH_ROOT . 'resource' . DS);
define('PATH_CACHE', PATH_ROOT . 'cache' . DS);
define('PATH_ROUTE', PATH_ROOT . 'routes' . DS);
```

### Security configurations

Responsável pelas configurações de segurança do sistema, utilizado para gerar hash aleatório.
```
/**
 * Security configurations
 */
define('UNIQID_HASH', 'my_big_hash');

```

### Database configurations

Responsável pelas configurações de banco de dados do sistema, como não é versionado os dados de acesso não vão para o github e cada colaborador pode ter seus acessos pessoais configurados na própria máquina.
```
/**
 * Database configurations
 */
define('DB_TYPE', 'mysql');
define('DB_NAME', 'db');
define('DB_HOST', 'mysql');
define('DB_USER', 'root');
define('DB_PWD', 'password');
define('DB_PORT', '3307');
define('DB_CHARSET', 'utf8mb4');

```

### Server configurations

Responsável pelas configurações do servidor, aqui pode ser configurado o status de manutenção do servidor(impede qualquer rota de ser executada), o protocolo de http e se os erros não tratados podem ser mostrados. 
```
/**
 * Server configurations
 */
define('MAINTENANCE', false); // app stop
define('HTTP_PROTOCOL', 'http://');
define('DISPLAY_ERRORS', true);

```

### JWT constants

As constantes para a biblioteca de JWT usada como dependência externa.

```
/**
 * JWT CONSTANTS
 */

// the key of the application
define('JWT_SECRET', 'mysecret');

// the hash of the jwt
define('JWT_HASH', 'sha256');

// the alg to put in header
define('JWT_ALG', 'HS256');

```


## Conteúdo externo

- [Documentação no Postman](https://documenter.getpostman.com/view/11519258/TVzYetp7#b40552b5-0ce5-4497-8b8d-9a4f396bc600)
- [Biblioteca JWT no GitHub](https://github.com/GuilhermeTome/jwt)
- [Biblioteca JWT no Packagist](https://packagist.org/packages/guilhermetome/jwt)