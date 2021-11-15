#-----------------------------------------------------------
# Docker
#-----------------------------------------------------------

# Wake up docker containers
up:
	sudo docker-compose up -d

# Shut down docker containers
down:
	sudo docker-compose down

# Show a status of each container
status:
	sudo docker-compose ps

# Status alias
s: status

# Show logs of each container
logs:
	docker-compose logs

# Restart all containers
restart: down up

# Restart the client container
restart-client:
	sudo docker-compose restart client

# Restart the client container alias
rc: restart-client

# Show the client logs
logs-client:
	sudo docker-compose logs client

# Show the client logs alias
lc: logs-client

# Build and up docker containers
build:
	sudo docker-compose up -d --build

# Build containers with no cache option
build-no-cache:
	sudo docker-compose build --no-cache

# Build and up docker containers
rebuild: down build

# Run terminal of the php container
php:
	sudo docker-compose exec php bash

# Run terminal of the client container
client:
	sudo docker-compose exec client /bin/sh


#-----------------------------------------------------------
# Logs
#-----------------------------------------------------------

# Clear file-based logs
logs-clear:
	sudo rm local-docker/dev/nginx/logs/*.log
	sudo rm local-docker/dev/supervisor/logs/*.log
	sudo rm api/storage/logs/*.log


#-----------------------------------------------------------
# Database
#-----------------------------------------------------------

# Run database migrations
db-migrate:
	sudo docker-compose exec php php artisan migrate

# Migrate alias
migrate: db-migrate

# Run migrations rollback
db-rollback:
	sudo docker-compose exec php php artisan migrate:rollback

# Rollback alias
rollback: db-rollback

# Run seeders
db-seed:
	sudo docker-compose exec php php artisan db:seed

# Seed alias
seed: db-seed

# Fresh all migrations
db-fresh:
	sudo docker-compose exec php php artisan migrate:fresh

# Dump database into file
db-dump:
	sudo docker-compose exec postgres pg_dump -U app -d app > local-docker/postgres/dumps/dump.sql


#-----------------------------------------------------------
# Redis
#-----------------------------------------------------------

redis:
	sudo docker-compose exec redis redis-cli

redis-flush:
	sudo docker-compose exec redis redis-cli FLUSHALL

redis-install:
	sudo docker-compose exec php composer require predis/predis


#-----------------------------------------------------------
# Queue
#-----------------------------------------------------------

# Restart queue process
queue-restart:
	sudo docker-compose exec php php artisan queue:restart


#-----------------------------------------------------------
# Testing
#-----------------------------------------------------------

# Run phpunit tests
test:
	sudo docker-compose exec php vendor/bin/phpunit --order-by=defects --stop-on-defect

# Run all tests ignoring failures.
test-all:
	sudo docker-compose exec php vendor/bin/phpunit --order-by=defects

# Run phpunit tests with coverage
coverage:
	sudo docker-compose exec php vendor/bin/phpunit --coverage-html tests/report

# Run phpunit tests
dusk:
	sudo docker-compose exec php php artisan dusk

# Generate metrics
metrics:
	sudo docker-compose exec php vendor/bin/phpmetrics --report-html=api/tests/metrics api/app


#-----------------------------------------------------------
# Dependencies
#-----------------------------------------------------------

# Install composer dependencies
composer-install:
	sudo docker-compose exec php composer install

# Update composer dependencies
composer-update:
	sudo docker-compose exec php composer update

# Update yarn dependencies
yarn-update:
	sudo docker-compose exec client yarn update

# Update all dependencies
dependencies-update: sudo composer-update yarn-update

# Show composer outdated dependencies
composer-outdated:
	sudo docker-compose exec yarn outdated

# Show yarn outdated dependencies
yarn-outdated:
	sudo docker-compose exec yarn outdated

# Show all outdated dependencies
outdated: yarn-update composer-outdated


#-----------------------------------------------------------
# Tinker
#-----------------------------------------------------------

# Run tinker
tinker:
	sudo docker-compose exec php php artisan tinker


#-----------------------------------------------------------
# Installation
#-----------------------------------------------------------

# Copy the Laravel API environment file
env-api:
	cp .env.api api/.env

# Copy the NuxtJS environment file
env-client:
	cp .env.client client/.env

# Add permissions for Laravel cache and storage folders
permissions:
	sudo chmod -R 777 api/bootstrap/cache
	sudo chmod -R 777 api/storage

# Permissions alias
perm: permissions

# Generate a Laravel app key
key:
	sudo docker-compose exec php php artisan key:generate --ansi

# Generate a Laravel storage symlink
storage:
	sudo docker-compose exec php php artisan storage:link

# PHP composer autoload command
autoload:
	sudo docker-compose exec php composer dump-autoload

# Install the environment
install: build install-laravel env-api migrate install-nuxt env-client restart


#-----------------------------------------------------------
# Git commands
#-----------------------------------------------------------

# Undo the last commit
git-undo:
	git reset --soft HEAD~1

# Make a Work In Progress commit
git-wip:
	git add .
	git commit -m "WIP"

# Export the codebase as app.zip archive
git-export:
	git archive --format zip --output app.zip master


#-----------------------------------------------------------
# Frameworks installation
#-----------------------------------------------------------

# Laravel
install-laravel:
	sudo docker-compose down
	sudo rm -rf api
	mkdir api
	docker-compose up -d
	docker-compose exec php composer create-project --prefer-dist laravel/laravel .
	sudo chown ${USER}:${USER} -R api
	sudo chmod -R 777 api/bootstrap/cache
	sudo chmod -R 777 api/storage
	sudo rm api/.env
	cp .env.api api/.env
	docker-compose exec php php artisan key:generate --ansi
	docker-compose exec php composer require predis/predis
	docker-compose exec php php artisan --version

# Nuxt
install-nuxt:
	sudo docker-compose down
	sudo rm -rf client
	docker-compose run client yarn create nuxt-app ../client
	sudo chown ${USER}:${USER} -R client
	cp .env.client client/.env
	sed -i "1i require('dotenv').config()" client/nuxt.config.js
	docker-compose up -d
	docker-compose exec client yarn info nuxt version


#-----------------------------------------------------------
# Clearing
#-----------------------------------------------------------

# Shut down and remove all volumes
remove-volumes:
	sudo docker-compose down --volumes

# Remove all existing networks (useful if network already exists with the same attributes)
prune-networks:
	docker network prune

# Clear cache
prune-a:
	docker system prune -a
