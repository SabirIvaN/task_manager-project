install:
	composer install
	npm install
	php -r "file_exists('.env') || copy('.env.example', '.env');"
	php artisan key:generate
	chmod -R 777 storage bootstrap/cache
db:
	touch database/database.sqlite
	php artisan migrate
seed:
	php artisan migrate:fresh
	php artisan db:seed
analyse:
	./vendor/bin/phpstan analyse --memory-limit=2G
lint:
	composer run-script phpcs -- --standard=PSR12 app config tests
test:
	composer run-script phpunit tests
test-coverage:
	composer phpunit tests -- --coverage-clover build/logs/clover.xml
run:
	php -S localhost:8000 -t public
logs:
	tail -f storage/logs/*.log
