# Part 3/4: Refactor the following piece of legacy code

You do not need to write code, you may instead write all the problems you see and how you
would refactor this legacy piece of code. Bonus for thinking in an object-oriented way. Of course
you may also submit stubs of the code refactored if you have time.

Please note this is not at all code taken from Supermetrics.
```
<?php
    if ($_REQUEST['email']) {
        $masterEmail = $_REQUEST['email'];
    }
    $masterEmail = isset($masterEmail) && $masterEmail
            ? $masterEmail
            : array_key_exists('masterEmail', $_REQUEST) && $_REQUEST["masterEmail"]
            ? $_REQUEST['masterEmail'] : 'unknown';

    echo 'The master email is ' . $masterEmail . '\n';
    $conn = mysqli_connect('localhost', 'root', 'sldjfpoweifns', 'my_database');
    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='" .
    $masterEmail . "'");
    $row = mysqli_fetch_row($res);
    echo $row['username'] . "\n"
```

## Comments about what need to be refactored

#### Problem 1: Everything is in one file. 

Everything I mean:

- request dispatcher
- form/request data validation
- db connection init
- db data fetching
- php response generated through `echo` without any templating system

This problem makes code less readable, less maintainable, less stable, less secure. 
There is no way to detect and catch any exceptions.

If any developer will use this "style" we will have a lot of duplicates copy/pasted all around the project

**How to resolve problem 1**

We need to split this code into pieces to respect [SOLID principles](https://en.wikipedia.org/wiki/SOLID) and single-responsibility principle in particular

If we do this split developers can make code testable and stable.

Any developer will have an ability to reuse code created for specific need like: request processing, db connection and fetching, data output, etc...

#### Problem 2: Security. 

- [XSS](https://owasp.org/www-community/attacks/xss/) vulnerability
  
  Examples:
  
  ```echo 'The master email is ' . $masterEmail . '\n';```
  
  ``` echo $row['username'] . "\n"```
- Sensitive data disclosure vulnerability

    Example:
    
    ``` $conn = mysqli_connect('localhost', 'root', 'sldjfpoweifns', 'my_database');```
    
- SQL injection vulnerability

    Example:
    
    ```
        $res = mysqli_query($conn, "SELECT * FROM users WHERE email='" . $masterEmail . "'");
    ```

**How to resolve problem 2**

To resolve these issues we need to

- Not output any data that comes from user without proper sanitizing it.
- I would strongly recommend to use some templating system like: [Blade](https://laravel.com/docs/8.x/blade), [Twig](https://twig.symfony.com/), [Mustache](http://mustache.github.io/), etc...
- Never put any credentials of any services (Eg: DB connection credentials) in the code. It should be stored independently and should be provided by some service or during deployment process.
- Avoid generating raw SQL query strings. We should better to use either prepared statements or PDO libraries like: [Doctrine](https://www.doctrine-project.org/), [Eloquent](https://laravel.com/docs/5.0/eloquent)