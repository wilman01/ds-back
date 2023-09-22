<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;
    private $relations;
    private $page;

    public function __construct(Model $model, array $relations=[])
    {
        $this->model = $model;
        $this->relations = $relations;
    }

    public function all($where = '', $size=''){
        $query = $this->model;

        $size = is_numeric($size) ? $size : 10;

        if(!empty($this->relations)){
            $query = $query->with($this->relations);
        }
        return $query->Busqueda($where)
                ->orderBy('id', 'desc')
                ->paginate($size);
    }

    public function get($id)
    {
        $query = $this->model;
        if(!empty($this->relations)){
            $query = $query->with($this->relations);
        }
        return $query->findOrFail($id);
    }

    public function save(Model $model)
    {
        $model->save();
        return $model;
    }
}
