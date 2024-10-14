<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTenChampions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insérer les champions
        $champions = [
            ['name' => 'Zoe', 'title' => 'The Aspect of Twilight', 'lore' => 'Zoe is a cosmic messenger of Targon...', 'release_date' => '2017-11-21', 'gender_id' => 2, 'resource_id' => 1, 'year_id' => 9],
            ['name' => 'Bard', 'title' => 'The Wandering Caretaker', 'lore' => 'Bard travels through realms beyond...', 'release_date' => '2015-03-12', 'gender_id' => 3, 'resource_id' => 1, 'year_id' => 7],
            ['name' => 'Rengar', 'title' => 'The Pridestalker', 'lore' => 'Rengar is a ferocious vastayan...', 'release_date' => '2012-08-21', 'gender_id' => 1, 'resource_id' => 5, 'year_id' => 4],
            ['name' => 'Gnar', 'title' => 'The Missing Link', 'lore' => 'Gnar is a primitive yordle...', 'release_date' => '2014-08-14', 'gender_id' => 1, 'resource_id' => 3, 'year_id' => 6],
            ['name' => 'Rek\'Sai', 'title' => 'The Void Burrower', 'lore' => 'Rek\'Sai is a predator from the Void...', 'release_date' => '2014-12-11', 'gender_id' => 2, 'resource_id' => 3, 'year_id' => 6],
            ['name' => 'Senna', 'title' => 'The Redeemer', 'lore' => 'Senna is a tragic hero...', 'release_date' => '2019-11-10', 'gender_id' => 2, 'resource_id' => 1, 'year_id' => 11],
            ['name' => 'Zac', 'title' => 'The Secret Weapon', 'lore' => 'Zac is a Zaun-born golem...', 'release_date' => '2013-03-29', 'gender_id' => 1, 'resource_id' => 10, 'year_id' => 5],
            ['name' => 'Kennen', 'title' => 'The Heart of the Tempest', 'lore' => 'Kennen is an energetic yordle...', 'release_date' => '2010-04-08', 'gender_id' => 1, 'resource_id' => 2, 'year_id' => 2],
            ['name' => 'Vladimir', 'title' => 'The Crimson Reaper', 'lore' => 'Vladimir is a hemomancer...', 'release_date' => '2010-07-27', 'gender_id' => 1, 'resource_id' => 7, 'year_id' => 2],
            ['name' => 'Ornn', 'title' => 'The Fire Below the Mountain', 'lore' => 'Ornn is the Freljordian spirit...', 'release_date' => '2017-08-23', 'gender_id' => 1, 'resource_id' => 1, 'year_id' => 9],
        ];

        DB::table('champions')->insert($champions);

        // Associer les positions
        $positions = [
            'Zoe' => [3],
            'Bard' => [5],
            'Rengar' => [2],
            'Gnar' => [1],
            'Rek\'Sai' => [2],
            'Senna' => [4, 5],
            'Zac' => [1, 2],
            'Kennen' => [1, 3],
            'Vladimir' => [1, 3],
            'Ornn' => [1],
        ];

        foreach ($positions as $championName => $positionIds) {
            $championId = DB::table('champions')->where('name', $championName)->value('champion_id');
            foreach ($positionIds as $positionId) {
                DB::table('champion_position')->insert([
                    'champion_id' => $championId,
                    'position_id' => $positionId,
                ]);
            }
        }

        // Associer les types de portée
        $ranges = [
            'Zoe' => [2],
            'Bard' => [2],
            'Rengar' => [1],
            'Gnar' => [1, 2],
            'Rek\'Sai' => [1],
            'Senna' => [2],
            'Zac' => [1],
            'Kennen' => [2],
            'Vladimir' => [2],
            'Ornn' => [1],
        ];

        foreach ($ranges as $championName => $rangeIds) {
            $championId = DB::table('champions')->where('name', $championName)->value('champion_id');
            foreach ($rangeIds as $rangeId) {
                DB::table('champion_range')->insert([
                    'champion_id' => $championId,
                    'range_id' => $rangeId,
                ]);
            }
        }

        // Associer les régions
        $regions = [
            'Zoe' => [9],
            'Bard' => [1, 2, 3],
            'Rengar' => [13],
            'Gnar' => [10],
            'Rek\'Sai' => [11, 8],
            'Senna' => [7, 2],
            'Zac' => [12],
            'Kennen' => [4],
            'Vladimir' => [5],
            'Ornn' => [10],
        ];

        foreach ($regions as $championName => $regionIds) {
            $championId = DB::table('champions')->where('name', $championName)->value('champion_id');
            foreach ($regionIds as $regionId) {
                DB::table('champion_region')->insert([
                    'champion_id' => $championId,
                    'region_id' => $regionId,
                ]);
            }
        }

        // Associer les espèces
        $species = [
            'Zoe' => [10],
            'Bard' => [7],
            'Rengar' => [3],
            'Gnar' => [2, 3, 11],
            'Rek\'Sai' => [4],
            'Senna' => [1, 5],
            'Zac' => [6],
            'Kennen' => [2],
            'Vladimir' => [1],
            'Ornn' => [12, 13],
        ];

        foreach ($species as $championName => $specieIds) {
            $championId = DB::table('champions')->where('name', $championName)->value('champion_id');
            foreach ($specieIds as $specieId) {
                DB::table('champion_specie')->insert([
                    'champion_id' => $championId,
                    'specie_id' => $specieId,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Supprimer les champions et leurs relations associées
        $championNames = ['Zoe', 'Bard', 'Rengar', 'Gnar', 'Rek\'Sai', 'Senna', 'Zac', 'Kennen', 'Vladimir', 'Ornn'];

        foreach ($championNames as $name) {
            $champion = DB::table('champions')->where('name', $name)->first();
            if ($champion) {
                DB::table('champion_position')->where('champion_id', $champion->champion_id)->delete();
                DB::table('champion_range')->where('champion_id', $champion->champion_id)->delete();
                DB::table('champion_region')->where('champion_id', $champion->champion_id)->delete();
                DB::table('champion_specie')->where('champion_id', $champion->champion_id)->delete();
                DB::table('champions')->where('champion_id', $champion->champion_id)->delete();
            }
        }
    }
}