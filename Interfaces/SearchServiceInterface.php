<?php


namespace App\Interfaces;


use App\Dto\QueryDto;

interface SearchServiceInterface
{
  public function items(QueryDto $queryDto): array;
}