<?php

use Illuminate\Database\Seeder;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Book::class, 150)->create();
    }
}
