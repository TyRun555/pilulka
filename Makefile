ifeq ($(STAGE),)
STAGE = local-dev
endif

OPT =
.PHONY: build clean

COMPOSE = docker-compose -p pilulka_testapp \
	-f ./docker/env/${STAGE}/docker-compose.yml \
	--project-directory ./docker/env/${STAGE}

RUN_IN_PHP = docker exec -i pilulka_testapp-php-fpm
RUN_IN_PERCONA = docker exec -it pilulka_testapp-percona
RUN_IN_NGINX = docker exec -i pilulka_testapp-nginx

install:
	make setup
	${COMPOSE} up -d
	make composer
	make migrate
up:
	${COMPOSE} up -d

setup:
	php ./docker/env/${STAGE}/setup.php

build:
	make composer
	make setup
	make migrate

composer:
	${RUN_IN_PHP} composer update --prefer-dist

composer-require:
	${RUN_IN_PHP} composer require ${NAME}

migrate:
	make flush-schema-cache
	${RUN_IN_PHP} php /var/www/yii migrate --interactive=0

migrate-down:
	make flush-schema-cache
	${RUN_IN_PHP} php /var/www/yii migrate/down ${AMOUNT} --interactive=0

migrate-create:
	${RUN_IN_PHP} php /var/www/yii migrate/create ${NAME} --interactive=0

restart:
	make down
	make up

down:
	${COMPOSE} down --remove-orphans

flush-schema-cache:
	${RUN_IN_PHP} php /var/www/yii cache/flush-schema --interactive=0

clean:
	make down
	docker volume rm pilulka_testapp_db-data pilulka_testapp_db-logs pilulka_testapp_nginx-logs
