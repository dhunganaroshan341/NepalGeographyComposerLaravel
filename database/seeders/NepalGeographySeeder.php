<?php
namespace RoshanDhungana\NepalGeography\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NepalGeographySeeder extends Seeder
{
    public function run(): void
    {
        $basePath = storage_path('app/nepal-geography');

        if (!File::exists($basePath)) {
            throw new \Exception('Nepal geography data not found. Run vendor:publish first.');
        }
// butg fixes
        $provinces = json_decode(File::get($basePath . '/provinces.json'), true);
        $districts = json_decode(File::get($basePath . '/districts.json'), true);
        $types     = json_decode(File::get($basePath . '/local_level_type.json'), true);
        $locals    = json_decode(File::get($basePath . '/local_levels.json'), true);

        $typeMap = [];
        foreach ($types as $t) {
            $typeMap[$t['local_level_type_id']] = [
                'name' => $t['name'],
                'nepali_name' => $t['nepali_name'] ?? null,
            ];
        }

        // Clear data safely
        DB::table('vdc_municipalities')->delete();
        DB::table('districts')->delete();
        DB::table('states')->delete();
        DB::table('countries')->delete();

        // Insert country
        $nepalId = DB::table('countries')->insertGetId([
            'name' => 'Nepal',
            'iso2' => 'NP',
            'iso3' => 'NPL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Provinces
        foreach ($provinces as $p) {
            DB::table('states')->insert([
                'id' => $p['province_id'],
                'country_id' => $nepalId,
                'name' => $p['name'],
                'nepali_name' => $p['nepali_name'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Districts
        foreach ($districts as $d) {
            DB::table('districts')->insert([
                'id' => $d['district_id'],
                'state_id' => $d['province_id'],
                'name' => $d['name'],
                'nepali_name' => $d['nepali_name'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Local levels
        foreach ($locals as $m) {
            $type = $typeMap[$m['local_level_type_id']] ?? null;

            DB::table('vdc_municipalities')->insert([
                'id' => $m['municipality_id'],
                'district_id' => $m['district_id'],
                'name' => $m['name'],
                'nepali_name' => $m['nepali_name'] ?? null,
                'local_level_type' => $type['name'] ?? null,
                'local_level_nepali' => $type['nepali_name'] ?? null,
                'total_wards' => $m['wards'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
