<?php

// MODEL

class Product {
    private $price;
    private $weight;
    private $freeShipping = false;
    
    public function __construct($price, $weight) {
        $this->weight = $weight;
        $this->price = $price;
                
    }
    
    function getWeight(){
        return $this->weight;
    }
    
    function setFreeShipping() {
        $this->freeShipping = true;
    }
    
    function getFreeShipping() {
        return $this->freeShipping;
    }
    
}

class Shipping {
    private $totalShipping;
    private $products;
    private $pricePerKilogram;
    private $shippingProvider;


    public function __construct($pricePerKilogram, $shippingProvider) {
        $this->pricePerKilogram = $pricePerKilogram;
    }
    
    public function addProducts(Product $product) {
        $this->products[] = $product;
    }
    public function calculateTotalShipping() {
        /*
         * ShippingProvider
         * 
         */
        foreach ($this->products as $product) {
            if(!$product->getFreeShipping()){
                $this->totalShipping += $product->getWeight() * $this->pricePerKilogram;
            }

        }
    }
    
    
    
    public function getTotalShippingPrice() {
        return $this->totalShipping;
    }
    
}



// CONTROLLER


$product = new Product(5, 1);
$product3->setFreeShipping();

$pricePerKilogram = 5;

$shipping = new Shipping($pricePerKilogram);

$shipping->addProducts($product);
$shipping->calculateTotalShipping();
$totalShippingPrice = $shipping->getTotalShippingPrice();

var_dump($totalShippingPrice);




/*
// MODEL

// include functions.php
function calculateShipping($productWeight, $pricePerKilogram, $hasFreeShipping,$hasFreeShipping, $shippingProvider = '', $shippingProvider = '', $shippingProvider = '') {
    //if()......
    if(!$hasFreeShipping){
        return $productWeight * $pricePerKilogram;
    }
}







// CONTROLLER

//$products = $_SESSION['products'];
$products[1]['weight'] = 1;
$products[1]['price'] = 6;
$products[1]['freeShipping'] = true;

$products[2]['weight'] = 2;
$products[2]['price'] = 3;
$products[2]['freeShipping'] = false;

$pricePerKilogram = 5;

$totalShippingPrice = 0;
foreach($products as $product){
    $totalShippingPrice = calculateShipping($product['weight'], $pricePerKilogram, 1, $product['freeShipping'], $shippingProvider);
}


echo $totalShippingPrice;



// RECEIPT CONTROLLER

    $totalShippingPrice = calculateShipping($product['weight'], $pricePerKilogram, $product['freeShipping'], $shippingProvider);
    
    
 //PDF 
    $totalShippingPrice = calculateShipping($product['weight'], $pricePerKilogram, $product['freeShipping'], $shippingProvider);
    
    
//$products = $_SESSION['products'];
$products[1]['weight'] = 1;
$products[1]['price'] = 6;
$products[1]['freeShipping'] = true;

$products[2]['weight'] = 2;
$products[2]['price'] = 3;
$products[2]['freeShipping'] = false;

    
 //email 
    $totalShippingPrice = calculateShipping($product['weight'], $pricePerKilogram, $product['freeShipping'], $shippingProvider);
 * 
 */