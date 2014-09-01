<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * 200	OK
*201	Creado
*304	No modificado
*400	Petición incorrecta
*401	No autorizado
*403	Prohibido
*404	No encontrado
*422	Entidad imposible de procesar
*500	Error interno del servidor
*
	 * @return Response
	 */
	public function index()
    {
        $users = User::all();
 
        return Response::json(array(
            'error' => false,
            'users' => $users->toArray()),
            200
        );
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
