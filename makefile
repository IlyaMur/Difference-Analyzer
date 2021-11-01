install:
	composer install

lint:
	composer exec phpcs -- --standard=PSR12 src bin tests

test-coverage:
	composer exec phpunit -- --coverage-clover build/logs/clover.xml
