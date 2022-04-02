# Emoji Calculator

This is an arithmetic calculator based on emojis.

## Installation

`Docker` and `Docker Compose` are required to install and run this project.

To install `Docker`, please visit [this](https://docs.docker.com/get-docker/) link and follow the instructions.

To install `Docker Compose`, please visit [this](https://docs.docker.com/compose/install/) link and follow the instructions.

After cloning the application, open a terminal in the `emoji-calculator` directory and run

```
$ docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

$ cp .env.example .env

$ APP_PORT=3000 ./vedor/bin/sail up -d

$ ./vedor/bin/sail artisan key:generate
```

This will download all the dependencies, install them, set the application key and run the application on port 3000 of your local machine.

You can visit [http://localhost:3000](https://docs.docker.com/compose/install/) to view the website.

To stop the application, run

```
$ ./vedor/bin/sail down
```

To run the application on your desired port number, run

```
$ APP_PORT=<port_number> ./vedor/bin/sail up -d
```

## Approach

Laravel and jQuery have been used as the backend framework and frontend library respectively.

Routes: `routes/web.php`

Controller: `app/Http/Controllers/CalculatorController.php`

View: `resources/views/home.blade.php`

A user can view the website and interact with it as described in the acceptance criteria.

When a user submits the form, an ajax request will be made with the form data to the `calculate` route. The route will send the request to the `calculate` method of the `CalculatorController`. This method validates the request and performs the necessary calculations based on the given parameters and returns the result via JSON. The result is then extracted from the JSON and shown in the 'Result' field in the homepage. The appropriate operator is selected using a `switch` statement in the controller. The second operand is chosen as the divisor for division operations.
