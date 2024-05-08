setup:
	@make build
	@make up 
	@make composer-update
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec ispmanager-docker bash -c "composer update"
data:
	docker exec ispmanager-docker bash -c "php artisan migrate"
	docker exec ispmanager-docker bash -c "php artisan db:seed --class=RoleSeeder"
	docker exec ispmanager-docker bash -c "php artisan db:seed --class=UserSeeder"
	docker exec ispmanager-docker bash -c "php artisan db:seed --class=TownshipSeeder"
	docker exec ispmanager-docker bash -c "php artisan db:seed --class=CustomerStatusSeeder"
	docker exec ispmanager-docker bash -c "php artisan db:seed --class=CustomerSeeder"
	docker exec ispmanager-docker bash -c "php artisan storage:link"
	docker exec ispmanager-docker bash -c "php artisan key:generate"
