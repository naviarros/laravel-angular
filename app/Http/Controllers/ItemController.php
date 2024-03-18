<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ItemService;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index()
    {
        return $this->itemService->getAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return $this->itemService->createItem($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        return $this->itemService->getItem($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->itemService->itemUpdate($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->itemService->itemDelete($request);
    }
}
