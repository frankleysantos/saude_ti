<?php namespace App\Repositories\Core;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\NotEntityDefined;


class BaseEloquentRepository implements RepositoryInterface
{
    protected $entity;
    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }
	public function getAll()
	{
		return $this->entity->all();
	}

	public function getEntity($key_codigo, $codigo)
	{
		return $this->entity->where("{$key_codigo}", $codigo)->first();
	}

	public function with($array)
	{
		return $this->entity->with($array);
	}

	public function store($request)
	{
		return $this->entity->create($request);
	}


	public function update($key_codigo, $codigo, $request)
	{
		return $this->entity->where("{$key_codigo}", $codigo)->update($request->all());
	}

	public function delete($key_codigo, $codigo)
	{
		return $this->entity->where("{$key_codigo}", $codigo)->delete();
	}

    public function resolveEntity(){
        if(!method_exists($this, 'entity')){
            throw new NotEntityDefined();
        }
        return app($this->entity());
    }

}