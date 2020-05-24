## Laravel Pusher Chat
A super lightweight and very clean chat messaging web application built on laravel 7, VueJs, and Bootstrap 4. It users PusherJS, Laravel Broadcasting, Events, and Eloquent to clreat a real time chat room with online in chat users list and other users typing indicator with that users name.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

#### Table of contents
- [Features](#features)
- [Installation Instructions](#installation-instructions)
    - [Build the Front End Assets with Mix](#build-the-front-end-assets-with-mix)
- [Routes](#routes)
- [Environment File](#environment-file)
- [File Tree](#file-tree)
- [Laravel Pusher Chat License](#laravel-pusher-chat-license)

### Features
| Laravel Pusher Chat Features  |
| :------------ |
|Built on [Laravel 7](https://laravel.com/), [Bootstrap 4](https://getbootstrap.com/)|
|With [PusherJS](https://github.com/pusher/pusher-js), [Laravel Echo](https://laravel.com/docs/master/broadcasting#installing-laravel-echo), and [Vue.js](https://vuejs.org/)|
|Real time instant messaging in a group chat|
|Shows the name of other user typing while typing|
|Shows users logged in and have the group chat open|

### Installation Instructions
1. Run `git clone https://github.com/jeremykenedy/laravel-pusher-chat.git laravel-pusher-chat`
2. Create a MySQL database for the project
    * ```mysql -u root -p```, if using Vagrant: ```mysql -u homestead -psecret```
    * ```create database pusherchat;```
    * ```\q```
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
    * Create an account at [pusher.com](https://pusher.com/) to obtain your pusher api credentials for the `.env` file.
    * Valid `.env` variables `PUSHER_APP_ID`, `PUSHER_APP_KEY`, `PUSHER_APP_SECRET`, `PUSHER_APP_CLUSTER` are required.
    * You *must enable* **Force TLS** and **Enable client events** in your pusher channel in [pusher app settings](https://dashboard.pusher.com/apps).
5. Run `composer update` from the projects root folder
6. From the projects root folder run `php artisan key:generate`
7. From the projects root folder run `php artisan migrate`
8. From the projects root folder run `composer dump-autoload`
9. Compile the front end assets with [npm steps](#using-npm) or [yarn steps](#using-yarn).

#### Build the Front End Assets with Mix
##### Using NPM:
1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run production`
  * You can watch assets with `npm run watch`

##### Using Yarn:
1. From the projects root folder run `yarn install`
2. From the projects root folder run `yarn run dev` or `yarn run production`
  * You can watch assets with `yarn run watch`

###### And thats it with the caveat of setting up and configuring your development environment. I recommend [Laravel Homestead](https://laravel.com/docs/master/homestead)

### Routes
```bash
+--------+---------------+------------------------+------------------+------------------------------------------------------------------------+--------------+
| Domain | Method        | URI                    | Name             | Action                                                                 | Middleware   |
+--------+---------------+------------------------+------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD      | /                      |                  | Closure                                                                | web          |
|        | GET|HEAD      | api/user               |                  | Closure                                                                | api,auth:api |
|        | GET|POST|HEAD | broadcasting/auth      |                  | Illuminate\Broadcasting\BroadcastController@authenticate               | web          |
|        | GET|HEAD      | chats                  | chats            | App\Http\Controllers\ChatController@index                              | web,auth     |
|        | GET|HEAD      | home                   | home             | App\Http\Controllers\HomeController@index                              | web,auth     |
|        | GET|HEAD      | login                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST          | login                  |                  | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | POST          | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | GET|HEAD      | messages               | fetchMessages    | App\Http\Controllers\ChatController@fetchAllMessages                   | web,auth     |
|        | POST          | messages               | sendMessage      | App\Http\Controllers\ChatController@sendMessage                        | web,auth     |
|        | GET|HEAD      | password/confirm       | password.confirm | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web,auth     |
|        | POST          | password/confirm       |                  | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web,auth     |
|        | POST          | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web          |
|        | POST          | password/reset         | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web          |
|        | GET|HEAD      | password/reset         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web          |
|        | GET|HEAD      | password/reset/{token} | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web          |
|        | POST          | register               |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
|        | GET|HEAD      | register               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
+--------+---------------+------------------------+------------------+------------------------------------------------------------------------+--------------+


```

* Routes generate with `php artisan route:list`

### Environment File
Example `.env` file:

```bash

APP_NAME=LaravelPusherChat
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pusherchat
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=pusher
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"


```

### File Tree
```
laravel-pusher-chat
├── .editorconfig
├── .env.example
├── .gitattributes
├── .gitignore
├── .styleci.yml
├── README.md
├── app
│   ├── Chat.php
│   ├── Console
│   │   └── Kernel.php
│   ├── Events
│   │   └── ChatSent.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Auth
│   │   │   │   ├── ConfirmPasswordController.php
│   │   │   │   ├── ForgotPasswordController.php
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   ├── ResetPasswordController.php
│   │   │   │   └── VerificationController.php
│   │   │   ├── ChatController.php
│   │   │   ├── Controller.php
│   │   │   └── HomeController.php
│   │   ├── Kernel.php
│   │   └── Middleware
│   │       ├── Authenticate.php
│   │       ├── CheckForMaintenanceMode.php
│   │       ├── EncryptCookies.php
│   │       ├── RedirectIfAuthenticated.php
│   │       ├── TrimStrings.php
│   │       ├── TrustHosts.php
│   │       ├── TrustProxies.php
│   │       └── VerifyCsrfToken.php
│   ├── Listeners
│   │   └── SendChatMessage.php
│   ├── Providers
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── BroadcastServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   └── RouteServiceProvider.php
│   └── User.php
├── artisan
├── bootstrap
│   ├── app.php
│   └── cache
│       ├── .gitignore
│       ├── packages.php
│       └── services.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── broadcasting.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── filesystems.php
│   ├── hashing.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   ├── session.php
│   └── view.php
├── database
│   ├── .gitignore
│   ├── factories
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2014_10_12_100000_create_password_resets_table.php
│   │   ├── 2019_08_19_000000_create_failed_jobs_table.php
│   │   └── 2020_05_24_122626_create_chats_table.php
│   └── seeds
│       └── DatabaseSeeder.php
├── package-lock.json
├── package.json
├── phpunit.xml
├── public
│   ├── .htaccess
│   ├── css
│   │   └── app.css
│   ├── favicon.ico
│   ├── index.php
│   ├── js
│   │   ├── app.js
│   │   └── app.js.LICENSE.txt
│   ├── mix-manifest.json
│   ├── report.html
│   └── robots.txt
├── resources
│   ├── js
│   │   ├── app.js
│   │   ├── bootstrap.js
│   │   └── components
│   │       └── ChatComponent.vue
│   ├── lang
│   │   └── en
│   │       ├── auth.php
│   │       ├── pagination.php
│   │       ├── passwords.php
│   │       └── validation.php
│   ├── sass
│   │   ├── _variables.scss
│   │   └── app.scss
│   └── views
│       ├── auth
│       │   ├── login.blade.php
│       │   ├── passwords
│       │   │   ├── confirm.blade.php
│       │   │   ├── email.blade.php
│       │   │   └── reset.blade.php
│       │   ├── register.blade.php
│       │   └── verify.blade.php
│       ├── chat
│       │   └── chat.blade.php
│       ├── home.blade.php
│       ├── layouts
│       │   └── app.blade.php
│       └── welcome.blade.php
├── routes
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── server.php
└── webpack.mix.js

32 directories, 100 files
```

* Tree command can be installed using brew: `brew install tree`
* File tree generated using command `tree -a -I '.git|.env|node_modules|vendor|storage|tests'`

### Laravel Pusher Chat License
Laravel Pusher Chat is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
