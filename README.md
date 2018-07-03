Api Restful Log
===============
Automatic create log for request, response, controller dan action

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist taufiqrahman/yii2-apirestlog "*"
```

or add

```
"taufiqrahman/yii2-apirestlog": "*"
```

to the require section of your `composer.json` file.

Database Migration
------------------
Check your database settings and run migration from your console:
```php
php yii migrate --migrationPath=@vendor/taufiqrahman/yii2-apirestlog/migrations
```
For more informations see [Database Migration Documentation](http://www.yiiframework.com/doc-2.0/guide-console-migrate.html#applying-migrations)

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
use Rahmansoft\Apirestlog\restlog;

class SomeController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['restlog']=
            [
                'class' => restlog::class,
                'LOG_ON_ERROR'=> true // get all error response, false value to disable error message in your log DB
            ];

        return $behaviors;
    }
```