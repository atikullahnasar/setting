Setting Package

A simple and flexible Laravel package for managing system settings with a built-in admin panel, migrations, and routes.
This package helps you manage homepage sections, blog settings, and other configurable content easily.

Requirements

PHP ^8.0
Laravel ^9 / ^10 / ^11
must need to be have any kinds of authentication system

Composer

Installation Guide

Follow the steps below to install and configure the package in your Laravel project.

Step 1: Add the Repository

This package is not published on Packagist yet, so you need to add the GitHub repository manually to your main project’s composer.json file.

Add the following inside composer.json:

"repositories": [
{
"type": "vcs",
"url": "https://github.com/atikullahnasar/setting"
}
]

Save the file after adding this.

Step 2: Install the Package

Run the following command from your project root:

composer require atikullahnasar/setting:dev-main

Step 3: Publish the Migrations

Publish the package migrations using this command:

php artisan vendor:publish --provider="atikullahnasar\setting\Provider\SettingPackageServiceProvider" --tag=setting-migrations

Step 4: Run the Migrations

Run the database migrations:

php artisan migrate

then do this 1 or 2
1) "$this->call([CountrySeeder::class,]);" this on your project database/seeders/DatabaseSeeder.php and also call
"use atikullahnasar\setting\Database\Seeders\CountrySeeder;" use it in the top 
2) run in your command line (php artisan db:seed --class="atikullahnasar\setting\Database\Seeders\CountrySeeder")

Step 5: Access the Settings Panel

After installation, you can access the settings management panel from your browser:

/beft/settings

Example:

http://example.com/beft/settings

Features

Admin panel for managing system settings

Pre-built Blade views

Bootstrap-based UI

Easy integration with Laravel projects

Database-driven settings

Roadmap

Bootstrap UI (Completed)
Contributing

Contributions, bug reports, and feature requests are welcome.
Feel free to open an issue or submit a pull request.

License
This package is open-source software licensed under the MIT License.
