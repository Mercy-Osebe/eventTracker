<h1 align="center"> Task monitor </h1>

DESCRIPTION
------------

This application uses yii2 framework to build the task monitor

API DOC
-----------

Fetch recent event

    http://localhost/event-tracker/web/api/events/recent-event

Fetch report all

    http://localhost/event-tracker/web/api/events/report
REQUIREMENTS
------------

- The minimum requirement by this project template that your Web server supports PHP 5.6.0.
- Apache web server
- Database of your choice preferrably mysql

## Setting up

1. create two database in your db

        event_tracker (for application)
        task_test_db (for test)

1. Clone the appliction to the root of your web server e.g apache /var/www/html/event-tracker

1. Rename the cloned folder to event-tracker

1. cd into the event-tracker folder

1. Run `composer install` to install dependencies

1. Run this two commands


    ```bash
    chmod -R 777 web/assets
    chmod -R 777 web/runtime
    ```

1. Run migrations

    ```
    php yii migrate/fresh
    ```

    Select yes to all

1. To access the application on browser use this link

        http://localhost/event-tracker/web/site/index

1. To simulate members generating events [OPTIONAL]

    ```
    php yii clock
    ```


### Testing the application

1. Running the Task test
    ```
    php vendor/bin/codecept run unit tests/unit/models/TaskTest
    ```
