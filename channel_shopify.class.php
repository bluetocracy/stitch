<?php
/**************
 * hopefully, this should configure the api 
 * to work for a specific channel.  In this 
 * case, it's Shopify.
 *
 * @auth Nate Peterson - 2, 2015
 **************/
require_once('api_default.class.php');


class Channel_Shopify extends DefaultAPI
{
	// Common methods from DefaultAPI: 
	// - returnLocalData()
	// - updateRemoteData($localData)
	// - connectAPI()

	protected function authenticate()
	{
		// enter proprietary stuff here.
		// $name = 'testApp42';
		// $key  = 'cbd517963ba2b28a0aeddec7971d3c4b';
		$base = 'https://cbd517963ba2b28a0aeddec7971d3c4b:ec74a7d7bc7f8a21bae8bf36171a42d3@fake-dev-shop.myshopify.com/';
		return $base;
	}

	// return the conversion table for local/remote as an array:  
	// $x = array('localName' => 'remoteName', etc.), or
	// $x['localName'] = 'remoteName' 
	protected function rosettaStone()
	{
		$table = array(

			);

		return $table;
	}

	protected function getInventory()
	{
		$url 	  = $this->authenticate() . 'admin/products.json';
		$data 	  = file_get_contents($url);
		$products = json_decode($data);

		return $products;
	}

	protected function postInventory($data)
	{
		// add a product to the inventory - more on this later
		$url = $this->authenticate() . 'admin/products.json';
		try {
			$response = http_put_data($url, $data);
		} catch (Exception $e) {
			echo "Failed: " . $e;
			return 0;
		}
		return $response;
	}

	// Local Methods



}