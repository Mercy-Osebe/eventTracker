<h1 align="center"> Task monitor </h1>


REQUIREMENTS
------------

- The minimum requirement by this project template that your Web server supports PHP 5.6.0.
- Apache web server
- Database of your choice preferrably mysql

## Setting up

1. Clone the appliction to the root of your web server e.g apache /var/www/html

1. Run `composer install` to install dependencies

1. Run migrations

    ```
    php yii migrate/fresh
    ```

    Select yes to all

1. To simulate members generating events [OPTIONAL]

    ```
    php yii clock
    ```


### Testing the application

1. Running the Task test
    ```
    php vendor/bin/codecept run unit tests/unit/models/TaskTest
    ```
