# Resource Management

This is a test assignment for managing resources.

## Installation

Run following composer and npm commands to build
```
composer install
```
```
npm install
npm run prod
```
---

Copy and rename .env.example and config your database connection.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
Run the migrations:
 ```
php artisan migrate
 ```

(Optionally) if you want to seed the database run:
 ```
php artisan migrate:fresh --seed
 ```

Run the following command to generate App keys:
 ```
php artisan key:generate
 ```

Link your Storage using the command:
 ```
php artisan storage:link
```
Serve your application:
```
php artisan serve
```
## Testing
You can run the tests using:
```
php artisan test
```
