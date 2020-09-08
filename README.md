### Installation

Created by Insite International

Install the dependencies and devDependencies and start the server.

```sh
$ cd CRM-DIMOND
$ composer install
$ npm install 
```

Run Migrations:
```sh
$ php artisan migrate
```

Run migrations for roles and permissions system:
```sh
$ php artisan migrate:fresh --seed --seeder=PermissionsDemoSeeder
$ php artisan db:seed --class=AlterPermissions
```
