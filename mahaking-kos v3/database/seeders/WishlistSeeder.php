<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wishlist;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        $wishlist = [
            ['id_favorit' => 'W0001', 'id_user' => 'U0002', 'id_kos' => 'K0001'],
            ['id_favorit' => 'W0002', 'id_user' => 'U0002', 'id_kos' => 'K0002'],
        ];

        foreach ($wishlist as $w) {
            Wishlist::create($w);
        }
    }
}