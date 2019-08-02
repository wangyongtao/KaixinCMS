# kaixincms

KaixinCMS: A Free PHP CMS based on Laravel Framework


## 安装 Installation

拉取代码，安装项目依赖文件，并复制默认的配置文件: 

```
$ git clone https://gitee.com/cnwyt/kxcms.git
$ cd kaixincms
$ composer up
$ cp .env.example .env
```

赋予存储目录读写权限：

```
$ mkdir -p storage/framework/sessions
$ mkdir -p storage/framework/views
$ mkdir -p storage/framework/cache
$ chmod 777 bootstrap/cache
$ chmod 777 -R storage
```

```
$ php artisan key:generate
$ php artisan optimize
```

* 数据库迁移

```
$ php artisan migrate
```

```
$ php artisan db:seed --class=UserRbacAuthSeeder
```

* php artisan

```
$ php artisan route:list
$ php artisan route:clear
$ php artisan route:cache
$ php artisan optimize

$ php artisan cache:clear
$ php artisan view:clear
```

* 代码格式化

```
$ php ./vendor/bin/php-cs-fixer fix app/
```


* 自定义日志目录：

创建一个日志目录，比如 `/nginx_logs/app_name`： 

```
$ sudo mkdir -p /nginx_logs/webapps/
$ sudo chmod -R 777 /nginx_logs/
```

修改 `.env` 配置文件, 指定日志文件路径： 

```
LOG_CHANNEL=daily
#LOG_PATH=logs/laravel.log
LOG_PATH=/nginx_logs/webapps/app-laravel.log
```

```php
mkdir -p node_modules/node-sass/vendor
sudo chmod -R 777 node_modules
sudo chmod -R 777 node_modules/node-sass/vendor
```


## Thanks 

PHP - PHP: Hypertext Preprocessor  
Laravel - The PHP Framework For Web Artisans  

[FriendsOfPHP/PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)  
[yadakhov/insert-on-duplicate-key](https://github.com/yadakhov/insert-on-duplicate-key)  
[spatie/laravel-activitylog](https://github.com/spatie/activitylog)  
[whichbrowser/parser](https://github.com/WhichBrowser/Parser-PHP)  

## License

MIT license