<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */
class ProductController extends Controller
{
    public function all(Request $request)
    {
        // ######## please do not alter the following code ########
        $products = [
            [ "name" => "Sledgehammer", "price" => 125.75 ],
            [ "name" => "Axe", "price" => 190.50 ],
            [ "name" => "Bandsaw", "price" => 562.131 ],
            [ "name" => "Chisel", "price" => 12.9 ],
            [ "name" => "Hacksaw", "price" => 18.45 ],
            ];
            // ########################################################
        return $products;
    }
}
