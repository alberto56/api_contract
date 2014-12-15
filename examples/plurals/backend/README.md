Plurals Backend
===============

This project is an example of how one might develop an API implementor and test it based on an API contract.

To make sure our API implementor returns the correct data, the tester (examples/plurals/backend/tests/BackendTest.php) uses APIContract (src/APIContract.php) to feed it with example data and asserts that it returns the correct responses.

Because consumers of this API use the same API contract, we can be confident that we are developing an API implementation which works correctly with API consumers like examples/plurals/frontend.
