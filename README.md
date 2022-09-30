# Quizzo

A simple plugin to help you set up WP Quizzes behind a WooCommerce PayWall.

## Screenshots

![alt text](https://github.com/chigozieorunta/quizzo/blob/master/screenshots/screenshot-1.png)

## Features

- Easy set up for Quizzes, Questions and Answers.
- Each new quiz utilizes the WooCommerce API to create a special Quizzo product type alongside its price, this means you can now sell your Quiz, if you wish to.
- WooCommerce (WC) paywall implementation for each Quiz, if required.
- Score module capturing for each Quiz session.
- Step-by-Step page feature for Quiz question.
- Timer/Counter feature for each Quiz question.
- Meta Data capturing for Quizzes, Questions and Answers.

## Requirements

- WordPress 5.0+
- WooCommerce
- PHP 7.2 or later
- [Composer](https://getcomposer.org) and [Node.js](https://nodejs.org) for dependency management.
- [Docker](https://docs.docker.com/install/) for a local development environment.

## Development

This repository includes a WordPress development environment based on [Docker](https://docs.docker.com/install/) that can be run on your computer like so:

1. Clone the plugin repository.

2. Setup the development environment and tools using [Node.js](https://nodejs.org) and [Composer](https://getcomposer.org):

```
npm install
```

Note that both Node.js and PHP 7.2 or later are required on your computer for running the `npm` scripts. Use `npm run docker -- npm install` to run the installer inside a Docker container if you don't have the required version of PHP installed locally.

3. To spin up your local development environment, run:

```
docker-compose up -d
```

which will make it available at [http://localhost:8888](http://localhost:8888)
