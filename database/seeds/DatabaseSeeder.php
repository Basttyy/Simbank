<?php

use Illuminate\Database\Seeder;
use App\CommandHistory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
	factory(CommandHistory::class, 15)->create();
    }
}
