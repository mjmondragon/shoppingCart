<?php
namespace App\Repositories;

use App\Model\ShoppingCart;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */
interface ShoppingCartRepositoryInterface{

    /**
     * Find Shopping cart by id
     *
     * @param [integer] $id
     * @return ShoppingCart|null
     */
    public function find($id): ?ShoppingCart;

    /**
     * Find shopping cart by session
     *
     * @param [string] $sessionId
     * @return ShoppingCart|null
     */
    public function findBySession($sessionId): ?ShoppingCart;

    /**
     * Persist the shopping cart to database
     *
     * @param [ShoppingCart] $shoppingCart
     * @return boolean
     */
    public function save($shoppingCart):bool;

    /**
     * Delete shopping from database
     *
     * @param [type] $shoppingCart
     * @return void
     */
    public function delete($shoppingCart);
}
