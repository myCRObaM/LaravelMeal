<?php

namespace Database\Seeders;

use App\Models\Language;
use Exception;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            // Lang moze biti samo en i fr. Zasto?? nemam pojma, probao sam razonrazne kombinacije, vise stvari u arrayu i jednostavno odbija bilo kakvu suradnju. kad se stavi vise jezika ili neki drugi jezici (jedan od razloga zasto 
            // locale je string a ne int koji gleda na id tablice) puca. ... public function parameterize(array $values) LINIJA 136 u Grammar.php)
            foreach (['en', 'fr'] as $locale) {
                $language = new Language();
                $language->locale = $locale;
                $language->save();
            }
        } catch (Exception $e) {
            // ignore ako postoje podatci
        }
    }
}
