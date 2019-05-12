# Vacation Management Project

This is a simple web application using PHP, Laravel, MySQL and Docker Compose.

## Demo

[vacationmanagement.ml](http://vacationmanagement.ml/)

## Getting Started

These instructions will get you a copy of the project up and running on a cloud server with email notification. See below for notes on how to deploy the project on a live system.

### Prerequisites

#### Cloud Server

You need a server with docker compose installed.

I chose [DigitalOcean](https://m.do.co/c/3a4b7d44cada) droplet with docker compose pre-installed, you are free to choose otherwise.

* [Simple and clean youtube tutorial](https://www.youtube.com/watch?v=f7hCzwYBIXc)

#### Email Server

I used gmail smtp server, because it is free and this is a demo project. You are free to choose otherwise.

* Go to your google account
* Allow access for less secure apps
* Enable 2-step verification
* Create an app pasword for the project and save the password to write in .env file later

#### Domain Name

You need a domain name for the project. I used [freenom](https://www.freenom.com/) because it was free and easy however I don't think that this company is a safe and trustable for professional usage. I recommend using a more trustable company like [Namecheap](https://www.namecheap.com/) to register your domain name.

#### Google OAuth

This is the last step before installation. Save GOOGLE_CLIENT_ID and GOOGLE_CLIENT_SECRET in order to use it later.

* [Simple and clean youtube tutorial](https://www.youtube.com/watch?v=l5nxzSVlxKc)
* Follow the steps at the video and set the callback url to "{YOURDOMAINNAME}/oauth2callback"

### Installing

Basically, you will pull the project to the cloud server and connect the wires.
* Connect to your cloud server with docker compose installed and follow these steps.

#### Downloading Vacation Manager and Installing Dependencies

First, check that you are in your home directory and clone the laravel project to a directory called vacation-manager:

```bash
cd ~
git clone https://github.com/BestMidEver/vacation-manager vacation-manager
```

Move into the vacation-manager directory:

```bash
cd ~/vacation-manager
```

Next, use Docker's composer image to mount the directories that you will need for your Laravel project and avoid the overhead of installing Composer globally:

```bash
docker run --rm -v $(pwd):/app composer install

```

As a final step, set permissions on the project directory so that it is owned by your non-root user:

```bash
sudo chown -R $USER:$USER ~/vacation-manager
```

#### Running the Containers and Modifying Environment Settings

As a final step, though, you will make a copy of the .env.example file and name the copy .env, which is the file Laravel expects to define its environment:

```bash
cp .env.example .env
```

Open .env file

```bash
docker-compose exec app nano .env
```

* APP_URL = YOURDOMAINNAME
* MAIL_USERNAME = the email address, which will be used for sending notifications [Google OAuth](https://github.com/BestMidEver/vacation-manager#email-server)
* MAIL_PASSWORD = app password of the email address [Google OAuth](https://github.com/BestMidEver/vacation-manager#email-server)
* GOOGLE_CLIENT_ID = google client id [Google OAuth](https://github.com/BestMidEver/vacation-manager#google-oauth)
* GOOGLE_CLIENT_SECRET = google client id [Google OAuth](https://github.com/BestMidEver/vacation-manager#google-oauth)

Next, set the application key for the Laravel application

```bash
docker-compose exec app php artisan key:generate
```

#### Database

Create tables which are predefined.

```bash
docker-compose exec app php artisan migrate
```

##### Congratulations

Visit YOURDOMAINNAME in the browser.