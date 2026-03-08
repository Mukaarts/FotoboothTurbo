.PHONY: help init start stop restart db migration cc assets tailwind

help: ## Zeigt diese Hilfe an
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

init: ## Projekt initialisieren (Docker starten, Dependencies, DB erstellen)
	docker compose up -d
	composer install
	php bin/console tailwind:build
	php bin/console doctrine:database:create --if-not-exists
	php bin/console doctrine:migrations:migrate --no-interaction

start: ## Startet Docker, Symfony Server und Tailwind-Watcher
	docker compose up -d
	symfony server:start -d
	php bin/console tailwind:build --watch

stop: ## Stoppt alles (Symfony Server & Docker)
	symfony server:stop
	docker compose stop

restart: stop start ## Startet alles neu

db: ## Führt Datenbank-Migrationen aus
	php bin/console doctrine:migrations:migrate --no-interaction

migration: ## Erstellt eine neue Migration
	php bin/console make:migration

db-reset: ## Löscht die DB und erstellt sie komplett neu
	php bin/console doctrine:database:drop --force --if-exists
	php bin/console doctrine:database:create
	php bin/console doctrine:migrations:migrate --no-interaction

cc: ## Cache leeren
	php bin/console cache:clear

tailwind: ## Baut Tailwind CSS einmalig
	php bin/console tailwind:build

assets: ## Baut alle Assets für Production
	php bin/console tailwind:build --minify
	php bin/console asset-map:compile
