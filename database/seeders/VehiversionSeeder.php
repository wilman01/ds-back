<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Vehimodel;
use App\Models\Vehiversion;
use League\Csv\Reader;


class VehiversionSeeder extends Seeder
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
    
            $csv = Reader::createFromPath(public_path() . '/versions.csv', 'r');     
            // indicamos que el delimitador es el punto y coma
            $csv->setDelimiter(';');     
            // Indicamos el índice de la fila de nombres de columnas
            $csv->setHeaderOffset(0);     
            $records = $csv->getRecords();      
    
            foreach ($records as $r) {
                $version = new Vehiversion();
                //$modelo = Vehimodel::where('model', $r['Modelo'])->pluck('id');
                //$version->vehi_model_id = $modelo[0];
                $version->version = $r['Versiones'];       
                $version->save();
            }
    }
}
