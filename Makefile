.PHONY: test

test:
	vendor/bin/phpunit test --testdox

init: env
	composer install

env:
	cp .env.dist .env
