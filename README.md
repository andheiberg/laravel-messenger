#L4 Messenger

Basic Messaging System for Laravel4

##Requirements

* Eloquent ORM

##Installation

1. *download l4 Messenger*: Open your composer.json and add following line to the require-section:

> "pichkrement/messenger" : "*",

2. got to your laravel-public folder and run

> composer install && composer dump-autoload  
> php artisan migrate --package "pichkrement/messenger"

3. add the new ServiceProvider to your **app/config/app.php** *(providers-array)*

> 'Pichkrement\Messenger\MessengerServiceProvider',


![ER-Model](https://googledrive.com/host/0B_FVWRYj6sQ7WG42TVp2U0ZmaDQ)