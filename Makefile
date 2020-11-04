init: docker-down-clear \
	clear \
	docker-pull docker-build docker-up \
	install ready \
	permissions
up: docker-up
down: docker-down
restart: down up

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

docker-up:
	docker-compose up -d

# not working in windows
clear:
	docker run --rm -v '${PWD}:/app' -w /app alpine sh -c 'rm -rf var/cache/* var/log/*'
	docker run --rm -v '${PWD}:/app' -w /app alpine rm -f .ready

install:
	docker-compose run --rm php-cli composer install
	docker-compose run --rm php-cli wait-for-it postgres:5432 -t 30
	docker-compose run --rm php-cli php bin/console doctrine:migrations:migrate --no-interaction

lint:
	docker-compose run --rm php-cli composer lint

ready:
	docker run --rm -v '${PWD}:/app' -w /app alpine touch .ready

memory:
	sudo sysctl -w vm.max_map_count=262144

permissions:
	#sudo chown $USER:$USER -R . && sudo chmod 777 -R storage
