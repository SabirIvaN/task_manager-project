install:
	composer install
	npm install
	php -r "file_exists('.env') || copy('.env.example', '.env');"
	touch database/database.sqlite
	php artisan key:generate
	php artisan migrate
	chmod -R 777 storage bootstrap/cache

setup:
	composer install
	npm install
	php -r "file_exists('.env') || copy('.env.example', '.env');"
	php artisan key:generate
	chmod -R 777 storage bootstrap/cache
	php artisan migrate

seed:
	php artisan migrate:fresh
	php artisan db:seed

analyse:
	./vendor/bin/phpstan analyse --memory-limit=2G

lint:
	composer run-script phpcs -- --standard=PSR12 app config tests

test:
	php artisan test

test-coverage:
	composer phpunit tests -- --coverage-clover build/logs/clover.xml

run:
	npm run watch

logs:
	tail -f storage/logs/*.log
