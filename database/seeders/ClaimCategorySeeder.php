<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ClaimCategory;
use App\Models\RequiredDocument;
use Illuminate\Database\Seeder;

class ClaimCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Buat Kategori
    $kanker = ClaimCategory::create([
        'name' => 'Klaim Penyakit Kanker',
        'description' => 'Prosedur klaim untuk tindakan kemoterapi dan radioterapi.'
    ]);

    // Tambah Dokumen Wajib untuk Kategori Kanker
    $kanker->requiredDocuments()->createMany([
        ['document_name' => 'KTP & Kartu BPJS'],
        ['document_name' => 'Surat Rujukan Faskes 1'],
        ['document_name' => 'Resume Medis dari Dokter Spesialis'],
        ['document_name' => 'Hasil Patologi Anatomi'],
    ]);




}
}
