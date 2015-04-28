API Contract
===========

Formalize and test the API interface between a client and server.

Introduction
------------

API Contract is an implementation of [design by contract](http://en.wikipedia.org/wiki/Design_by_contract) applied to APIs, for API implementors and API consumers.

Let's say you are developing two systems which are communicating together through a RESTful API, a problem often arises where the API itself is documented in a wiki, and is therefore immediately out of date.

Using API Contract, you can write a CSV with examples of requests and responses, and then use `src/APIContract.php` to:

 * Provide the API consumer (frontend) with the correct responses to example inputs.
 * Test the API implementor (backend) by making sure it returns the correct responses for each given example input.

Other resources and projects
---------------

API Contract is meant to be very simple and applies to PHP projects only; it is mainly a proof of concept. If you are looking for something more robust, please see the following resources:

 * [Blog post: API as the definition of the truth](http://apievangelist.com/2014/07/15/an-api-definition-as-the-truth-in-the-api-contract/)
 * [Project: API blueprint](https://apiblueprint.org)
 * [Project: Swagger](http://swagger.io)
 * [Project: RAML](http://raml.org)
 * [Project: Pact](https://github.com/realestate-com-au/pact)

Installation
------------

### Basic installation with examples

    git clone git@github.com:alberto56/api_contract.git
    cd api_contract
    cp examples/plurals/frontend/example.settings.php examples/plurals/frontend/settings.php
    cp examples/plurals/backend/example.settings.php examples/plurals/backend/settings.php
    git submodule init
    git submodule update

Example code and tests will require that certain files be accessible via HTTP. If you wish to try the examples or run tests, you must be able to visit `examples/plurals/frontend/index.php` and `examples/plurals/backend/index.php` on a web browser. If this project is available at `http://localhost/api_contract`, so that `http://localhost/api_contract/examples/plurals/frontend/index.php` gives you a simple form, then you have finished installation. Otherwise, modify the following two files and set `$settings['frontend_server']` and `$settings['backend_server']`:

 * `./examples/plurals/frontend/settings.php`
 * `./examples/plurals/backend/settings.php`

Example code
------------

This project contains example code to demonstrate how it might be used. Please note that it is not meant to be used as is, just as an example.

Example: Plurals
----------------

You have a project to display plural forms of English nouns. You separate your developers into two teams:

 * Team A designs the front-end, which allows people to enter a noun in the singular version.
 * Team B designs the back-end, which stores the plural versions of nouns and provides a RESTful interface to the front-end.

Problems will arise when you start documenting the API interfacing Team A and Team B. Nothing guarantees that the API documented in the Wiki is the same as the one used by Team A and Team B.

### The API interface as a project

The approach proposed here is to not document the API interface, but to release it as a full fledged versioned project.

Take a look at the `examples/plurals/api` folder herein.

The idea is that the API Contract is a bona fide project. In a real-world project, the API contract would have its own issue queue and git repo.

Certain principles
------------------

 * The API consumer (frontend) developers have access to the API contract
 * The API implementor (backend) developers have access to the API contract
 * The API contract has its own git repo and issue queue
 * To change the API, teams work together by modifying the API Contract post.csv file via the issue queue.

How to run automated tests
--------------------------

 * Install [PHPUnit](https://phpunit.de)
 * Run `phpunit ./` from the command line at the root of the project.

Continuous integration
----------------------

There is currently an [open issue](https://github.com/alberto56/api_contract/issues/7) for integration with the [Travis CI](https://travis-ci.org/alberto56/api_contract) continuous integration platform.
