# Instagram-Clone-Lite
![Instagram Clone Lite Mockup](path/to/your/mockup-image.png)

Instagram Clone Lite is a web application built using Laravel 10, designed to mimic the core functionalities of Instagram. This application provides various features for user registration, login, profile management, and post creation.

## Features

- User registration and authentication
- Profile management with the ability to update profile details and upload profile pictures
- Post creation with support for images and videos
- User login and logout functionality
- Viewing and managing user posts
- Database migration for setting up the application
- Error handling and fallback routes for undefined paths
- Exporting archives in XLSX and PDF formats
### Next Features
- Creating pages that do not exist yet
- Implementing like and comment functionality

## Prerequisites

- Ensure that a web server (such as Apache) and MySQL are available on your system.
- If using Windows, you can use Laragon.


## Installation

- Clone this repository
```bash
git clone https://github.com/muhammad-shalahuddin-amrullah/instagram-clone-lite.git
```
- Enter the project directory
```bash
cd instagram-clone-lite
```
- Run composer install
```bash
composer install
```
- Open the .env file, find the DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD lines, then fill them with values as below:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=instagram
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
- Run database migrations
```bash
php artisan migrate
```
If you see the following warning:
```bash
WARN  The database 'instagram' does not exist on the 'mysql' connection.

Would you like to create it? (yes/no) [no]
❯
```
Type `yes` to create the database.

- Run the user and post seeders
```bash
php artisan db:seed --class=userseeder
php artisan db:seed --class=postsseeder
```
- Start the Laravel development server
```bash
php artisan serve
```
- Open your browser and navigate to `http://127.0.0.1:8000` to access the application.

## Testing the Application

To test the application, you can register a new user, log in, update your profile, and create posts. Make sure you have run the migration command before trying these features.

You can also log in with the pre-seeded users using the following credentials:

- **User 1:**
    - Username: `user_01`
    - Password: `12345678`

- **User 2:**
    - Username: `user_02`
    - Password: `12345678`
