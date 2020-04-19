# calculate-commission
Calculate commissions

## Installing packages
`docker run --rm -v $PWD:/app composer install`

## Generating autoload files
`docker run --rm -v $PWD:/app composer dump-autoload`

## Running program
`docker run --rm -v $PWD:/app php:7.4.4 php ./app/src/app.php ./app/data/input.txt`

## Running unit tests
`docker run --rm -v $PWD:/app php:7.4.4 php ./app/vendor/bin/phpunit ./app/src/`