<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('genres')->truncate();
        $genres = [
            ['id' => 1, 'genre_name' => 'フットサル'],
            ['id' => 2, 'genre_name' => 'サッカー'],
            ['id' => 3, 'genre_name' => '野球'],
            ['id' => 4, 'genre_name' => 'バスケットボール'],
            ['id' => 5, 'genre_name' => 'テニス'],
            ['id' => 6, 'genre_name' => 'ゴルフ'],
            ['id' => 7, 'genre_name' => 'その他'],
        ];
        foreach ($genres as $genre) {
            DB::table('genres')->insert($genre);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
