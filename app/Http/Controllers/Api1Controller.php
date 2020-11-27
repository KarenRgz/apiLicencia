<?php
use DB;
use App\dbo.Dat_DatosGral;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Api1Controller extends Controller
{
    public function ingresar_datos (request $request) {
    	
    	$ciudadano= datosGral::where('Dat_Nombre', $request->input('nombre'))
    	->where('Dat_Paterno', '=', $request->input('apellido_paterno'))
    	->where('Dat_Materno', '=', $request->input('apellido_materno'))
    	->where('Dat_CURP', '=', $request->input('curp'))
    	->FirstOrFail();

    $licencia = Licencia::join('dbo.TipLic_TipoLicencia', 'TipLic_TipoLicencia.TipLic_id',
	->select('Lic_Licencias.*', 'TipLic_TipoLicencia.TipLic_Descripcion')
	->where('Lic_NumFolioAnterior', '=', $request->input('numero_licencia'));

	$json = array();
	$data = $licencia->get()->toArray();
	$json = json_decode(json_encode($data), true);

	foreach ($json as $value) {
		$cadena = response()->json([
			"datos"=>(object)array(
				"0"->(object)array(
					"0"=>(object)array(
						"0"=> "Datos del historial de licencias"
					),
					"1"=>(object)array(
						"0"=> "Numero de licencia",
						"1"=> $value['Lic_NumFolioAnterior']
					),
					"2"=>(object)array(
						"0"=>"Tipo licencia",
						"1"=> $value['TipLic_Descripcion']
					),
					"3"=>(object)array(
						"0"=>"Numero de expediente",
						"1"=>$value['Lic_Expediente']
					),
					"4"=>(object)array(
						"0"=>"Vigencia",
						"1"=>$value['Lic_Vigencia']
					"5"=>(object)array(
						"0"=>"Fecha de expedicion",
						"1"=>$value['Lic_Expedicion']
					),
					"6"=>(object)array(
						"0"=>"Fecha de vencimiento",
						"1"=>$value["Lic_vencimiento"]
					)
				)
			)
		]);
			return $cadena;
	}
	return view ('vista_previa.vista_datos', compact ('licencia'));
    }
}
