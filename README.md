# Task manager

[![GitHub Actions](https://img.shields.io/endpoint.svg?url=https%3A%2F%2Factions-badge.atrox.dev%2Fatrox%2Fsync-dotenv%2Fbadge&label=build&logo=none)](https://github.com/SabirIvaN/php-project-lvl4.git) [![Maintainability](https://api.codeclimate.com/v1/badges/32431424f554ce147185/maintainability)](https://codeclimate.com/github/SabirIvaN/php-project-lvl4/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/32431424f554ce147185/test_coverage)](https://codeclimate.com/github/SabirIvaN/php-project-lvl4/test_coverage)

Service for orginizing tasks.  

Link to the: https://php-project-master-8kpyhisdvzh.herokuapp.com.

## Local installation

1. If you are installing the project locally run `make setup` to install dependencies, generate .env file and app key.
2. Run `make seed` if you want to seed the database.
3. Run `make run` to launch default web server — http://127.0.0.1:8000.
4. Run `make lint` to run linter and tests.

## Global installation on Heroku

1. Make a fork of the project.
2. Create an app.
3. Create a database.
4. Create environment variables.
5. To reset the database, use `make seed` in your Heroku CLI.
