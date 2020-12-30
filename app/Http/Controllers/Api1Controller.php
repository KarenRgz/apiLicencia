<?php
use DB;
use App\dbo.Dat_DatosGral;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Api1Controller extends Controller

{
	{
		public function store  (Request $request)
		{
			$token_web_form - Token::select('tokens.*')->('id_token', '-', '1')->get();
			foreach ($token_web_form as $value) {
				$token_web_form = $value->token;
			}
			$data = [ 
				"ews_token"=> strip_tags(trim($request->input('ews_token'))), 
				"ews_no_solicitud"=> strip_tags(trim($request->input('ews_no_solicitud'))), 
				"ews_llave"=> strip_tags(trim($request->input('ews_llave'))), 
				"ews_id_tramite"=> strip_tags(trim($request->input('ews_id_tramite'))), 
				"ews_fecha_solicitud"=> strip_tags(trim($request->input('ews_fecha_solicitud'))),
				"ews_hora_solicitud"=> strip_tags(trim($request->input('ews_hora_solicitud'))),
				"ews_nombre"=> strip_tags(trim($request->input('ews_nombre'))),
				"ews_apellido_paterno"=> strip_tags(trim($request->input('ews_apellido_paterno'))),
				"ews_apellido_materno"=> strip_tags(trim($request->input('ews_apellido_materno'))),
				"ews_curp"=> strip_tags(trim($request->input('ews_curp'))),
				"ews_licencia"=> strip_tags(trim($request->input('ews_licencia'))),
				"ews_edad"=> strip_tags(trim($request->input('ews_edad'))),
				"ews_lugar_nacimiento"=> strip_tags(trim($request->input('ews_lugar_nacimiento'))),
				"ews_telefono"=> strip_tags(trim($request->input('ews_telefono'))),
				"ews_nombre_avisar"=> strip_tags(trim($request->input('ews_nombre_avisar'))),
				"ews_apellido_paterno_avisar"=> strip_tags(trim($request->input('ews_apellido_paterno_avisar'))),
				"ews_apellido_materno_avisar"=> strip_tags(trim($request->input('ews_apellido_materno_avisar'))),
				"ews_direccion_avisar"=> strip_tags(trim($request->input('ews_direccion_avisar'))),
				"ews_telefono_avisar"=> strip_tags(trim($request->input('ews_telefono_avisar'))),
				"ews_agudeza_visual"=> strip_tags(trim($request->input('ews_agudeza_visual'))),
				"ews_lentes"=> strip_tags(trim($request->input('ews_lentes'))),
				"ews_tipo_sangre"=> strip_tags(trim($request->input('ews_tipo_sangre'))),
				"ews_estatura"=> strip_tags(trim($request->input('ews_estatura'))),
				"ews_padecimientos"=> strip_tags(trim($request->input('ews_padecimientos'))),
				"ews_donador"=> strip_tags(trim($request->input('ews_donador'))),
				"ews_vigencia"=> strip_tags(trim($request->input('ews_vigencia'))),
			];

			$data = (object) $data;

			if($token_web == $data->ews_token) {
				if(empty($data->ews_llave) ||
					empty($data->ews_id_tramite) ||
					empty($data->ews_no_solicitud) ||
					empty($data->ews_fecha_solicitud) ||
					empty($data->ews_hora_solicitud) ||
					empty($data->ews_nombre) ||
					empty($data->ews_apellido_paterno) ||
					empty($data->ews_apellido_materno) ||
					empty($data->ews_curp) ||
					empty($data->ews_licencia) ||
					empty($data->ews_edad) ||
					empty($data->ews_lugar_nacimiento) ||
					empty($data->ews_telefono) ||
					empty($data->ews_nombre_avisar) ||
					empty($data->ews_apellido_paterno_avisar) ||
					empty($data->ews_apellido_materno_avisar) ||
					empty($data->ews_direccion_avisar) ||
					empty($data->ews_telefono_avisar) ||
					empty($data->ews_agudeza_visual) ||
					empty($data->ews_lentes) ||
					empty($data->ews_tipo_sangre) ||
					empty($data->ews_estatura) ||
					empty($data->ews_padecimientos) ||
					empty($data->ews_donador) ||
					empty($data->ews_vigencia) ||
				){
					$saveAcceso = new TokenAcceso;
					foreach ($token_web_form as $id_token) {
							$saveAcceso->id_token - $id_token->id_token;
					}

					$saveAcceso->fecha = date ('Y-m-d');
					$saveAcceso->hora = date ('H:i:s');
					$saveAcceso->ip - $request->ip();
					$saveAcceso->dato_clave = $data->ews_licencia;
					$saveAcceso->mensaje = 'Token usado con exito pero con informacion faltante';
					$saveAcceso->codigo = '400';
					$saveAcceso->save();
					return response()->json(array("wsp_mensaje"-> 'Falta informacion'), 400);
				}
			$completo - datoGral::join('dbo.Lic_Licencias', 'Lic_Licencias.Dat_Id', '-', 'Dat_DatosGral.Dat_Id')
					->select('Dat_DatosGral.*', 'Lic_Licencias.*')
					->where('Dat_Nombre', '=', $data->ews_nombre)
					->where('Dat_Paterno', '=', $data->ews_apellido_paterno)
					->where('Dat_Materno', '=', $data->ews_apellido_materno)
					->where('Dat_CURP', '=', $data->ews_curp)
					->where('Lic_Expediente', '=', $data->ews_licencia)
					->where('TipLic_Id', '=', '3')
					->orderby('Lic_Expedicion', 'asc')
					->get();
			$curp - datoGral::join('dbo.Lic_Licencias', 'Lic_Licencias.Dat_Id', '=', 'Dat_DatosGral.Dat_Id')
					->select('Dat_DatosGral.*', 'Lic_Licencias.*')
					->where('Dat_Nombre', '=', $data->ews_nombre)
					->where('Dat_Paterno', '=', $data->ews_apellido_paterno)
					->where('Dat_Materno', '=', $data->ews_apellido_materno)
					->where('Dat_CURP', '=', $data->ews_curp)
					->where('TipLic_Id', '=', '3')
					->orderby('Lic_Expedicion', 'asc')
					->get();
			$expediente - datoGral::join('dbo.Lic_Licencias', 'Lic_Licencias.Dat_Id', '=', 'Dat_DatosGral.Dat_Id')
					->select('Dat_DatosGral.*', 'Lic_Licencias.*')
					->where('Dat_Nombre', '=', $data->ews_nombre)
					->where('Dat_Paterno', '=', $data->ews_apellido_paterno)
					->where('Dat_Materno', '=', $data->ews_apellido_materno)
					->where('Lic_Expediente', '=', $data->ews_licencia)
					->where('TipLic_Id', '=', '3')
					->orderby('Lic_Expedicion', 'asc')
					->get();
			if($curp == '[]'){
				$persona = $expediente;
				if ($persona == '[]'){
					return response()->json(['wsp_mensaje'=>'Ciudadano no encontrado'], 404);
				}
			}elseif ($expediente == '[]') {
				$persona = $curp;
				if ($persona == '[]'){
					return response()->json(['wsp_mensaje'=>'Ciudadano no encontrado'], 404);
				}
			}else{
				$persona = $completo;
				if($persona == '[]'){
					return response()->json(['wsp_mensaje'=>'Ciudadano no encontrado'], 404);
				}
			}
			$client = new Client([ 
				//Nose que va aqui
				'base_url' => 'jsdkhsfksjdkf',
				'timeout' => 2.0,
			]);
			
			}
		}