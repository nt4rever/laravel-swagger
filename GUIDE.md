How to run it?

```bash
cp .env.example .env
docker compose config
docker compose build
docker compose run --rm laravel sh /var/www/.docker/php/setup.sh
docker compose up -d

```
Migrate and seed database:
```bash
docker exec -it <container_name> sh
php artisan migrate --seed
```
