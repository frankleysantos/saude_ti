### Configuração do ambiente
***

**Para configuração do ambiente é necessário ter o [Docker](https://docs.docker.com/desktop/) instalado em sua máquina.**

Dentro da pasta do projeto, rode o seguinte comando: `docker-compose up -d`.

Copie o arquivo `.env.example` a renomeie para `.env` dentro da pasta raíz da aplicação.

```bash
cp .env.example .env
```

Após criar o arquivo `.env`, será necessário acessar o container da aplicação para rodar alguns comandos de configuração do Laravel.

Para acessar o container use o comando `docker exec -it saude_ti_test_app sh`.

Digite os seguintes comandos dentro do container:

```bash
composer install
php artisan key:generate
php artisan migrate
```

Após rodar esses comandos, seu ambiente estará pronto para começar o teste.

Para acessar a aplicação, basta acessar `localhost:8000`

**Essa aplicação deverá se comportar como uma API REST, onde será consumida por outros sistemas.**
Para acessar o swagger para testes das APIs `http://localhost:8000/api/documentation`

Também é possivel usar o postman para testar, a pasta se encontra no projeto
