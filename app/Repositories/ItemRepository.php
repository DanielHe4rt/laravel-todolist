<?php


namespace App\Repositories;


use App\Models\Item;

class ItemRepository
{

    /**
     * @var Item
     */
    private $model;

    public function __construct()
    {
        $this->model = new Item();
    }

    public function getItems()
    {
        return $this->model->paginate(15);
    }

    public function createItem(array $data)
    {
        return $this->model->create($data);
    }

    public function fetchById(int $id)
    {
        return $this->model->find($id);
    }

    public function deleteItem(int $id)
    {
        return $this->model->find($id)->delete();
    }
}
