docker-init:
	rm -f .env
	cp .env.local .env
	docker-compose up -d nginx php-fpm mysql redis
	make docker-ps
docker-ps:
	docker-compose ps
docker-start:
	docker-compose start
docker-down:
#	docker-compose down
	docker rm -f $(shell docker-compose ps -q)
docker-php:
	docker-compose exec --user=training php-fpm bash
node:
	docker-compose exec --user=node node bash