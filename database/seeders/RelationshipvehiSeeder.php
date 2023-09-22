<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// use App\Models\Vehimodel;
// use App\Models\Vehiversion;
// use App\Models\Year;
use App\Models\RelationshipVehi;
use Illuminate\Database\Eloquent\Factories\Relationship;
use League\Csv\Reader;

class RelationshipvehiSeeder extends Seeder
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
    
            $csv = Reader::createFromPath(public_path() . '/relationship_vehi.csv', 'r');     
            // indicamos que el delimitador es el punto y coma
            $csv->setDelimiter(';');     
            // Indicamos el índice de la fila de nombres de columnas
            $csv->setHeaderOffset(0);     
            $records = $csv->getRecords();      
    
            foreach ($records as $r) {
                $data = [];

                $data = ['vehi_model'=>$r['Modelo'],
                        'vehi_version'=>$r['Version'],
                        'year'=>$r['Year']];
                
                $relation = new RelationshipVehi;
                $relation->save_relation($data);

                // $version = Vehiversion::where('version', $r['Version'])->first();
                // $year = Year::where('year', $r['Year'])->first();
                // $version->years()->attach(array($year->id));
                //Vehiversion::where('version', $r['Version'])->first()->save(array($year->id));
            }
    }
}
