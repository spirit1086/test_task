<?php
namespace App\Dto;

use App\Traits\SecureParams;

class QueryDto
{
    use SecureParams;

    private string $do;
    private array $attr;
    private string $searchid;
    private string $sql;
    const DO_SHOWRESULTS = 'showresults';
    const DO_PROCESS = 'process';

    public function __construct(array $params)
    {
          $this->searchid = SecureParams::filter($params['searchid']);
          if ($this->searchid) {
              $this->do = self::DO_SHOWRESULTS;
              $this->attr = ['searchid' => $this->searchid];
          } elseif (!empty($params['q'])) {
              $this->do = self::DO_PROCESS;
              $this->attr = ['text' =>  SecureParams::filter($params['q'])];
          }
    }

    /**
     * @return array
     */
    public function getAttr(): array
    {
        return $this->attr;
    }

    /**
     * @return string
     */
    public function getSql(): string
    {
        return $this->sql;
    }

    public function setSql(string $sql)
    {
        $this->sql = $sql;
    }

    /**
     * @return string
     */
    public function getSearchid(): string
    {
        return $this->searchid;
    }

    /**
     * @return string
     */
    public function getDo(): string
    {
        return $this->do;
    }
}