<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = \CodeEditora\Models\Category::all();

        factory(CodeEditora\Models\Book::class,20)->create()->each(function($book) use($categories){

            $catRandom = $categories->random(4);
            $book->categories()->sync($catRandom->pluck('id')->all());
        });

    }
}
