install:
	composer install

lint:
	composer exec --verbose phpcs src bin

test-coverage:
		composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml