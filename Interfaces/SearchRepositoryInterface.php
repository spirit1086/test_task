<?php
namespace App\Interfaces;

use App\Dto\QueryDto;

interface SearchRepositoryInterface
{
   public function getAll(QueryDto $queryDto): array;
}