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

##Overview
You have many users and they want to chat? Couldn't be simplier!
We extended the standard Laravel User-Model to satisfy the requirements.

* Users have many conversations
* A conversation belongs to many users
* A message belongs to a single conversation
* A conversation consists of many Messages

### ER-Model Prototype

![ER-Model](https://googledrive.com/host/0B_FVWRYj6sQ7WG42TVp2U0ZmaDQ)