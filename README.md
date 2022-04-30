
## XM Project Steps


- clone project
- cp .env.example .env
- cd xm-project
- run composer install and npm install
- run ./vendor/bin/sail up -d
- run ./vendor/bin/sail artisan migrate or docker-compose exec laravel.test php artisan migrate
- run ./vendor/bin/sail artisan queue:work or docker-compose exec laravel.test php artisan queue:work, to set the workers
- Browse on localhost:80, you can change the app port from .env file

## CAUTION
- You may get an error /usr/bin/env: 'bash\r': No such file or directory on the laravel docker container, depends on which system you are working (unix, windows). Solution for this: git config --global core.eol lf, and clone the project.
## Set up mailtrap
- You can configure on .env file the mailtrap crendetials, so you can test the mail functionality of the app. (https://mailtrap.io, for laravel)
