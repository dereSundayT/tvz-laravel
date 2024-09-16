setup:
	@make build
	@make up
	@make data
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec tvz-test-container bash -c "composer update"
data:
	docker exec tvz-laravel-app bash -c "composer install"
	docker exec tvz-laravel-app bash -c "cp -r .env.example .env"
	docker exec tvz-laravel-app bash -c "composer dump-autoload"
	docker exec tvz-laravel-app bash -c "php artisan migrate"
	docker exec tvz-laravel-app bash -c "php artisan migrate:fresh --seed"
	docker exec tvz-laravel-app bash -c "php artisan storage:link"
	docker exec tvz-laravel-app bash -c "php artisan queue:work"
