ifeq ($(STAGE),)
STAGE = local-dev
endif

OPT =
.PHONY: build clean

COMPOSE = docker-compose -p tyrun-pilulka \
	-f ./docker/environment/${STAGE}/docker-compose.yml \
	--project-directory ./docker/environment/${STAGE}

RUN_IN_PHP = docker exec -i tyrun-pilulka-php-fpm
RUN_IN_REDIS = docker exec -it tyrun-pilulka-percona
RUN_IN_NGINX = docker exec -i tyrun-pilulka-nginx

build:
	${COMPOSE} up -d
	make composer
up:
	${COMPOSE} up -d

down:
	${COMPOSE} down --remove-orphans

restart:
	make down
	make up

prune:
	make down
	docker volume rm legend_db-data legend_db-logs legend_nginx-logs

composer:
	${RUN_IN_PHP} composer update --prefer-dist

composer-require:
	${RUN_IN_PHP} composer require ${NAME}

nginx-reload:
	${RUN_IN_NGINX} nginx -s reload