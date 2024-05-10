<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'role' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@elinas.com',
            'phone' => '62813xxx',
            'alamat' => 'purwokerto',
            'password' => Hash::make('admin123')
        ]);
        User::create([
            'role' => 'penjual',
            'name' => 'Penjual',
            'email' => 'penjual@elinas.com',
            'phone' => '62813xxx',
            'alamat' => 'purwokerto',
            'password' => Hash::make('penjual123')
        ]);
        User::create([
            'role' => 'pembeli',
            'name' => 'Pembeli',
            'email' => 'pembeli@elinas.com',
            'phone' => '62813xxx',
            'alamat' => 'purwokerto',
            'password' => Hash::make('pembeli123')
        ]);        
        Article::create([            
            'title' => 'Kurangnya Pemahaman Terkait Pentingnya Pengolahan Nanas',
            'slug'  => str_replace(' ', '-', 'Kurangnya Pemahaman Terkait Pentingnya Pengolahan Nanas'),            
            'article'  => '<p>Hampir setiap pengolahan nanas di desa Beluk, limbah kulit nanas tidak dimanfaatkan dengan baik.</p>',
            'user_id' => 1,            
        ]);
        Article::create([            
            'title' => 'Berhentinya subsidi pupuk organik dari pemerintah',
            'slug'  => str_replace(' ', '-', 'Berhentinya subsidi pupuk organik dari pemerintah'),            
            'article'  => '<p>Subsidi pupuk organik dari pemerintah sangat berpengaruh pada pertanian nanas di desa Beluk.</p>',
            'user_id' => 1,            
        ]);
        Article::create([            
            'title' => 'Jumlah Petani Nanas yang Banyak',
            'slug'  => str_replace(' ', '-', 'Jumlah Petani Nanas yang Banyak'),            
            'article'  => '<p>Hampir 85% penduduk desa Beluk pemalang bermatapencaharian sebagai petani nanas.</p>',
            'user_id' => 1,            
        ]);
    }
}
