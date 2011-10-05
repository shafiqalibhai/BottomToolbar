<?

class Emoticon {

	var $filename = 'emoticons.dat';
	var $data = array();

	//Constructor
	function Emoticon($filename='') {
		if ($filename) $this->filename = $filename;
		fclose(fopen($this->filename,'a'));
		$this->load();
	}
	
	//Loads emoticon data from file
	function load($filename='') {
		if ($filename) $this->filename = $filename;
		$this->data = unserialize(implode('',file($this->filename)));
		return true;
	}
	
	//Saves emoticon data to file
	function save($filename='') {
		if ($filename) $this->filename = $filename;
		$f = fopen($this->filename,'w');
		if (!$f) return false;
		fwrite($f,serialize($this->data));
		fclose($f);
		return true;
	}

	//If user with a non-existing trigger, will create it with the respective image url
	//If the trigger already exists, will overwrite it.
	function add($trigger,$url) {
		$this->data[$trigger] = $url;
		$this->save();
	}

	//Delete a trigger
	function delete($trigger) {
		unset($this->data[$trigger]);
		$this->save();
	}
	
	function imagetag($url) {
		return "<img src='$url' />";
	}
	
	//Replaces all found triggers in $text by their respective images
	function apply($text) {
		$images = array_map(array('Emoticon','imagetag'),$this->data);
		return strtr($text,$images);
	}
}
?>
