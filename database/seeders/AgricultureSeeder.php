<?php

namespace Database\Seeders;

use App\Models\Commodity;
use App\Models\District;
use App\Models\Pest;
use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use App\Models\Variety;
use Illuminate\Database\Seeder;

class AgricultureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create provinces
        $provinces = [
            ['name' => 'Jawa Barat', 'latitude' => -6.9147, 'longitude' => 107.6098],
            ['name' => 'Jawa Tengah', 'latitude' => -7.2575, 'longitude' => 110.1739],
            ['name' => 'Jawa Timur', 'latitude' => -7.5360, 'longitude' => 112.2384],
            ['name' => 'Sumatera Utara', 'latitude' => 3.5952, 'longitude' => 98.6722],
            ['name' => 'Sulawesi Selatan', 'latitude' => -5.1477, 'longitude' => 119.4327],
        ];

        foreach ($provinces as $provinceData) {
            $province = Province::create($provinceData);

            // Create 2-3 regencies per province
            for ($i = 1; $i <= 3; $i++) {
                $regency = Regency::create([
                    'province_id' => $province->id,
                    'name' => "Kabupaten " . $province->name . " " . $i,
                    'latitude' => $provinceData['latitude'] + (random_int(-100, 100) / 1000),
                    'longitude' => $provinceData['longitude'] + (random_int(-100, 100) / 1000),
                ]);

                // Create 3-5 districts per regency
                for ($j = 1; $j <= 4; $j++) {
                    District::create([
                        'regency_id' => $regency->id,
                        'name' => "Kecamatan " . chr(64 + $j),
                        'latitude' => $provinceData['latitude'] + (random_int(-200, 200) / 1000),
                        'longitude' => $provinceData['longitude'] + (random_int(-200, 200) / 1000),
                        'cropping_index' => random_int(100, 300) / 100,
                        'rainy_months' => random_int(6, 12),
                        'k_nutrient' => random_int(10, 50) / 10,
                        'p_nutrient' => random_int(5, 25) / 10,
                        'c_nutrient' => random_int(15, 35) / 10,
                        'cation_exchange_capacity' => random_int(20, 60) / 10,
                    ]);
                }
            }
        }

        // Create commodities
        $commodities = [
            [
                'name' => 'Kedelai',
                'description' => 'Tanaman legum yang kaya protein dan banyak dibudidayakan di Indonesia'
            ],
            [
                'name' => 'Kacang Tanah',
                'description' => 'Tanaman kacang-kacangan yang menghasilkan kacang dengan kandungan lemak tinggi'
            ],
            [
                'name' => 'Kacang Hijau',
                'description' => 'Tanaman legum yang tahan kekeringan dan cocok untuk rotasi tanaman'
            ]
        ];

        foreach ($commodities as $commodityData) {
            Commodity::create($commodityData);
        }

        // Create varieties
        $varieties = [
            // Kedelai varieties
            [
                'commodity_id' => 1,
                'name' => 'Grobogan',
                'release_year' => 2008,
                'potential_yield' => 2.5,
                'average_yield' => 1.8,
                'maturity_days' => 85,
                'plant_height' => 70,
                'seed_color' => 'Kuning',
                'seed_weight' => 14.5,
                'protein_content' => 40.2,
                'fat_content' => 18.5,
                'breeder' => 'Balitkabi',
                'proposer' => 'Kementerian Pertanian',
            ],
            [
                'commodity_id' => 1,
                'name' => 'Dena 1',
                'release_year' => 2001,
                'potential_yield' => 2.2,
                'average_yield' => 1.6,
                'maturity_days' => 82,
                'plant_height' => 65,
                'seed_color' => 'Kuning',
                'seed_weight' => 13.8,
                'protein_content' => 38.9,
                'fat_content' => 19.2,
                'breeder' => 'Balitkabi',
                'proposer' => 'Kementerian Pertanian',
            ],
            // Kacang Tanah varieties
            [
                'commodity_id' => 2,
                'name' => 'Hypoma 1',
                'release_year' => 1987,
                'potential_yield' => 2.8,
                'average_yield' => 2.0,
                'maturity_days' => 90,
                'plant_height' => 45,
                'seed_color' => 'Merah muda',
                'seed_weight' => 45.2,
                'protein_content' => 25.8,
                'fat_content' => 48.1,
                'breeder' => 'Balitkabi',
                'proposer' => 'Kementerian Pertanian',
            ],
            [
                'commodity_id' => 2,
                'name' => 'Kelinci',
                'release_year' => 1998,
                'potential_yield' => 2.5,
                'average_yield' => 1.8,
                'maturity_days' => 95,
                'plant_height' => 50,
                'seed_color' => 'Merah',
                'seed_weight' => 42.8,
                'protein_content' => 26.2,
                'fat_content' => 47.5,
                'breeder' => 'Balitkabi',
                'proposer' => 'Kementerian Pertanian',
            ],
            // Kacang Hijau varieties
            [
                'commodity_id' => 3,
                'name' => 'Vima 1',
                'release_year' => 1995,
                'potential_yield' => 1.5,
                'average_yield' => 1.0,
                'maturity_days' => 55,
                'plant_height' => 60,
                'seed_color' => 'Hijau',
                'seed_weight' => 4.2,
                'protein_content' => 24.8,
                'fat_content' => 1.5,
                'breeder' => 'Balitkabi',
                'proposer' => 'Kementerian Pertanian',
            ],
            [
                'commodity_id' => 3,
                'name' => 'Sriti',
                'release_year' => 1988,
                'potential_yield' => 1.3,
                'average_yield' => 0.9,
                'maturity_days' => 60,
                'plant_height' => 55,
                'seed_color' => 'Hijau tua',
                'seed_weight' => 3.8,
                'protein_content' => 23.5,
                'fat_content' => 1.8,
                'breeder' => 'Balitkabi',
                'proposer' => 'Kementerian Pertanian',
            ],
        ];

        foreach ($varieties as $varietyData) {
            Variety::create($varietyData);
        }

        // Create pests and diseases
        $pests = [
            [
                'name' => 'Ulat Grayak (Spodoptera litura)',
                'type' => 'pest',
                'target_plants' => 'Kedelai, Kacang Tanah, Kacang Hijau',
                'symptoms' => 'Daun berlubang, daun habis dimakan hanya tersisa tulang daun',
                'cultural_control' => 'Rotasi tanaman, sanitasi kebun, penanaman refugia',
                'physical_control' => 'Pemasangan perangkap feromon, hand picking',
                'chemical_control' => 'Aplikasi insektisida berbahan aktif klorpirifos',
                'biological_control' => 'Pelepasan parasitoid Trichogramma sp.',
            ],
            [
                'name' => 'Penggerek Polong (Etiella zinckenella)',
                'type' => 'pest',
                'target_plants' => 'Kedelai, Kacang Tanah, Kacang Hijau',
                'symptoms' => 'Polong berlubang, biji rusak, kotoran ulat di dalam polong',
                'cultural_control' => 'Panen tepat waktu, pembersihan gulma',
                'physical_control' => 'Pemasangan perangkap cahaya',
                'chemical_control' => 'Aplikasi insektisida sistemik saat pembentukan polong',
                'biological_control' => 'Konservasi musuh alami seperti laba-laba',
            ],
            [
                'name' => 'Karat Daun (Phakopsora pachyrhizi)',
                'type' => 'disease',
                'target_plants' => 'Kedelai',
                'symptoms' => 'Bercak kuning kecoklatan pada daun, spora berwarna coklat di bawah daun',
                'cultural_control' => 'Penggunaan varietas tahan, drainase yang baik',
                'physical_control' => 'Sanitasi kebun, pemangkasan daun sakit',
                'chemical_control' => 'Aplikasi fungisida berbahan aktif tebukonazol',
                'biological_control' => 'Penggunaan agen hayati Trichoderma sp.',
            ],
            [
                'name' => 'Busuk Batang (Sclerotium rolfsii)',
                'type' => 'disease',
                'target_plants' => 'Kacang Tanah, Kedelai',
                'symptoms' => 'Busuk pada pangkal batang, miselium putih di sekitar batang',
                'cultural_control' => 'Drainase baik, hindari penanaman terlalu dalam',
                'physical_control' => 'Pembersihan sisa tanaman yang terinfeksi',
                'chemical_control' => 'Perlakuan benih dengan fungisida',
                'biological_control' => 'Aplikasi Trichoderma harzianum',
            ],
            [
                'name' => 'Bercak Daun Cercospora (Cercospora canescens)',
                'type' => 'disease',
                'target_plants' => 'Kacang Hijau',
                'symptoms' => 'Bercak bulat coklat pada daun dengan tepi gelap',
                'cultural_control' => 'Rotasi tanaman, jarak tanam yang tepat',
                'physical_control' => 'Pembuangan daun yang terinfeksi',
                'chemical_control' => 'Aplikasi fungisida berbahan aktif mankozeb',
                'biological_control' => 'Penggunaan mikroorganisme antagonis',
            ],
        ];

        foreach ($pests as $pestData) {
            Pest::create($pestData);
        }

        // Create additional users with different roles
        $districts = District::all();
        
        // Create expert users
        User::create([
            'name' => 'Dr. Sari Pertanian',
            'email' => 'expert@agriculture.com',
            'password' => bcrypt('password'),
            'role' => 'expert',
            'district_id' => $districts->random()->id,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@agriculture.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'district_id' => null,
            'email_verified_at' => now(),
        ]);

        // Create regular users
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Petani " . $i,
                'email' => "user{$i}@agriculture.com",
                'password' => bcrypt('password'),
                'role' => 'user',
                'district_id' => $districts->random()->id,
                'email_verified_at' => now(),
            ]);
        }
    }
}