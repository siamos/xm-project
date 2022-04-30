
## XM Project Steps


- clone project
- cp .env.example .env and cd xm-project
- run composer install and npm install
- run ./vendor/bin/sail up -d or docker-compose up -d
- run ./vendor/bin/sail artisan migrate or docker-compose exec laravel.test php artisan migrate
- run ./vendor/bin/sail artisan queue:work or docker-compose exec laravel.test php artisan queue:work, to set the workers
- Browse on localhost:80, you can change the app port from .env file
