# Probar Project Setup

## Explanation

1. **Step 1** - `git clone https://github.com/AbdeleahmanEl-Desoky/probar.git`: Clones the repository from GitHub to your local machine.
2. **Step 2** - `composer install`: Installs all the necessary PHP dependencies defined in `composer.json`.
3. **Step 3** - `cp .env.example .env`: Copies the environment configuration file so you can customize it.
4. **Step 4** - `php artisan key:generate`: Generates the application key for encryption. This key is needed for session and other encrypted data storage.
5. **Step 5** - `php artisan storage:link`: Creates a symbolic link from `public/storage` to `storage/app/public`, allowing you to access files stored in storage publicly.
6. **Step 6** - `php artisan migrate`: Runs any pending database migrations to create the necessary tables in your database.
7. **Step 7** - `php artisan db:seed`: Runs any database seeders, which populate your database with default or sample data.
8. **Step 8** - `php artisan serve`: Serves the application on `http://localhost:8000`, so you can view it in your browser.

This will guide users on how to set up the project from cloning the repository to serving it locally.
