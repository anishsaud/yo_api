## Backend setup guide

This setup requires docker.

1. Clone project (yo_api)
2. cd yo_api
3. Install composer dependencies (ref: https://laravel.com/docs/9.x/sail#installing-composer-dependencies-for-existing-projects)

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

4. Start the sail instance (./vendor/bin/sail up -d)
5. Copy .env.example to .env
6. Generate application key ( ./vendor/bin/sail artisan key:generate )
7. Run migrations & seed database ( ./vendor/bin/sail artisan migrate --seed )
   (Seeding creates a test user; email: test@example.com pass: password)

Backend/api should now be up on 'localhost:8008'; navigating there should show laravel version.

8. Start websocket server ( ./vendor/bin/sail artisan websockets:serve ). This server runs on port 6001
9. Start horizon ( ./vendor/bin/sail artisan horizon )

# TODO

-   Broadcast via private channel
-   Fronend sorting via api
-   Writing Tests
