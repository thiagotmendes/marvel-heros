<?php
namespace App\Api;

use App\Api\apiConsume;
use mysql_xdevapi\Exception;

class renderCharacterBlocks extends apiConsume
{
  public $gridBlock;

  /**
   * Render a grid block
   */
  public function renderGridList()
  {

    $apiList = json_decode($this->getCharacterList());

    foreach ($apiList->data->results as $results) {
      $thumbnail = $results->thumbnail->path.".".$results->thumbnail->extension;
      /** @var  $gridBlock used to render the grid block */
      $this->gridBlock = '<div id="" class="main-section__grid main-section__grid__box" data-characterid="'.$results->id.'">';
      $this->gridBlock .= '<div class="main-section__grid__collum">';
      $this->gridBlock .= '<div class="main-section__grid__picture">';
      $this->gridBlock .= '<img src="'.$thumbnail.'" alt="" class="img-responsive">';
      $this->gridBlock .= '</div>';
      $this->gridBlock .= '<h2 class="">';
      $this->gridBlock .= $results->id."<br>";
      $this->gridBlock .= $results->name;
      $this->gridBlock .= '</h2>';
      $this->gridBlock .= '</div>';
      $this->gridBlock .= '<div class="main-section__grid__collum">';
      $this->gridBlock .= '<div class="main-section__grid__collum--series">';
      $this->renderSeriesList($results->id);
      $this->gridBlock .= '</div>';
      $this->gridBlock .= '</div>';
      $this->gridBlock .= '<div class="main-section__grid__collum">';
      $this->gridBlock .= '<div class="main-section__grid__collum--series">';
      $this->renderEventsList($results->id);
      $this->gridBlock .= '</div>';
      $this->gridBlock .= '</div>';
      $this->gridBlock .= '</div>';

      echo $this->gridBlock;
    }
  }

  /**
   * Get series list
   *
   * @param $idCharacter
   */
  protected function renderSeriesList($idCharacter)
  {
    $listSeries = json_decode($this->getCharacterSeries($idCharacter));

    foreach ($listSeries->data->results as $series) {
      $this->gridBlock .= $series->title."<br>";
    }
  }

  /**
   * Get event list
   *
   * @param $idCharacter
   */
  protected function renderEventsList($idCharacter)
  {
    $listSeries = json_decode($this->getCharacterEvents($idCharacter));

    foreach ($listSeries->data->results as $series) {
      $this->gridBlock .= $series->title."<br>";
    }
  }

  /**
   * Render infos about the character
   *
   * @param $idCharacter
   */
  public function renderCharacterContent($idCharacter)
  {
    $caracterInfo = json_decode($this->getCharacterById($idCharacter));
    foreach ($caracterInfo->data->results as $character) {
      $thumbnail = $character->thumbnail->path.".".$character->thumbnail->extension;
    ?>
      <div class="main-section__character-bio">
        <div class="main-section__character-bio main-section__character-bio--description">
          <div class="">
            <img src="<?= $thumbnail ?>" alt="" class="img-responsive">
          </div>
          <div class="">
            <header class="main-section__header-character">
              <h1 class=""><?= $character->name ?></h1>
              <button href="" id="close" class="">< Voltar</button>
            </header>

            <div class="">
              <div class="main-section__character-bio--description--about">
                <?= $character->description ?>
              </div>
              <div class="">
                <div class="">
                  <h2>Histórias em quadrinhos</h2>
                  <?php $this->getCharacterComics($character->comics) ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
  }

  protected function getCharacterComics($urlComic)
  {
      foreach ($urlComic->items as $comic) {
        echo "<h6>".$comic->name."</h6>";
      }
  }
}