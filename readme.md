####Create a production-ready simple REST API for searching in all Github code.

Requirements:
- Must be easy to replace, so I can change provider if I some day want to use GitLab or Bitbucket, or all of them
- Must have an endpoint that accepts a query, and returns the paginated result. One hit (result) must comprise of owner name, repository name and file name
- The number of hits per page should be 25 by default, but must be changeable by a query string parameter
- The page number should be changeable by a query string parameter
- The sorting should be by score, but must be changeable by a query string parameter

#### How to use
You need to make sure to perform all these actions to see the results:

- Clone the repository
- run composer install
- Setup docker (http://laradock.io/)
- Configure the .env file
- Sample routes for searching on Github:
  - `http://localhost/api/search/repository/github/{keyword}`
  - `http://localhost/api/search/repository/github/{keyword}/{sort}/{order}/{perPage}/{pageNumber}/`

####Technologies used
Technologies used for development:

- [Laravel 5.6](https://laravel.com/)
- [guzzleHttp/Guzzle package](https://packagist.org/packages/guzzlehttp/guzzle)

####Technologies used for deployment:

- [php]()
- [Docker](http://laradock.io/)
- [npm](https://www.npmjs.com/)
