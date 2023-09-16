<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use App\Models\Blogkategori;
use App\Models\Produk;
use App\Models\Produkkategori;
use App\Models\Produkukuran;
use App\Models\Produkwarna;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        Blogkategori::create([
            'nama' => 'Baju Lebaran',
            'slug' => 'baju-lebaran'
        ]);
        Blogkategori::create([
            'nama' => 'Baju Natal',
            'slug' => 'baju-natal'
        ]);
        Blogkategori::create([
            'nama' => 'Fashion',
            'slug' => 'fashion'
        ]);
        Blogkategori::create([
            'nama' => 'Pantai',
            'slug' => 'pantai'
        ]);
        Blogkategori::create([
            'nama' => 'Musim Panas',
            'slug' => 'musim-panas'
        ]);


        Produkkategori::create([
            'nama' => 'Atasan Wanita',
            'slug' => 'atasan-wanita'
        ]);
        Produkkategori::create([
            'nama' => 'Bawahan Wanita',
            'slug' => 'bawahan-wanita'
        ]);
        Produkkategori::create([
            'nama' => 'Sepatu',
            'slug' => 'sepatu'
        ]);
        Produkkategori::create([
            'nama' => 'Tas Wanita',
            'slug' => 'tas-wanita'
        ]);


        Produkwarna::create([
            'nama' => 'Merah'
        ]);
        Produkukuran::create([
            'nama' => 'XL'
        ]);

        User::create([
            'level'=> 'admin',
            'nama' => 'Femme Shop',
            'username' => 'FemmeShop',
            'telepon' => '085752056623',
            'email' => 'femmeshop@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'nama' => 'Yuka Wardana',
            'username' => 'yuka3vt',
            'telepon' => '0895377343574',
            'email' => 'yuka@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        
        $blogIDs = range(1, 100);
        shuffle($blogIDs);
        Blog::factory()
            ->times(100)
            ->create()
            ->each(function ($blog) use (&$blogIDs) {
                $kategoriIDs = [];

                // Ambil sejumlah kategori acak antara 1 dan 5
                $kategoriCount = mt_rand(1, 5);
                for ($i = 0; $i < $kategoriCount; $i++) {
                    $kategoriID = mt_rand(1, 5); // Gantilah dengan jumlah kategori yang sesuai
                    if (!in_array($kategoriID, $kategoriIDs)) {
                        $kategoriIDs[] = $kategoriID;
                    }
                }

                // Hubungkan blog dengan kategori-kategori yang telah diambil
                foreach ($kategoriIDs as $kategoriID) {
                    $kategori = Blogkategori::find($kategoriID);
                    $blog->blogkategori()->attach($kategori);
                }
                // Hapus ID blog yang telah digunakan dari array
                $usedBlogID = array_shift($blogIDs);
            });

            
            $produkIDs = range(1, 20);
            shuffle($produkIDs);
            Produk::factory()
                ->times(20)
                ->create()
                ->each(function ($produk) use (&$produkIDs) {
                    $kategoriIDs = [];
    
                    // Ambil sejumlah kategori acak antara 1 dan 5
                    $kategoriCount = mt_rand(1, 4);
                    for ($i = 0; $i < $kategoriCount; $i++) {
                        $kategoriID = mt_rand(1, 4); // Gantilah dengan jumlah kategori yang sesuai
                        if (!in_array($kategoriID, $kategoriIDs)) {
                            $kategoriIDs[] = $kategoriID;
                        }
                    }
    
                    // Hubungkan produk dengan kategori-kategori yang telah diambil
                    foreach ($kategoriIDs as $kategoriID) {
                        $kategori = Produkkategori::find($kategoriID);
                        $produk->produkkategori()->attach($kategori);
                    }
                    // Hapus ID produk yang telah digunakan dari array
                    $usedProdukID = array_shift($produkIDs);
                });
        }
}
