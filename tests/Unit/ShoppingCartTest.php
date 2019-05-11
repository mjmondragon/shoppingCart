<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Model\ShoppingCart;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */
class ShoppingCartTest extends TestCase
{
    public function testAddItem()
    {
        $shoppingCart = factory(ShoppingCart::class)->create(['session' => 'test_id']);
        $item = $shoppingCart->addItem('Test product', 1, 1);
        $this->assertEquals($item->title, 'Test product');
    } 
}

