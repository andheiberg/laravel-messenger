#L4 Messenger

Basic Messaging System for Laravel4

## Introduction
The main purpose of this package is providing an suited Foundation for extended communication platforms, based on laravel 4 (or compatible frameworks).

##Overview
You have many users and they want to chat? Couldn't be simplier!
We extended the standard Laravel User-Model to satisfy the requirements.

* Users have many conversations
* A conversation belongs to many users
* A message belongs to a single conversation
* A conversation consists of many Messages

### ER-Model Prototype

![ER-Model](https://googledrive.com/host/0B_FVWRYj6sQ7WG42TVp2U0ZmaDQ)


##Requirements

* Eloquent ORM

##Installation

First of all, integrate the source code into your project. You can do it, by adding the package name to your composer.json file and 
calling the update function:

*You will find a "require" section (enclosed within two curly brackets) in your project's composer file. Please add the given line (project name and version) there. The different package-requirements should be separeted with an comma, but the last one should not be terminated!*

example of an valid composer.json file:

```json
 {  
    "name": "company/yourproject",  
	"description": "some bla bla",  
	"keywords": ["framework", "laravel"],  
	"license": "free like free beer",  
	"require": {  
		"laravel/framework": "4.0.*",  
		"pichkrement/messenger": "dev-master",  
		"pichkrement/tokenauth": "dev-master"  
        },  
	"autoload": {  
		"classmap": [  
			"app/commands",  
			"app/controllers",  
			"app/models",  
			"app/database/migrations",  
			"app/database/seeds",  
			"app/tests/TestCase.php"  
		]  
	},  
	"scripts": {  
		"post-install-cmd": [  
			"php artisan optimize"  
		],  
		"post-update-cmd": [  
			"php artisan clear-compiled",  
			"php artisan optimize"  
		],  
		"post-create-project-cmd": [  
			"php artisan key:generate"  
		]  
	},  
	"config": {  
		"preferred-install": "dist"  
	},  
	"minimum-stability": "dev"  
 }  
```

Now you have to update your changes and integrate it. Call the *composer install* and *artisan migrate* command in the base-directory of your project (this is the parent folder of ./app ./public and ./src):

```bash
composer install && composer dump-autoload  
php artisan migrate --package "pichkrement/messenger"
```

If the first command does not work, you should check your composer installation! Is it installed and global available? (You will find one of the best installation guides [right here](http://askubuntu.com/questions/116960/global-installation-of-composer-manual#165241)). The second command migrates the database (if it throws an error, it's probably because your database is not configured yet. Just take a look at [this page](http://laravel.com/docs/database#configuration) for more details)

## Usage

Congratulations! Now you can use the laravel4 messenger.

Just extend your Eloquent ORM models (app/models/*) with the messenger-base models (Message, User and Conversation). It should look like this:

```php
// app/models/Conversation.php

<?php
class Conversation extends Pichkrement\Messenger\Models\Conversation {}
```

```php
// app/models/Message.php

<?php
class Message extends Pichkrement\Messenger\Models\Message {}
```

```php
// app/models/User.php

<?php
class User extends Pichkrement\Messenger\Models\User {}
```

### Examples
now you can use it like a pro.

#### Create new Converstions and add Messages:

```php

    //create new Conversation
    $c1 = Conversation::create(
    	array(
    		'name' => 'some name'
    		)
    	);
    
    //add authenticated User
    $c1->users()->attach(Auth::user()->id);

    //create new Message
    Message::create(
        array(
            'content' => "Hello World!" , 
            'user_id' => Auth::user()->id, 
            'conversation_id' => $c1->id
        )
    );

    //add other participants
    $c1->addUser(array(/* some user id's please */));


    //or using the alternative Syntax
    $c2 = new Conversation;
    $c2->name = "some name";
    $c2->save();

    //add all available users (untested)
    $c2->addUser( array_fetch(User::all()->toArray(), 'id') );
```

#### Fetch data

```php

    //get all Messages from a single conversation as array
    $data = Conversation::findOrFail($id)->messages()->get()->toArray();
    
    //get all conversations from the authenticated user
    $data = Auth::user()->conversations()->get()->toArray();
    
    //get one attribute form all members of a conversation (here the firstname)
    array_fetch( Conversation::find($conv_id)->users->toArray(), 'firstname' ))
```



