<?php

namespace App\Services;

use App\Repository\ItemRepository;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ItemService
{
    /**
     * Create a new class instance.
     */

    private $itemRepository;

    public function __construct(ItemRepository $itemRepo)
    {
        $this->itemRepository = $itemRepo;
    }

    public function getAll()
    {
        try {
            // Validation passed, proceed with fetching data
            $getItems = $this->itemRepository->getItems();

            return response()->json([
                'success' => true,
                'data' => $getItems,
                'server_response' => 'ok'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'server_response' => 'error',
                'line_error' => $e->getLine(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getItem(Request $request) : JsonResponse
    {
        try {

            $validator = Validator::make($request->all(),[
                'id' =>'required'
            ]);

            if ($validator->fails()) {
                // Validation failed, handle errors here
                return response()->json(['error' => 'Validation failed'], 422); // Example error response
            }

            // Validation passed, proceed with fetching data
            $getId = $this->itemRepository->getItem($validator['id']);

            return response()->json([
                'success' => true,
                'data' => $getId,
                'server_response' => 'ok'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'server_response' => 'error',
                'line_error' => $e->getLine(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function createItem(Request $request) : JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' =>'required',
                'description' =>'required',
                'is_enabled' =>'required'
            ]);


            if ($validator->fails()) {
                // Validation failed, handle errors here
                return response()->json(['error' => 'Validation failed'], 422); // Example error response
            }

            $itemValidated = $validator->validated();

            $items = [
                'name' => $itemValidated['name'],
                'description' => $itemValidated['description'],
                'is_enabled' => $itemValidated['is_enabled']
            ];

            $insertItem = $this->itemRepository->createItem($items);

            return response()->json([
                'success' => true,
                'data' => $insertItem,
                'server_response' => 'ok'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'server_response' => 'error',
                'line_error' => $e->getLine(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function itemUpdate(Request $request) : JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);

            if ($validator->fails()) {
                // Validation failed, handle errors here
                return response()->json(['error' => 'Validation failed'], 422); // Example error response
            }

            $itemValidated = $validator->validated();

            $data = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'is_enabled' => $request->get('is_enabled')
            ];

            $updateItem = $this->itemRepository->updateItem($itemValidated['id'], $data);

            return response()->json([
                'success' => true,
                'server_response' => 'ok'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'server_response' => 'error',
                'line_error' => $e->getLine(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function itemDelete(Request $request) : JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);

            if ($validator->fails()) {
                // Validation failed, handle errors here
                return response()->json(['error' => 'Validation failed'], 422); // Example error response
            }

            $itemValidated = $validator->validated();

            $deleteItem = $this->itemRepository->deleteItem($itemValidated['id']);

            return response()->json([
               'success' => true,
                'data' => $deleteItem['id'],
               'server_response' => 'ok'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'server_response' => 'error',
                'line_error' => $e->getLine(),
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
