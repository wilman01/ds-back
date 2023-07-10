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

    public function all($where = []){
         $query = $this->model;

        if(!empty($this->relations)){
            $query = $query->with($this->relations);
        }

        return $query->where($where)
                ->paginate(10);
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