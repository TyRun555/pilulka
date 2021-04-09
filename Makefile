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

#Build and run containers then run composer update
build:
	${COMPOSE} up -d
	make composer

#start the app
up:
	${COMPOSE} up -d

#stop the app
down:
	${COMPOSE} down --remove-orphans

#restart the app
restart:
	make down
	make up

#stop containers and remove all data from it
prune:
	make down
	docker volume rm legend_db-data legend_db-logs legend_nginx-logs

#Update packages using composer in php-fpm container.
composer:
	${RUN_IN_PHP} composer update --prefer-dist

#Requiring packages using composer in php-fpm container.
#Example: make composer-require NAME='--dev symfony/phpunit-bridge'
composer-require:
	${RUN_IN_PHP} composer require ${NAME}

#Reload nginx config in container
nginx-reload:
	${RUN_IN_NGINX} nginx -s reload