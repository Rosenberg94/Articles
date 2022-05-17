## About Project

1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. php artisan migrate
5. php artisan db:seed
6. php artisan storage:links
7. chmod -R 777/public

## Attention
1. ONLY User with ROLE_ID = ROLE_ADMIN //(default = 1)// can create, edit & delete categories
2. ONLY author of current article/comment or User with ROLE_ID = ROLE_ADMIN can edit & delete this article/comment
