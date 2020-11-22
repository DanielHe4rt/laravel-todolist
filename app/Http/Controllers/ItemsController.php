<?php


namespace App\Http\Controllers;


use App\Repositories\ItemRepository;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * @var ItemRepository
     */
    private $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getItems(Request $request)
    {
        $result = $this->repository->getItems();
    }

    public function postItem(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'deadline' => 'required|date',
        ]);
        $result = $this->repository->createItem($request->all());

        return response()->json($result, 201);

    }

    public function getItem(Request $request, int $itemId)
    {
        $request->merge(['item_id' => $itemId]);
        $this->validate($request, [
            'item_id' => 'required|exists:user_items,id'
        ]);

        $result = $this->repository->fetchById($itemId);

        return response()->json($result);
    }

    public function deleteItem(Request $request, int $itemId)
    {
        $request->merge(['item_id' => $itemId]);
        $this->validate($request, [
            'item_id' => 'required|exists:user_items,id'
        ]);
        $this->repository->deleteItem($itemId);

        return response()->json([]);
    }
}
