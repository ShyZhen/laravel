
## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Environment

 - PHP >= 5.6.4
 - Apache
 - Mysql
 - Redis
 - Nodejs
 - ElasticSearch = 6.2.4 && ElasticSearch-analysis-ik (one index,one type)

## Installation

 - `git clone https://github.com/ShyZhen/laravel.git`
 - `copy .env.example .env` and edit .env
 - `composer install`
 - `npm install`
 - `php artisan migrate`  
 - `gulp`
 - `php artisan es:init`(create index and mapping for post)
 - `php artisan passport:install`


 ## Logs

 1. set post:user:{id} to redis for create post
 2. set user:email:{email} to redis for register code
 3. set login:times:{email} to redis for login time limit
 4. set password:email:{email} to redis for password code
