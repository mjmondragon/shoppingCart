<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\ShoppingCart;

/**
 * @author Mauricio Javier Mondragon R <mauro102189@gmail.com>
 */
class ShoppingCartTest extends TestCase
{
    public function testAddItemNoValidCart()
    {
        $payload = ['name' => 'Product test', 'price' => 1, 'quantity' => 1];
        $response = $this->json('POST', 'cart/0/item', $payload);
        $response->assertStatus(404);
    }

    public function testAddItemRequiresFields()
    {
        $shoppingCart = factory(ShoppingCart::class)->create(['session' => 'test_id']);
        $response = $this->json('POST', 'cart/'.$shoppingCart->id.'/item');
        $response->assertStatus(422);
    }
    public function testAddItem()
    {
        $shoppingCart = factory(ShoppingCart::class)->create(['session' => 'test_id']);

        $payload = ['name' => 'Product test', 'price' => 1, 'quantity' => 1];

        $response = $this->json('POST', 'cart/'.$shoppingCart->id.'/item', $payload);
        var_dump($response->getContent());
        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'title',
                'price',
                'created_at',
                'updated_at',
                'quantity',
            ]);
    }

    public function testAddSameItem()
    {
        $shoppingCart = factory(ShoppingCart::class)->create(['session' => 'test_id']);
        $item = $shoppingCart->addItem('Product test', 1, 1);
        $item->save();
        $payload = ['name' => 'Product test', 'price' => 1, 'quantity' => 2];
        $response = $this->json('POST', 'cart/'.$shoppingCart->id.'/item', $payload);
        $response->assertStatus(200)
            ->assertJson([
                'quantity' => 3,
            ]);
    }
    
    public function testRemoveItem()
    {
        $shoppingCart = factory(ShoppingCart::class)->create(['session' => 'test_id']);
        $item = $shoppingCart->addItem('Product test', 1, 1);
        $item->save();
        $response = $this->json('DELETE', 'cart/'.$shoppingCart->id.'/item/'.$item->id);
        var_dump($response->getContent());
        $response->assertStatus(204);
    }
}
