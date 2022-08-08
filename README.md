## Setting up an application with Docker
Prepare .env and configure it (you need to set `EXCHANGE_RATE_API_KEY`).
```shell
cp .env.example .env
```

Build docker
```shell
docker compose up -d
```

Install Composer dependencies
```shell
docker compose exec php composer install
```

Run app
```shell
docker compose exec php php app.php {path}
```

Run tests
```shell
docker compose exec php vendor/bin/phpunit
```