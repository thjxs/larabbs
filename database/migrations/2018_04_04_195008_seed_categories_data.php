<?php

use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name'        => 'share',
                'description' => 'create and descover',
            ],
            [
                'name'        => 'cursor',
                'description' => 'skill, develop',
            ],
            [
                'name'        => 'board',
                'description' => 'state',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
