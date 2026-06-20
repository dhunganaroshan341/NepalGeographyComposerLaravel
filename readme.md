# Nepal Geography for Laravel 🇳🇵

Complete Nepal administrative geography dataset for Laravel applications.

Includes:

* Country
* Provinces
* Districts
* Municipalities
* Relationships between all levels
* Seeder with official Nepal geography data

---

## Installation

Install via Composer:

```bash
composer require roshandhungana/nepal-geography
```

---

## Install Dataset

Run:

```bash
php artisan nepal:install
```

This command will:

1. Publish package migrations
2. Run migrations
3. Seed Nepal geography data

---

## Fresh Installation

To rebuild the database:

```bash
php artisan nepal:install --fresh
```

Warning:

```text
This will delete all existing database tables.
```

The command will:

1. Publish migrations
2. Run migrate:fresh
3. Recreate tables
4. Seed Nepal geography data

---

## Database Structure

Country

→ Province

→ District

→ Municipality

---

## Example Usage

```php
use RoshanDhungana\NepalGeography\Models\Province;

$province = Province::first();

$districts = $province->districts;
```

Get municipality:

```php
$municipality = Municipality::first();

$district = $municipality->district;
```

Get district province:

```php
$province = $district->province;
```

---

## Artisan Commands

Install:

```bash
php artisan nepal:install
```

Fresh Install:

```bash
php artisan nepal:install --fresh
```

Skip Confirmation:

```bash
php artisan nepal:install --fresh --force
```

---

## License

MIT
