The API description
===================

This folder is an example of how a real project might use API Contract. It contains a file called post.csv, which is a CSV (comma separated values) file which you can edit in Excel or another spreadsheet application. It should follow these rules:

 * each line is an example of a request and response
 * all columns whose header does not begin with "__" (two underscores) is request data
 * all column headers beginning with two underscores are reserved keywords and should not be used for data. (If you have a post parameter which begins with two underscores, this system does not support it, [file an issue](https://github.com/alberto56/api_contract/issues/new) if you need this feature)
 * all column headers beginning with three underscores are guaranteed to never be used by the system, so advanced users can use three underscores to prefix any internal data they need
 * the __response header will contain a response that a server should provide for particular data
 * only post data on a specific path is recognized for now, but you can work on [https://github.com/alberto56/api_contract/issues/2](this issue) if you need get parameters. I have no intention of allowing mixed POST and GET data. If you need that [please file an issue](https://github.com/alberto56/api_contract/issues/new).
