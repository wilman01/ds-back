<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Vehiversion;
use App\Models\Year;
use League\Csv\Reader;


class VersionyearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Esta línea es necesaria para que en una Mac se detecten 
        // correctamente los caracteres de nueva línea
        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');     
            }     
    
            $csv = Reader::createFromPath(public_path() . '/versionyear.csv', 'r');     
            // indicamos que el delimitador es el punto y coma
            $csv->setDelimiter(';');     
            // Indicamos el índice de la fila de nombres de columnas
            $csv->setHeaderOffset(0);     
            $records = $csv->getRecords();      
    
            foreach ($records as $r) {
                // $version = new Vehiversion();
                // $year = new Year();

                $version = Vehiversion::where('version', $r['Version'])->first();
                $year = Year::where('year', $r['Year'])->first();
                $version->years()->attach(array($year->id));
                //Vehiversion::where('version', $r['Version'])->first()->save(array($year->id));
            }
    }
}
