# Emoji Calculator

This is an arithmetic calculator based on emojis.

## Installation

`docker-compose` is required to install and run this project. To install `docker-compose`, please visit [this](https://docs.docker.com/compose/install/) link and follow the instructions.

Clone or download and unzip the application, open a terminal in the root directory and run
```
./vedor/bin/sail up
```
This will download all the dependencies, install them and run the application on port 3000 of your local machine.

To run the application on a different port, open the `.env` file in the root directory and set the desired port in the `APP_PORT` variable.

To stop the application, press  <kbd>ctrl</kbd>+<kbd>c</kbd> or <kbd>command</kbd>+<kbd>c</kbd> inside the terminal where the application is running.

## Approach

Laravel and jQuery have been used as the backend framework and frontend library respectively.

Routes: `routes/web.php`

Controller: `app/Http/Controllers/CalculatorController.php`

View: `resources/views/home.blade.php`

A user can view the website and interact with it as described in the acceptance criteria.

When a user submits the form, an ajax request will be made with the form data to the `calculate` route. The route will send the request to the `calculate` method of the `CalculatorController`. This method validates the request and performs the necessary calculations based on the given parameters and returns the result via JSON. The result is then extracted from the JSON and shown in the 'Result' field in the homepage. The appropriate operator is selected using a `switch` statement in the controller. The second operand is chosen as the divisor for division operations.
