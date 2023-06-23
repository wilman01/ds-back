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

    public function all(){
        return $this->model->paginate();
    }

    public function get(int $id)
    {
        $query = $this->model;
        if(!empty($this->relations)){
            $query = $query->with($this->relations);
        }
        return $query->find($id);
    }

    public function save(Model $model)
    {
        $model->save();
        return $model;
    }
}