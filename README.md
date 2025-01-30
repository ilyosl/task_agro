REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 8.2 and PostgreSQL 15.

INSTALLATION
------------

### Clone from gitlab and install via Composer

You can then install this project template using the following command:
~~~
git clone <url>
~~~

~~~
cd <folder>
composer install
~~~
Generate keys and JWT

~~~
php artisan key:generate
php artisan jwt:secret
~~~

Create ENV file for config database.
~~~
cp .env.exmaple .env
~~~
Environments for database

````
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=task_agro
DB_USERNAME=postgres
DB_PASSWORD=123123
````

Now you have to run migration.

~~~
php artisan migrate
~~~

Run project by follow command:
~~~
php artisan serve --port=8000
