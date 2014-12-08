API Testing
===========

Formalize and test the API interface between a client and server.

Introduction
------------

Let's say you are developing two systems which are communicating together through a RESTful API, a problem often arises where the API itself is documented in a wiki, and is therefore immediately out of date.

Example
-------

You have a big project to display plural forms of English nouns. You separate your developers into two teams:

 * Team A designs the front-end, which allows people to enter a noun in the singular version.
 * Team B designs the back-end, which stores the plural versions of nouns and provides a RESTful interface to the front-end.

Problems will arise when you start documenting the API interfacing Team A and Team B. Nothing guarantees that the API documented in the Wiki is the same as the one used by Team A and Team B.

The API interface as a project
------------------------------

The approach proposed here is to not document the API interface, but to release it as a full fledged project.

Take a look at the `examples/plurals` folder herein for an example.
