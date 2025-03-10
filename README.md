# Probar Project Setup

## Explanation

1. **Step 1**: Clones the repository from GitHub to your local machine.
```bash
git clone https://github.com/AbdeleahmanEl-Desoky/probar.git
```
2. **Step 2**: Installs all the necessary PHP dependencies defined in composer.json.
```bash
composer install
```
3. **Step 3**: Copies the environment configuration file so you can customize it.
```bash
cp .env.example .env
```
4. **Step 4**: Generates the application key for encryption. This key is needed for session and other encrypted data storage.
```bash
php artisan key:generate
```
5. **Step 5**: Creates a symbolic link from `public/storage` to `storage/app/public`, allowing you to access files stored in storage publicly.
```bash
php artisan storage:link
```
6. **Step 6**: Runs any pending database migrations to create the necessary tables in your database.
```bash
php artisan migrate
```
7. **Step 7**: Runs any database seeders, which populate your database with default or sample data.
```bash
php artisan db:seed
```
8. **Step 8**: Serves the application on `http://localhost:8000`, so you can view it in your browser.
```bash
php artisan serve
```
This will guide users on how to set up the project from cloning the repository to serving it locally.





