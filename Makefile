include .env

install:
	composer install \
	&& yarn \
	&& docker network ls --format='{{.Name}}' | grep ${NETWORK} || docker network create ${NETWORK} \

db_setup:
	yes | php bin/console doctrine:migrations:migrate\
	&& yes | php bin/console doctrine:fixtures:load



dev:
	docker-compose up -d \
	&& yes | symfony server:start
