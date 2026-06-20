# Nepal Geography for Laravel 🇳🇵

A Laravel package providing Nepal's complete administrative geography dataset, including provinces, districts, municipalities, cities, and wards.

## Features

* 🇳🇵 Nepal country dataset
* 🏔️ 7 Provinces
* 🗺️ 77 Districts
* 🏘️ Municipalities and Rural Municipalities
* 🏙️ Cities
* 🏠 Wards
* Eloquent-ready database structure
* Automated installation command
* Supports Laravel 10, 11, and 12
* Supports PHP 8.2+

---

## Installation

Install the package via Composer:

```bash
composer require roshan-dhungana/nepal-geography
```

---

## Setup

Run the installation command:

```bash
php artisan nepal:install
```

The installer will automatically:

1. Publish Nepal geography JSON data
2. Run package migrations
3. Seed Nepal geography records

---

## Fresh Installation

To completely rebuild your database:

```bash
php artisan nepal:install --fresh
```

Or skip confirmation:

```bash
php artisan nepal:install --fresh --force
```

⚠️ Warning:

```text
This command will delete all existing database tables and recreate them.
```

The installer will:

1. Publish Nepal geography JSON data
2. Run migrate:fresh
3. Recreate all tables
4. Seed Nepal geography data

---

## Database Structure

```text
Country
 └── Province
      └── District
           └── Municipality
                └── City
                     └── Ward
```

---

## Example Usage

### Provinces

```php
use RoshanDhungana\NepalGeography\Models\State;

$province = State::first();
```

### Districts of a Province

```php
$districts = $province->districts;
```

### Municipality

```php
$municipality = Municipality::first();

$district = $municipality->district;
```

### Province from District

```php
$province = $district->state;
```

---

## Available Commands

### Install

```bash
php artisan nepal:install
```

### Fresh Install

```bash
php artisan nepal:install --fresh
```

### Skip Confirmation

```bash
php artisan nepal:install --fresh --force
```

---

## Supported Versions

| Package | Support |
| ------- | ------- |
| PHP     | 8.2+    |
| Laravel | 10.x    |
| Laravel | 11.x    |
| Laravel | 12.x    |

---

## License

MIT License

---

## Author

Roshan Dhungana

GitHub:
https://github.com/dhunganaroshan341/NepalGeographyComposerLaravel
