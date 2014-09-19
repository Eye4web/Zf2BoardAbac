Eye4web\Zf2BoardAbac
============

Introduction
============

This module will integrate `Eye4web\Zf2Board` and `Eye4web\Zf2Abac`, and also setup assertions for:

* Reading boards
* Reading/writing topics
* Writing/editing/deleting posts

Installation
------------
#### With composer

1. Add this project composer.json:

    ```json
    "require": {
        "eye4web/eye4web-zf2-board-abac": "dev-master"
    }
    ```

2. Now tell composer to download the module by running the command:

    ```bash
    $ php composer.phar update
    ```

3. Enable it in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'Eye4web\Zf2BoardAbac'
        ),
        // ...
    );
    ```

4. Creating permission groups

You are now able to use the assertions:

* board.read
* topic.read
* topic.write
* post.write
* post.edit
* post.delete