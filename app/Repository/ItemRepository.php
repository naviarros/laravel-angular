<?php

namespace App\Repository;

use App\Models\Item;
use App\Interfaces\ItemInterface;

class ItemRepository implements ItemInterface
{
    /**
     * Create a new class instance.
     */

    private $items;

    public function __construct(Item $item)
    {
        //
        $this->items = $item;
    }

    public function getItems()
    {
        return $this->items->all();
    }

    public function getItem($id)
    {
        return $this->items->find($id);
    }

    public function createItem($data)
    {
        return $this->items->create($data);
    }

    public function updateItem($id, $data)
    {
        return $this->items->where("id", $id)->update($data);
    }

    public function deleteItem($id)
    {
        return $this->items->where("id", $id)->delete();
    }
}
