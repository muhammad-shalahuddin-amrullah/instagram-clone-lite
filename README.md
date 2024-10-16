# Instagram-Clone-Lite

Instagram Clone Lite is a web application built using Laravel, designed to mimic the core functionalities of Instagram. This application provides various features for user registration, login, profile management, and post creation.

## Prerequisites

- Make sure Docker and Docker Compose are installed on your system.
- If using Windows, make sure Docker Desktop is enabled.

## Features

- User registration and authentication
- Profile management with the ability to update profile details and upload profile pictures
- Post creation with support for images and videos
- REST API for integration with other applications

## Installation

- Clone this repository
```bash
git clone https://github.com/your-username/instagram-clone-lite.git
```
- Enter the project directory
```bash
cd instagram-clone-lite
```
- Run composer install
```bash
composer install
```
- Copy the .env.example file into .env
- Open the .env file, find the DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD lines, then fill them with values as below:
```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=instagram_clone
DB_USERNAME=root
DB_PASSWORD=password
```
- Run Docker Compose
```bash
docker-compose up -d
```
Wait for the installation process to complete. 
After the deployment is complete, if you are using Windows:

- Open Docker Desktop.
- Navigate to the Containers tab and find the container with the name instagram-clone-lite.
- There will be 3 containers running, namely: instagram-clone-lite (PHP Laravel run on 8000), database (MySQL Database), phpmyadmin (phpMyAdmin run on 8081)

To open the web application:
- Click the port written on instagram-clone-lite container (port 8000) to open the Laravel page in the browser.
- If the Laravel page appears, the deployment process is successful.

To open the phpMyAdmin:
- Click the port written on phpMyAdmin container (port 8081).
- On the phpMyAdmin login page, enter the following credentials:
```bash
Server: db
Username: root
Password: password
```

## Database Migration

Before attempting to run the application, you must run a database migration. To do this:
- Open Docker Desktop, click the three-dot icon on the instagram-clone-lite container, and select Open in Terminal.
- Run the migration command:
```bash
php artisan migrate
```
- If there is a question “The database ‘instagram_clone’ does not exist on the ‘mysql’ connection, Would you like to create it?", select yes.
- After the migration is complete, you can start using the application.

## Testing the Application

To test the application, you can register a new user, log in, update your profile, and create posts. Make sure you have run the migration command before trying these features.


## Prerequisites

- Make sure Docker and Docker Compose are installed on your system.
- If using Windows, make sure Docker Desktop is enabled.


## Features

- Warehouse data management (item, stock, mutation)
- REST API for integration with other applications
- Authentication and authorization using Laravel Sanctum and Bearer Token
- Complete API documentation using Postman


## Installation

- Clone this repository
```bash
git clone https://github.com/Kocheng-Angkasa/Sistem-Gudang.git
```
- Enter the project directory
```bash
cd sistem-gudang
```
- Run composer install
```bash
composer install
```
- Copy the .env.example file into .env
- Open the .env file, find the DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD lines, then fill them with values as below:
```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=gudang
DB_USERNAME=root
DB_PASSWORD=password
```
- Run Docker Compose
```bash
docker-compose up -d
```
Wait for the installation process to complete. 
After the deployment is complete, if you are using Windows:

- Open Docker Desktop.
- Navigate to the Containers tab and find the container with the name sistem-gudang.
- There will be 3 containers running, namely: sistem-gudang (PHP Laravel run on 8000):, database (MySQL Database), phpmyadmin (phpMyAdmin run on 8081)

To open the web application:
- Click the port written on sistem-gudang container (port 8000) to open the Laravel page in the browser.
- If the Laravel page appears, the deployment process is successful.

To open the phpMyAdmin:
- Click the port written on phpMyAdmin container (port 8081).
- On the phpMyAdmin login page, enter the following credentials:
Enter the project directory
```bash
Server: db
Username: root
Password: password
```

## Database Migration

Before attempting to run API requests, you must run a database migration. To do this:
- Open Docker Desktop, click the three-dot icon on the sistem-gudang container, and select Open in Terminal.
- Run the migration command:
```bash
php artisan migrate
```
- if there is a question “The database ‘gudang’ does not exist on the ‘mysql’ connection,  Would you like to create it?", Select yes.
- After the migration is complete, you can try running the API request that has been provided.

## Testing the API Request

To test API requests, use Postman or a similar tool. You can follow further guidance in the Postman documentation provided:
 
[Postman API Documentation.](https://documenter.getpostman.com/view/23044633/2sAXqwYzcA)

Make sure you have run the migration command before trying the API.
