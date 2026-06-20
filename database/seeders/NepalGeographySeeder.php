<?php

namespace RoshanDhungana\NepalGeography\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class NepalGeographySeeder extends Seeder
{
   public function run(): void
{
$requiredTables = [
'countries',
'states',
'districts',
'municipalities',
];

```
foreach ($requiredTables as $table) {
    if (! Schema::hasTable($table)) {
        throw new \RuntimeException(
            "Required table [{$table}] not found. Please run migrations first."
        );
    }
}

$basePath = storage_path('app/nepal-geography');

if (! File::exists($basePath)) {
    throw new \RuntimeException(
        'Nepal geography data missing. Run: php artisan vendor:publish --tag=nepal-geography-data'
    );
}

// Rest of your seeder...
```

}

}
