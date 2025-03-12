# Installation:
1. Command: composer install
2. Setup enviromentfile to local DB
3. Command: php artisan migrate
4. Command: php artisan db:seed --class=CreateAdminUserSeeder
5. Command: php artisan serve

## In production its important to change password for user: mads@madslind.nu


# Tricks:

** create clean db: php artisan migrate:fresh