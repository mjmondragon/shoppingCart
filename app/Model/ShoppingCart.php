<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */
class ShoppingCart extends Model{

    protected $fillable = ['session'];

    /**
     *
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get item on the cart
     *
     * @param integer $id
     * @return CartItem|null
     */
    public function findItem($id)
    {
        return $this->items()->find($id);
    }

    public function findItemByTitle($title)
    {
        return $this->items()->findByTitle($title)->first();
    }

    /**
     *
     * @param [string] $title
     * @param [integer] $price
     * @param [integer] $quantity
     * @return CartItem
     */
    public function addItem($title, $price, $quantity)
    {
        $item = $this->findItemByTitle($title);
        if(is_null($item)){
            $item = new CartItem(['title' => $title, 'price' => $price, 'quantity' => $quantity]);
            $item = $item->setShoppingCart($this);
        }else{
            $item->quantity += $quantity;
        }
        return $item;
    }
}