<?php
 /**
 *  google translate Controller
 *
 * This class handles google translate management related functionality
 *
 * @package		Admin
 * @subpackage	google translate
 *  		 
 *  
 */

class GoogleTranslate {
public $lastResult = "";
private $langFrom;
private $langTo;
private static $urlFormat = "http://translate.google.com/translate_a/t?client=t&text=%s&hl=en&sl=%s&tl=%s&ie=UTF-8&oe=UTF-8&multires=1&otf=1&pc=1&trs=1&ssel=3&tsel=6&sc=1";
 
public function __construct($from = "en", $to = "ka") {
$this->setLangFrom($from)->setLangTo($to);
}
 
public function setLangFrom($lang) {
$this->langFrom = $lang;
return $this;
}
 
public function setLangTo($lang) {
$this->langTo = $lang;
return $this;
}
 
public static final function makeCurl($url, array $params = array(), $cookieSet = false) {
	if (!$cookieSet) {
		$cookie = tempnam("/tmp", "CURLCOOKIE");
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_exec($curl);
	}
	$queryString = http_build_query($params);
	 
	$curl = curl_init($url . "?" . $queryString);
	curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($curl);
	return $output;
}
 
public function translate($string) {
	$url = sprintf(self::$urlFormat, rawurlencode($string), $this->langFrom, $this->langTo);
	$result = preg_replace('!,+!', ',', self::makeCurl($url)); // remove repeated commas (causing JSON syntax error)
	$resultArray = json_decode($result, true);
	return $this->lastResult = $resultArray[0][0][0];
}
 
public static function staticTranslate($string, $from, $to) {
	$url = sprintf(self::$urlFormat, rawurlencode($string), $from, $to);
	$result = preg_replace('!,+!', ',', self::makeCurl($url)); // remove repeated commas (causing JSON syntax error)
	$resultArray = json_decode($result, true);
	return $resultArray[0][0][0];
}

public function get_translated_data_array($base_lang,$target_lang,$data) {
	
	$result_array = array();

	$this->setLangFrom($base_lang)->setLangTo($target_lang);	
	
	foreach ($data as $key => $value) {
		$result_array[$key]=$this->translate($value);
	}

	return $result_array;
}

function test()
{
	$this->setLangFrom($base_lang)->setLangTo($target_lang);
echo $this->translate($value);
}
 
}
 
?>