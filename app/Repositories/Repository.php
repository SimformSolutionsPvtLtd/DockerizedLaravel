<?php

namespace App\Repositories;

use App\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryContract
{

    # model property on class instances
    protected $model;
    protected $per_page_records;

    # Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->per_page_records = $this->model->per_page ? $this->model->per_page : '10';
    }

    # Get the associated model
    public function getList()
    {
        return $this->model::all();
    }

    # Set the associated model
    public function store($data)
    {
        $data = $this->model::create($data);
    }

    #paginate records with model property
    public function paginate($value = null)
    {
        return $this->model->paginate($value ? $value : $this->per_page_records);
    }
}
