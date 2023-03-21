<?php

namespace App\Contracts;

interface RepositoryContract
{
    public function paginate($value);

    public function getList();

    public function store($data);
}
