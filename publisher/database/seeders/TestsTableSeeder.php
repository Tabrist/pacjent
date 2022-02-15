<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Test;

class TestsTableSeeder extends Seeder {

    private $categories = [
        ['name' => 'IgE całkowite', 'code' => 700, 'categories' => ['1']],
        ['name' => 'IgE sp. rMal d 1, jabłko', 'code' => 3956, 'categories' => ['1']],
        ['name' => 'IgE sp. rMal d 4, jabłko', 'code' => 3957, 'categories' => ['1']],
        ['name' => 'IgE sp. B312 - Laktoza', 'code' => 3984, 'categories' => ['1']],
        ['name' => 'IgE sp. C1 - Penicylina G', 'code' => 3984, 'categories' => ['1']],
        ['name' => 'Panel białka mleka DPA-Dx (6 alergenów)', 'code' => 782, 'categories' => ['2']],
        ['name' => 'Panel oddechowy (21 alergenów)', 'code' => 807, 'categories' => ['2']],
        ['name' => 'Panel oddechowy z anty-CCD absorbentem', 'code' => 807, 'categories' => ['2']],
        ['name' => 'Panel pediatryczny (28 alergenów)', 'code' => 807, 'categories' => ['2']],
        ['name' => 'Panel oddechowy, drzewa (10 alergenów)', 'code' => 756, 'categories' => ['1', '2']],
        ['name' => 'Panel oddechowy, trawy, chwasty (10 alergenów)', 'code' => 755, 'categories' => ['1', '2']],
        ['name' => 'Badanie bez kategorii', 'code' => 000, 'categories' => []],
        ['name' => 'Badanie z wieloma kategoriami', 'code' => 9999, 'categories' => ['1', '2', '3', '4', '5']],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        foreach ($this->categories as $category) {
            Test::create([
                'name' => $category['name'],
                'code' => $category['code'],
            ])->categories()->sync($category['categories']);
        }
    }

}
