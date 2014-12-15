API Testing
===========

Formalize and test the API interface between a client and server.

Introduction
------------

Let's say you are developing two systems which are communicating together through a RESTful API, a problem often arises where the API itself is documented in a wiki, and is therefore immediately out of date.

Installation
------------

### Basic installation with examples

    git clone git@github.com:alberto56/apitesting.git
    cd apitesting
    cp examples/plurals/frontend/example.settings.php examples/plurals/frontend/settings.php
    cp examples/plurals/backend/example.settings.php examples/plurals/backend/settings.php
    git submodule init
    git submodule update

Example code and tests will require that certain files be accessible via HTTP. If you wish to try the examples or run tests, you must be able to visit `examples/plurals/frontend/index.php` and `examples/plurals/backend/index.php` on a web browser. If this project is available at `http://localhost/apitesting`, so that `http://localhost/apitesting/examples/plurals/frontend/index.php` gives you a simple form, then you have finished installation. Otherwise, modify the following two files and set `$settings['frontend_server']` and `$settings['backend_server']`:

 * `./examples/plurals/frontend/settings.php`
 * `./examples/plurals/backend/settings.php`

Example code
------------

This project contains example code to demonstrate how it might be used. Please note that it is not meant to be used as is, just as an example.

Example
-------

You have a big project to display plural forms of English nouns. You separate your developers into two teams:

 * Team A designs the front-end, which allows people to enter a noun in the singular version.
 * Team B designs the back-end, which stores the plural versions of nouns and provides a RESTful interface to the front-end.

Problems will arise when you start documenting the API interfacing Team A and Team B. Nothing guarantees that the API documented in the Wiki is the same as the one used by Team A and Team B.

Try out the

The API interface as a project
------------------------------

The approach proposed here is to not document the API interface, but to release it as a full fledged versioned project.

Take a look at the `examples/plurals` folder herein.

Once you have installed API Testing this on a web server at (for example) http://localhost/apitesting, you can visit http://localhost/apitesting/examples/plurals/frontend/, enter

How to run automated tests
--------------------------

 * Install [PHPUnit](https://phpunit.de)
 * Run `phpunit ./` from the command line at the root of the project.
