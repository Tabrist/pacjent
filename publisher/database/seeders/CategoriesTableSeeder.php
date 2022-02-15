<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder {

    private $categories = [
        'Alergologia',
        'Alergologia - Panele Euroline',
        'Alergologia - Panele Polycheck',
        'Anemia',
        'Autoimmunologia',
        'Badania kału',
        'Badania ojcostwa i pokrewieństwa',
        'Badania podstawowe i biochemiczne',
        'Badania z moczu',
        'Celiakia',
        'Choroby nerek',
        'Choroby nowotworowe',
        'Choroby przenoszone drogą płciową',
        'Choroby przewodu pokarmowego',
        'Choroby sercowo-naczyniowe',
        'Choroby tarczycy',
        'Choroby trzustki',
        'Choroby wątroby',
        'Ciąża',
        'Cukrzyca',
        'Diagnostyka prenatalna',
        'Dietetyka, suplementacja',
        'Genetyczne podłoże chorób i predyspozycji do nich',
        'Hematologia',
        'Hormony płciowe i inne badania ginekologiczne',
        'Immunoglobuliny, składniki dopełniacza i inne białka',
        'Infekcje',
        'Infekcje odkleszczowe',
        'Infekcje tropikalne',
        'Inne',
        'Inne hormony i metabolity',
        'Koronawirus SARS-CoV-2',
        'Markery odczynów zapalnych i chorób reumatologicznych',
        'Mikrobiologia',
        'Monitorowanie stężenia leków',
        'Odporność',
        'Osteoporoza i zaburzenia kostne',
        'Serologia grup krwi',
        'Toksykologia',
        'Układ krzepnięcia',
        'Zaburzenia płodności, poronienia',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('category_test')->truncate();


        foreach ($this->categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }

}
