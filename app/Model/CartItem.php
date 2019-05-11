<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 * @property string $title
 * @property int $quantity
 * @property int $price
 * @property ShoppingCart $shoppingCart
 */
class CartItem extends Model{

    protected $fillable = ['title', 'quantity', 'price'];

    /**
     *
     * @return BelongsTo
     */
    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }

    /**
     * Set shopping cart
     *
     * @param ShoppingCart $shoppingCart
     * @return $this
     */
    public function setShoppingCart($shoppingCart)
    {
        return $this->shoppingCart()->associate($shoppingCart);
    }
    
    /**
     * Define scope to query
     *
     * @param [mixed] $query
     * @param [string] $title
     * @return void
     */
    public function scopeFindByTitle($query, $title)
    {
        return $query->where('title', $title);
    }
}