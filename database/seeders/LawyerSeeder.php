<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LawyerProfile;
use Illuminate\Support\Facades\Hash;


class LawyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $lawyer = User::updateOrCreate(
    ['email' => 'budi@lawyer.com'], // Cari berdasarkan email
    [
        'name' => 'Budi Santoso, S.H.',
        'password' => Hash::make('password'),
        'role' => 'lawyer'
    ]
);

LawyerProfile::updateOrCreate(
    ['user_id' => $lawyer->id], // Cari berdasarkan user_id
    [
        'specialization' => 'Sengketa BPJS & Malpraktik',
        'base_price' => 500000,
        'bio' => 'Berpengalaman 10 tahun menangani klaim asuransi kesehatan.',
        'license_number' => 'PERADI-12345',
        'rating' => 4.8
    ]
    );

    $this->call([
        ClaimCategorySeeder::class,
        LawyerSeeder::class,
    ]);
}
}
