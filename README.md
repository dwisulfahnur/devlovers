# How to run DevLovers App
## Clone repository

<tt>git clone https://gitlab.com/dwisulfahnur/devlovers</tt>

## Configure App
First, Go to the directory where the project is.
copy file .env.example to .env

<tt>copy .env.example .env </tt>

Install composer package require and generate key for laravel

<tt> composer install </tt>

<tt>php artisan key:generate </tt>


## Configure Database
This app using Mysql as database.
You need a database. 
To setup database to this application, setup in .env file and enter the command below

<tt>php artisan migrate</tt>

Then, you need some data in your database like City and Roles. You will found schema directory on this repository.
Import some schema in the directory to your database
then Run the app using the command below:

<tt>php artisan serve</tt>