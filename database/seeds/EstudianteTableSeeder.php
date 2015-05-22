<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EstudianteTableSeeder extends Seeder {

    public function run()
    {
        DB::table('estudiantes')->delete();

        DB::table('estudiantes')->insert(
        	array(
        		[
        			'nombre'=>'juan',
        			'email'=>'pedro@pedro.com',
        			'cedula'=>'111221',
        			'telefono'=>'1233',
        		],
        		[
        			'nombre'=>'maria',
        			'email'=>'maria@maria.com',
        			'cedula'=>'222',
        			'telefono'=>'12333333',
        		],
        		));
    }

}