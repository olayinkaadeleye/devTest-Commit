## HERE is a simple DevTEST on Laravel and Vue SPA using CRUD   

This project captured a basic feature of a Many-to-Many Relationships.  Go ahead and clone this project, connect with database, import database from sql-backup located at root. In this project, vue will get your API url automatically from Laravel Route. All of Laravel routes you can access dynamically at VueJS with same name you give at laravel route.

See the live example at project

## How to run (Install)

1. Clone the project to your local server or your remote server

```gh repo clone
git clone git@github.com:olayinkaadeleye/devTest-Commit
cd test
sudo cp .env.example .env
php artisan key:generate
```
2. Create database to MySQL and import
3. Place your database information at .env file located at root directory
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vue_blog
DB_USERNAME=root
DB_PASSWORD=root

VueJS source?
```
VueJS source is located at root/resources/js/pages/
..Here you have the pages for both product and category.
.. and ....
VueJS source is located at root/resources/js/components/
-- Here you have the  header file
```

API endpoints for :{
- Query products
- Querying product by category
- Creating Products
- Updating and Deleting products } ..ALL provided in the api.php file. The routes are in index.js

Some feature have been removed: including authetication and unit testing

Related Packages:
1. Vform ( npm install vform)
2. ObjectFormdata ( npm install object-to-formdata)
