<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ApiController extends Controller
{
    public function index(){

        $dolarPorMes = [];

        return view('index', ['dolarPorMes' => $dolarPorMes]);
        
    }

    public function traerDolar(Request $request){

        $errors = [];
        $mes = $request->mes;
        
        // TODO: Podria descargarse excel por Ajax 

        if($mes){

            $mes = str_pad($mes, 2, "0", STR_PAD_LEFT);

            try{
                $url = "https://api.sbif.cl/api-sbifv3/recursos_api/dolar/2021/".$mes."?apikey=d8093171162117c0c6e8da895b00978d4e2b6a0e&formato=json";
                
                $dolarPorMes = Http::get($url)["Dolares"];

            }catch (Exception $e) {
                $errors[] = "Hubo un error al hacer la peticion"; // TODO: Ver el mensaje real del error y mejor manejo en caso de falla
            }      
            

            if($request->descargarExcel){

                $filename = "valor_dolar.xlsx";

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $sheet->setCellValue('A1', 'Fecha');
                $sheet->setCellValue('B1', 'Valor');

                $indexColumn = 2;
                foreach($dolarPorMes as $dolarDia){
                    $sheet->setCellValue('A'.$indexColumn, $dolarDia["Fecha"]);
                    $sheet->setCellValue('B'.$indexColumn, $dolarDia["Valor"]);

                    $indexColumn++;
                }

                $writer = new Xlsx($spreadsheet);
                $writer->save($filename);
                
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0');

                $writer->save('php://output');
            }

        }
        
        return view('index', ['dolarPorMes' => $dolarPorMes]);

    }
}
