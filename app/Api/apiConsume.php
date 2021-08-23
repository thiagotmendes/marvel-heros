<?php
namespace App\Api;

use DateTime;

class apiConsume {

  public $timestamp;
  public $md5;
  // Primeira chave criada

  // segunda chave criada
  private $privateKey = '';
  private $publicKey = '';

  private $url = "http://gateway.marvel.com:80/v1/public/";

  public function __construct()
  {
    // captura o timestamp
    $date = new DateTime();
    $this->timestamp = $date->getTimestamp();
  }

  /**
   * Gen and get hash
   *
   * @return false|string
   */
  private function getHash()
  {
    // Add your keys here. It would be better if you include them from an external file in production.
    $keys = $this->privateKey.$this->publicKey;
    // Add the timestamp to the keys
    $string = $this->timestamp.$keys;
    // Generate MD5 digest, also hash is faster than md5 function
    $this->md5 = hash('md5', $string);
    //
    return $this->md5;
  }

  protected function getEndpoint($param, $comicUrl = null)
  {
    /** use cURL to get api data */
    $ch = curl_init();

    $currentUrl = $this->url. $param . "?ts=".$this->timestamp."&apikey=".$this->publicKey."&hash=".$this->getHash()."&limit=5";

    if($comicUrl != null) {
      $currentUrl = $comicUrl;
    }

    // set URL and other appropriate options
    // Query Iron Man by passing value in name parameter
    curl_setopt($ch, CURLOPT_URL, $currentUrl);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json')
    );

    $output = curl_exec($ch) or die(curl_error());

    return $output;
  }

  // uma opção em php
  public function getCharacterList()
  {
    return $this->getEndpoint('characters');
  }

  public function getCharacterSeries($idCharacter)
  {
    return $this->getEndpoint('characters/'.$idCharacter."/series");
  }

  public function getCharacterEvents($idCharacter)
  {
    return $this->getEndpoint('characters/'.$idCharacter."/events");
  }

  public function getCharacterById($idCharacter)
  {
    return $this->getEndpoint('characters/'.$idCharacter);
  }

  public function getComicInfo($urlComic)
  {
    $param = "?ts=".$this->timestamp."&apikey=".$this->publicKey."&hash=".$this->getHash()."&limit=1";
    $comic = $urlComic.$param;
    return $this->getEndpoint(null, $comic);
  }
}
