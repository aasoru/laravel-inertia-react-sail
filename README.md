# Laravel + Inertia (with React) + Sail (On Development)
Example APP with Laravel using Inertia (React.js) and Sail (docker)


## First - Install Docker
To get started, make sure you have [Docker installed](https://docs.docker.com/) on your system, and then clone this repository.

The following are built for our web server, with their exposed ports detailed:

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`
- **redis** - `:6379`
- **mailhog** - `:8025` 

## Installation

### Clone the repo locally:

```sh
git clone https://github.com/aasoru/laravel-inertia-react-sail.git
cd laravel-inertia-react-sail
```

_If you don't have Composer installed, [instructions here](https://getcomposer.org/)._

### Install PHP dependencies:
```sh
composer install
```

### Now we can start [Laravel Sail](https://laravel.com/docs/8.x/sail) and finish the set-up:
```sh
./vendor/bin/sail up
```

If you prefer you can create an Alias to use Sail (remember to create the alias every time the Terminal start):
```sh
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

With the alias we can use Laravel Sail like this:
```sh
sail up -d
```

### Finish Set-up

_If you don't have Node and NPM installed, [instructions here](https://www.npmjs.com/get-npm)._
#### Install NPM dependencies:
```sh
sail npm install
```

#### Build assets:
```sh
sail npm run dev
```

#### Create your environment file:
```sh
sail cp .env.example .env
```

_The app key is used to salt passwords. If you need to work with production data you'll want to use the same app key as defined in the .env file in production so password hashes match._
#### Generate application key:
```sh
sail artisan key:generate
```

#### Migrate and Seed (Force version, first time run app):
```sh
sail artisan migrate:refresh --seed --force
```


## Start Website
You're ready to go! [Visit Our New Website](http://localhost) in your browser, and login with:

- **Username:** johndoe@example.com
- **Password:** secret


## About Docker-Compose.yml File
By default, your MySQL data will persist after the containers are destroyed. If you would like to destroy mysql data just simply change the file:

1. Under the mysql service in your `docker-compose.yml` file, remove the following lines:

```
volumes:
  - ./mysql:/var/lib/mysql
```

## Useful Comands

### Bring any container down
```sh
sail down
```

### Remove sail container (this will erase all mysql data)
```sh
sail down -v
```
### Re-build the containers by running
```sh
sail build --no-cache
```

## Persistent MySQL Storage

By default, whenever you bring down the Docker network, your MySQL data will be removed after the containers are destroyed. If you would like to have persistent data that remains after bringing containers down and back up, do the following:

1. Under the mysql service in your `docker-compose.yml` file, add the following lines:

```
volumes:
  - ./mysql:/var/lib/mysql
```

## Using Laravel Mix (service ports not implemented yet)

If you want to enable the hot-reloading that comes with Laravel Mix's BrowserSync option, you'll have to follow a few small steps. First, ensure that you're using the updated `docker-compose.yml` with the `:3000` and `:3001` ports open on the npm service. Then, add the following to the end of your Laravel project's `webpack.mix.js` file:

From your terminal window at the project root, run the following command to start watching for changes with the npm container and its mapped ports:

```bash
sail npm run --rm --service-ports npm run watch
```

For normal use of Laravel Mix - Watch
```bash
sail npm run watch
```

That should keep a small info pane open in your terminal (which you can exit with Ctrl + C). Visiting [localhost:3000](http://localhost:3000) in your browser should then load up your Laravel application with BrowserSync enabled and hot-reloading active.


# Thanks to
- [Lado Lomidze](https://github.com/Landish/pingcrm-react)
