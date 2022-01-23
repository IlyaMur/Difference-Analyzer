install:
	composer install
lint:
	composer exec phpcs -- --standard=PSR12 src tests
test:
	composer exec --verbose phpunit tests
test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml
check:
	composer exec --verbose phpunit tests && composer exec phpcs -- --standard=PSR12 src tests
