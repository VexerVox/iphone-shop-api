### Setup:

```shell
cp .env.example .env;
docker compose up -d;
```

### For commands:
```shell
docker exec -it iphoneshop-php bash;
```

### Queue:
```shell
docker exec -it iphoneshop-php bash;
php artisan queue:work;   # for production
php artisan queue:listen; # for development
```
