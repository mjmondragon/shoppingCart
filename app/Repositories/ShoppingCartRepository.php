<?php

namespace App\Repositories;

use App\Model\ShoppingCart;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */
class ShoppingCartRepository implements ShoppingCartRepositoryInterface{

    private static $instance;

    protected function __construct()
    {
        
    }

    protected function __clone()
    {
        
    }

    /**
     * Singleton instance
     *
     * @return ShoppingCartRepository
     */
    public static function getInstance():ShoppingCartRepository
    {
        if(is_null(static::$instance)){
            static::$instance = new ShoppingCartRepository();
        }
        return static::$instance;
    }

    /**
     * @inheritDoc
     */
    public function find($id): ?ShoppingCart
    {
        return ShoppingCart::find($id);
    }

    /**
     * @inheritDoc
     */
    public function findBySession($sessionId): ?ShoppingCart
    {
        return ShoppingCart::where('session', $sessionId)->orderBy('created_at', 'desc')->first();
    }

    /**
     * {@inheritDoc}
     */
    public function save($shoppingCart):bool
    {
        return $shoppingCart->save();
    }

    /**
     * @inheritDoc
     */
    public function delete($shoppingCart)
    {
        return $shoppingCart->delete();
    }

}