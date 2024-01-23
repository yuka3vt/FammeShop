<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use App\Models\Blogkategori;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Produkkategori;
use App\Models\Produkukuran;
use App\Models\Produkwarna;
use App\Models\User;
use App\Models\Wishlist;
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
            'nama' => 'Merah',
            'slug' => 'merah'
        ]);
        Produkwarna::create([
            'nama' => 'Hijau',
            'slug' => 'hijau'
        ]);
        Produkwarna::create([
            'nama' => 'Putih',
            'slug' => 'putih'
        ]);
        Produkwarna::create([
            'nama' => 'Hitam',
            'slug' => 'hitam'
        ]);
        
        Produkukuran::create([
            'nama' => 'M',
            'slug' => 'm'
        ]);
        Produkukuran::create([
            'nama' => 'L',
            'slug' => 'l'
        ]);
        Produkukuran::create([
            'nama' => 'XL',
            'slug' => 'xl'
        ]);
        Produkukuran::create([
            'nama' => 'XXL',
            'slug' => 'xxl'
        ]);
        User::create([
            'level' => 'admin',
            'nama' => 'Yuka Wardana',
            'jenis_kelamin' => 'Laki-Laki',
            'tempat_lahir' => 'Singkawang',
            'tanggal_lahir' => '2002-05-23',
            'username' => 'yuka3vt',
            'akun' => 'aktif',
            'telepon' => '0895377343574',
            'email' => 'yukawardana587@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        
        User::create([
            'nama' => 'Only One',
            'jenis_kelamin' => 'Laki-Laki',
            'tempat_lahir' => 'Singkawang',
            'tanggal_lahir' => '2002-05-23',
            'username' => 'onlyone',
            'akun' => 'aktif',
            'telepon' => '0895377343571',
            'email' => 'onlyone08482@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        
        User::create([
            'nama' => 'Faulina Indri',
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => 'Sebua',
            'tanggal_lahir' => '2021-12-17',
            'username' => 'indrifauline',
            'akun' => 'aktif',
            'telepon' => '0813009921',
            'email' => 'indrifaulina17@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $blogIDs = range(1, 100);
        shuffle($blogIDs);
        Blog::factory()
            ->times(100)
            ->create()
            ->each(function ($blog) use (&$blogIDs) {
                $kategoriIDs = [];
                $kategoriCount = mt_rand(1, 5);
                for ($i = 0; $i < $kategoriCount; $i++) {
                    $kategoriID = mt_rand(1, 5); 
                    if (!in_array($kategoriID, $kategoriIDs)) {
                        $kategoriIDs[] = $kategoriID;
                    }
                }
                foreach ($kategoriIDs as $kategoriID) {
                    $kategori = Blogkategori::find($kategoriID);
                    $blog->blogkategori()->attach($kategori);
                }
                $usedBlogID = array_shift($blogIDs);
            });
            $produkIDs = range(1, 20);
            shuffle($produkIDs);
            Produk::factory()
                ->times(20)
                ->create()
                ->each(function ($produk) use (&$produkIDs) {
                    $kategoriIDs = [];
                    $warnaIDs = [];
                    $ukuranIDs = [];
                    $kategoriCount = mt_rand(1, 4);
                    for ($i = 0; $i < $kategoriCount; $i++) {
                        $kategoriID = mt_rand(1, 4); 
                        if (!in_array($kategoriID, $kategoriIDs)) {
                            $kategoriIDs[] = $kategoriID;
                        }
                    }
                    $warnaCount = mt_rand(1, 4);
                    for ($i = 0; $i < $warnaCount; $i++) {
                        $warnaID = mt_rand(1, 4);
                        if (!in_array($warnaID, $warnaIDs)) {
                            $warnaIDs[] = $warnaID;
                        }
                    }
                    $ukuranCount = mt_rand(1, 4);
                    for ($i = 0; $i < $ukuranCount; $i++) {
                        $ukuranID = mt_rand(1, 4); 
                        if (!in_array($ukuranID, $ukuranIDs)) {
                            $ukuranIDs[] = $ukuranID;
                        }
                    }
                    foreach ($kategoriIDs as $kategoriID) {
                        $kategori = Produkkategori::find($kategoriID);
                        $produk->produkkategori()->attach($kategori);
                    }
                    foreach ($warnaIDs as $warnaID) {
                        $warna = Produkwarna::find($warnaID);
                        $produk->produkwarna()->attach($warna);
                    }
                    foreach ($ukuranIDs as $ukuranID) {
                        $ukuran = Produkukuran::find($ukuranID);
                        $produk->produkukuran()->attach($ukuran);
                    }
                    $usedProdukID = array_shift($produkIDs);
                });
    }
}
