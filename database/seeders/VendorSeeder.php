<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 100; $i++) {
            // DB::beginTransaction();
            // try {    
            $desa = Desa::inRandomOrder()->first();
            $vendor = Vendor::create([
                'nama_perusahaan' => $faker->company,
                'alamat' => $faker->address,
                'logo' => NULL,
                'email_perusahaan' => $faker->email,
                'telepon' => '0812345612' . $i,
                'kecamatan_id' => $desa->kecamatan_id,
                'desa_id' => $desa->id,
                'kategori_id' => 2,
            ]);

            User::create([
                'name' => $faker->name,
                'url_name' => 'superadmin' . '-' . Str::random(100) . '-' . date('Ymdhis'),
                'confirmed'  => 1,
                'role'  => 'vendor',
                'status'  => 1,
                'email' => $faker->email,
                'confirm_url' => Str::random(60) . '-' . date('Ymdhis'),
                'password' => Hash::make('password123'),
                'full_field'  => '1',
                'vendor_id' => $vendor->id,
                'desa_id' => NULL,
            ]);
            // } catch (QueryException $qe) {
            //     DB::rollback();
            // }
        }
    }
}
