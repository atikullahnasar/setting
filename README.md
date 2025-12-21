
# Laravel Setting Package

A simple and flexible Laravel package for managing system settings with a built-in admin panel, migrations, and routes. This package helps you manage homepage sections, blog settings, and other configurable content easily.

## Features

-   Admin panel for managing system settings
-   Pre-built Blade views
-   Bootstrap-based UI
-   Easy integration with Laravel projects
-   Database-driven settings

## Requirements

-   PHP ^8.0
-   Laravel ^9 / ^10 / ^11
-   An existing authentication system in your Laravel project.

## Installation

This package is not yet published on Packagist, so you'll need to add the repository to your project's `composer.json` file first.

### Step 0: Add the Repository to Composer

Add the following repository to your main project's `composer.json` file:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/atikullahnasar/setting"
    }
]
```

Save the file after adding this entry.

### Step 1: Install the Package

After adding the repository, you can install the package using Composer:

```bash
composer require atikullahnasar/setting:dev-main
```

### Step 2: Publish Assets

You need to publish the migrations and the configuration file.

**Publish the Migrations:**

```bash
php artisan vendor:publish --provider="atikullahnasar\setting\Provider\SettingPackageServiceProvider" --tag=setting-migrations
```

**Publish the Configuration File:**

This will create a `config/setting.php` file, allowing you to customize the views.

```bash
php artisan vendor:publish --tag=setting-config
```

### Step 3: Run the Migrations

Finally, run the database migrations to create the necessary tables for the settings:

```bash
php artisan migrate
```

### Step 4: Seed the Countries Table

This package requires a list of countries to function correctly. You have two options to seed this data:

**Option 1: Integrate with your main seeder**

1.  Open your project's `database/seeders/DatabaseSeeder.php` file.
2.  Add the following `use` statement at the top of the file:
    ```php
    use atikullahnasar\setting\Database\Seeders\CountrySeeder;
    ```
3.  Call the seeder inside the `run()` method:
    ```php
    public function run()
    {
        $this->call([
            CountrySeeder::class,
        ]);
    }
    ```
4.  Then run the main seeder command: `php artisan db:seed`

**Option 2: Run the seeder independently**

If you prefer not to modify your `DatabaseSeeder.php`, you can run the seeder directly from the command line:

```bash
php artisan db:seed --class="atikullahnasar\setting\Database\Seeders\CountrySeeder"
```

### Step 5: Access the Settings Panel

After completing the installation, you can access the settings management panel from the following URL:

```
/beft/settings
```

**Example:**

If your application is running at `http://example.com`, you can access the settings page at:

```
http://example.com/beft/settings
```

## Configuration

After publishing the configuration file, you can find it at `config/setting.php`. You can modify this file to suit your application's needs, such as changing the views or middleware.

## Roadmap

-   [x] Bootstrap UI

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue on the [GitHub repository](https://github.com/atikullahnasar/setting).

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
