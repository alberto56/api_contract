Plurals
=======

This folder contains three fictional projects:

 * Plurals frontend, whose job it is to communicate with the Plurals backend through the Plurals API.
 * Plurals backend, whose job it is to receive requests from the Plurals frontend and respond according to the Plurals API.
 * Plurals API, whose job it is to formalize the API used to communicate between the Plurals frontend and backend.

These projects are not meant to be secure or follow all best practices, but simply to demonstrate a basic usage of the [API Contract](https://github.com/alberto56/api_contract) system.

The common subfolder includes helper code which is used by both the backend and frontend. In a real project, the frontend and backend would be developed separately by different teams in different git repos, and would each have their own copy of common code.
