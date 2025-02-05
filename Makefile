COMPOSE=docker-compose

build:
	$(COMPOSE) build

up:
	$(COMPOSE) up -d

down:
	$(COMPOSE) down

restart:
	$(COMPOSE) restart

exec:
	$(COMPOSE) exec app bash

migration:
	$(COMPOSE) exec app bash -c "php artisan migrate"

test:
	$(COMPOSE) exec app bash -c "php artisan test"

