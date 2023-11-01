<?php
namespace App\Repositories;

use App\Dto\QueryDto;
use App\Interfaces\SearchRepositoryInterface;
use Db;

class SearchRepository implements SearchRepositoryInterface
{
   private DB $db;

   public function __construct(DB $db)
   {
       $this->db = $db;
   }

   public function getAll(QueryDto $queryDto): array
   {
       return $this->db->getAll($queryDto->getSql(),$queryDto->getAttr());
   }
}