include .env

install-dev:
	composer install \
	&& yarn \
	&& docker network ls --format='{{.Name}}' | grep ${NETWORK} || docker network create ${NETWORK} \

db_setup:
	yes | php bin/console doctrine:migrations:migrate\
	&& yes | php bin/console doctrine:fixtures:load

dev:
	docker-compose up -d \
	&& yes | symfony server:start -d


prepare-prod:
	composer install \
    && yarn \
    && yarn encore production \
    && yes | php bin/console doctrine:migrations:migrate \
    && yes | php bin/console doctrine:fixtures:load
