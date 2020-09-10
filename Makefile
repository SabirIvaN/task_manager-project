install:
	php -r "file_exists('.env') || copy('.env.example', '.env');"
	composer install
	touch database/database.sqlite
	php artisan key:generate
	chmod -R 777 storage bootstrap/cache
lint:
	composer run-script phpcs -- --standard=PSR12 app tests
test:
	composer run-script phpunit tests
run:
	php -S localhost:8000 -t public
logs:
	tail -f storage/logs/*.log
