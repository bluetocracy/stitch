<?php
/**************
 * An API for connecting to various 
 * channels and collecting inventory 
 * data...  I guess.
 *
 * @auth Nate Peterson - 2, 2015
 *************/

abstract class DefaultAPI
{
	// Methods to be used and abused
	
	abstract protected function authenticate();
	abstract protected function getInventory();
	abstract protected function postInventory($data);
	abstract protected function rosettaStone(); // conversion table
	// These are here for no reason right now
	// abstract protected function getItem($id, $count);
	// abstract protected function postItem($id, $count);

	// Common methods

	public function returnLocalData()
	{
		// this would be how we do it if there was a conversion table.
		// $rawData = $this->getInventory();
		// try {
		// 	$data = $this->translate($rawData);		
		// } catch (Exception $e) {
		// 	echo "Failed to Retrieve: " . $e;
		// }

		// return $data;
		return $this->getInventory();
	}

	public function updateRemoteData($localData)
	{
		$data = $this->translate($localData, FALSE);
		try {
			$this->postInventory($data);
		} catch (Exception $e) {
			echo "Failed to Post: " . $e;
		}
	}

	public function connectAPI()
	{
		try {
			$token = $this->authenticate();		
		} catch (Exception $e) {
			echo "Connection Failed: " . $e;
			return 0;
		}

		return $token;
	}

	// use the conversion table to translate the data to or from our preferred format.
	private function translate($data, $toLocal = TRUE)
	{
		$template = $this->rosettaStone();

		foreach ($template as $local => $remote) {
			if($toLocal === TRUE) {
				$output[$local] = $data[$remote];
			}

			// This could probably get away with being an else statement
			if($toLocal === FALSE) {
				$output[$remote] = $data[$local];
			}
		}

		return $output;
	}


}

