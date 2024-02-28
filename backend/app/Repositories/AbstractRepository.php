<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements IEntityRepository
{
    /**
     * @var Model
     */
    protected $model;


    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    public function findByCriteria($criteria)
    {
        $result = $this->model->where($criteria)->first();
        return $result;
    }

    public function findByKey($key, $value)
    {
        $result = $this->model->where($key, $value)->first();
        return $result;
    }

    public function findByKeyOrderBy($key, $value, $orderKey, $orderValue)
    {
        $result = $this->model->where($key, $value)->orderBy($orderKey, $orderValue)->first();
        return $result;
    }

    public function findAllByKey($key, $value)
    {
        $result = $this->model->where($key, $value)->get();
        if($result) {
            return $result;
        }
        return false;
    }

    public function findAllByCriteria(array $criteria, $order = 'created_at', $direction = 'desc')
    {
        $result = $this->model->where($criteria)->orderBy($order, $direction)->get();
        if($result) {
            return $result;
        }
        return false;
    }

    public function store($data,$key = 'id')
    {
        $id = isset($data[$key]) ? $data[$key] : null;
        $this->applyCast($data);
        if($this->model->validate($data)) {
            return $this->model->updateOrCreate(
                [$key => $id],
                $data
            );
        }
        return false;
    }

    public function save($data) : Model
    {
        $this->applyCast($data);
        if($this->model->validate($data)) {
            $this->model->save();
            return $this->model;
        }
        return false;
    }

    public function update($id, $data)
    {
        $data['updated_at'] = Carbon::now();
        $this->applyCast($data);
        if($this->model->validate($data)) {
            if(!$this->model->where('id', $id)->update($data)) {
                return false;
            }
        }
        return true;
    }

    public function delete($id) : bool
    {
        $result = $this->model->where('id', $id)->delete();
        if($result) {
            return true;
        }
        return false;
    }



    private function applyCast(&$data)
    {
        $newData = $this->model->fill($data);
        $data = $newData->toArray();
    }

}