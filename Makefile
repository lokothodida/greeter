.PHONY: test web

test: phpunit phpstan

phpunit:
	vendor/bin/phpunit test --testdox

phpstan:
	vendor/bin/phpstan analyse src test -l 7


init: env
	composer install

env:
	cp .env.dist .env

web:
	php -S 0.0.0.0:8000 -t web/public web/public/index.php
