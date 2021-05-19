<?php


namespace App\Services;


interface BaseServiceInterface
{

    public function getAll();

    public function search();

    public function getOne($id);

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

}
