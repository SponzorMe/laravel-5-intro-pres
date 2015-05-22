<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Validator;
class EstudianteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$estudiantes=Estudiante::get();
		return response()->json([
			"estudiantes"=>$estudiantes,
			"mensaje"=>"ahi van todos los estudiantes",
			],200
		);
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$estudiante=Estudiante::find($id);
		if(!$estudiante){//Si no se encontro el estudiante entonces error
			return response()->json([
				"mensaje"=>"Estudiante no encontrado",
			],404
		);
		}
		else{
			return response()->json([
				"estudiante"=>$estudiante,
				"mensaje"=>"ahi va el estudiante",
				],200
			);
		}		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$validation = Validator::make($request->all(),[
			'nombre'=>"required|max:255",
			'email'=>"required|email|max:255",
			'cedula'=>"required|max:15",
			'telefono'=>"required|max:20",
		]);
		if($validation->fails()){
			return response()->json([
				"mensaje"=>"No se pudo procesar",
				"error"=>$validation->messages(),
				],422
			);
		}
		else{
			$estudiante=Estudiante::create($request->all());
			return response()->json([
				"estudiante"=>$estudiante,
				"mensaje"=>"Listo el estudiante!!!",
				],201
			);
		}

	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$estudiante=Estudiante::find($id);
		if(!$estudiante){
			return response()->json([
				"mensaje"=>"Estudiante no encontrado",
				],404
			);
		}
		$nombre=$request->input('nombre');
		$telefono=$request->input('telefono');
		$email=$request->input('email');
		$cedula=$request->input('cedula');
		if($request->method()==="PATCH"){
			$warnings=array();
			$flag=0;
			if(!empty($nombre)){
				$validator=Validator::make(
					['nombre'=>$nombre],
					['nombre'=>['required','max:255']]
				);
				if(!$validator->fails()){
					$flag=1;
					$estudiante->nombre=$nombre;
				}
				else{
					$warnings[]=$validator->messages();
				}
			}
			if(!empty($cedula)){
				$validator=Validator::make(
					['cedula'=>$cedula],
					['cedula'=>['required','max:11','unique:estudiantes,cedula,'.$id]]
				);
				if(!$validator->fails()){
					$flag=1;
					$estudiante->cedula=$cedula;
				}
				else{
					$warnings[]=$validator->messages();
				}
			}			
			if(!empty($telefono)){
				$validator=Validator::make(
					['telefono'=>$telefono],
					['telefono'=>['required','max:20']]
				);
				if(!$validator->fails()){
					$flag=1;
					$estudiante->telefono=$telefono;
				}
				else{
					$warnings[]=$validator->messages();
				}
			}
			if(!empty($email)){
				$validator=Validator::make(
					['email'=>$email],
					['email'=>['required','max:255',"unique:estudiantes,email,".$id,]]
				);
				if(!$validator->fails()){
					$flag=1;
					$estudiante->email=$email;
				}
				else{
					$warnings[]=$validator->messages();
				}
			}
			if($flag){
				$estudiante->save();
				return response()->json([
					"estudiante"=>$estudiante,
					"warnings"=>$warnings,
					"mensaje"=>"Listo el estudiante!!!",
					],200
				);
			}
			else{
				return response()->json([
					"estudiante"=>$estudiante,
					"warnings"=>$warnings,
					"mensaje"=>"Nada actualizado",
					],200
				);
			}

		}
		elseif($request->method()==="PUT"){
				$validation = Validator::make($request->all(),[
				'nombre'=>"required|max:255",
				'email'=>"required|email|max:255|unique:estudiantes,email,".$id,
				'cedula'=>"required|max:15|unique:estudiantes,cedula,".$id,
				'telefono'=>"required|max:20",
			]);
			if($validation->fails()){
				return response()->json([
					"mensaje"=>"No se pudo procesar",
					"error"=>$validation->messages(),
					],422
				);
			}
			else{
				$estudiante->nombre=$nombre;
				$estudiante->telefono=$telefono;
				$estudiante->email=$email;
				$estudiante->cedula=$cedula;
				$estudiante->save();
				return response()->json([
					"estudiante"=>$estudiante,
					"mensaje"=>"Listo el estudiante!!!",
					],200
				);
			}
		}
		else{
			return "Metodo no permitido";
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$estudiante=Estudiante::find($id);
		if(!$estudiante){
			return response()->json([
				"mensaje"=>"Estudiante no encontrado",
				],404
			);
		}
		else{
			$estudiante->delete();
			return response()->json([
				"mensaje"=>"Estudiante borrado",
				],200
			);
		}
	}

}
