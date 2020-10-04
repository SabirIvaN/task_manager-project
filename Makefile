install:
	composer install
	php -r "file_exists('.env') || copy('.env.example', '.env');"
	php artisan key:generate
	touch database/database.sqlite
	chmod -R 777 storage bootstrap/cache
seed:
	php artisan migrate:fresh
	php artisan db:seed
lint:
	composer run-script phpcs -- --standard=PSR12 app tests
test:
	composer run-script phpunit tests
run:
	php -S localhost:8000 -t public
logs:
	tail -f storage/logs/*.log
