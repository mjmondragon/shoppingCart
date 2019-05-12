<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repositories\ShoppingCartRepositoryInterface;
use App\Model\ShoppingCart;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */
class ShoppingCartController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }

    public function get(Request $request, ShoppingCartRepositoryInterface $repository)
    {
        $session = $request->session()->getId();
        $shoppingCart = $repository->findBySession($session);
        if(is_null($shoppingCart)){
            $shoppingCart = new ShoppingCart(['session' => $session]);
            $repository->save($shoppingCart);
        }
        return $shoppingCart->load('items');
    }

    public function addItem(Request $request, $cartId, ShoppingCartRepositoryInterface $repository)
    {
        $this->validateItem($request);
        $shoppingCart = $repository->find($cartId);
        abort_if(is_null($shoppingCart), 404);
        $item = $shoppingCart->findItemByTitle($request->name);
        $item = $shoppingCart->addItem($request->name, $request->price * 100, $request->quantity);
        $item->save();
        return new JsonResponse($item, 200);
    }

    public function removeItem(Request $request, $cartId, $itemId, ShoppingCartRepositoryInterface $repository)
    {
        $shoppingCart = $repository->find($cartId);
        abort_if(\is_null($shoppingCart), 404);
        $item = $shoppingCart->findItem($itemId);
        if(!is_null($item)){
            $item->delete();
        }
        return new JsonResponse(null, 204);
    }

    /**
     * Validate the inputs sent in the request
     *
     * @param Request $request
     * @return void
     */
    private function validateItem(Request $request)
    {
        $this->validate($request, $this->itemRules());
    }

    /**
     * Validation rules for cart item
     *
     * @return string[]
     */
    private function itemRules()
    {
        return ['name' => 'string|required', 'price' => 'numeric|required', 'quantity' => 'numeric|required'];
    }
}
