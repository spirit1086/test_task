<?php
namespace App\Services;

use App\Dto\QueryDto;
use App\Interfaces\SearchRepositoryInterface;
use App\Interfaces\SearchServiceInterface;

class SearchService implements SearchServiceInterface
{
  private SearchRepositoryInterface $searchRepository;

  public function __construct(SearchRepositoryInterface $searchRepository)
  {
     $this->searchRepository = $searchRepository;
  }

  public function items(QueryDto $queryDto): array
  {
      if ($queryDto->getDo() == $queryDto::DO_PROCESS) {
          $queryDto->setSql("SELECT * FROM vb_post WHERE text like :text");
          $this->writeFile($queryDto);
          $result = $this->getData($queryDto);
      } elseif($queryDto->getDo() == $queryDto::DO_SHOWRESULTS) {
          $queryDto->setSql("SELECT * FROM vb_searchresult WHERE searchid = :searchid");
          $result = $this->getData($queryDto);
      } else {
          $result = ['html' => "<h2>Search in forum</h2><form><input name='q'></form>"];
      }
      return $result;
  }

  private function getData(QueryDto $queryDto)
  {
      $result = $this->searchRepository->getAll($queryDto);
      self::render_search_results($result);
      return $result;
  }

  public static function render_search_results($result)
  {
        global $render;
        foreach ($result as $row) {
            if ($row['forumid'] != 5) {
                $render->render_searh_result($row);
            }
        }
  }

  private function writeFile(QueryDto $queryDto)
  {
        $file = fopen('/var/www/search_log.txt', 'a+');
        fwrite($file, $queryDto->getAttr()['text'] . "\n");
  }
}