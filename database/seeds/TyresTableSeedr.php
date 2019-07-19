<?php

use Illuminate\Database\Seeder;

class TyresTableSeedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tyre::class, 30)->create();
    }
}
