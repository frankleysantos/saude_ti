<?php namespace App\Repositories\Contracts;

interface RepositoryInterface{
	
	public function getAll();

	public function getEntity($key, $codigo);

	public function store($request);

	public function update($key, $codigo, $request);

	public function delete($key, $id);
}