# calculate-commission
Calculate commission

# Installing packages

`docker run --rm -v $PWD:/app composer install`

# Running Program

`docker run --rm -v $PWD:/app php:7.4.4 php ./app/src/app.php ./app/data/input.txt`

# Running Tests

`docker run --rm -v $PWD:/app php:7.4.4 php ./app/vendor/bin/phpunit ./app/src/`