<?php

namespace App\Interfaces;

interface ItemInterface
{
    //
    public function getItems();
    public function getItem($id);
    public function createItem($data);
    public function updateItem($id, $data);
    public function deleteItem($id);
}
