<?php

namespace App\Services;

class UrlBuilderService
{
  /**
   * @var array
   */
  private $newsSource;

  /**
   * @var string
   */
  private $baseUrl;

  /**
   * @var string
   */
  private $query;

  /**
   * @var string
   */
  private $from;

  /**
   * @var string
   */
  private $to;

  /**
   * @var bool
   */
  private $hasPagination = false;

  /**
   * @var string
   */
  private $pageSize;

  /**
   * @var string
   */
  private $apiKey;

  /**
   * @var string
   */
  private $uniqueParams;

  public function __construct($newsSource)
  {
    $this->newsSource     = $newsSource;
    $this->baseUrl        = $newsSource["url"];
    $this->hasPagination  = $newsSource["has_pagination"];
    $this->pageSize       = $newsSource["has_pagination"] ? $newsSource["pageSize"] : null;
    $this->apiKey         = $newsSource["api_key"];
    $this->uniqueParams   = $newsSource["unique_params"];
  }

  /**
   * Set query
   * @param string
   * @return self 
   */
  public function setQuery($query): self
  {
    $this->query = $query;
    return $this;
  }

  /**
   * Set from
   * @param string
   * @return self 
   */
  public function setFrom($from): self
  {
    $this->from = $from;
    return $this;
  }

  /**
   * Set to
   * @param string
   * @return self 
   */
  public function setTo($to): self
  {
    $this->to = $to;
    return $this;
  }

  /**
   * 
   */
  public function build()
  {
    $url = "{$this->baseUrl}?";

    if ($this->query)
      $url .= "q={$this->query}&";

    if ($this->from)
      $url .= "{$this->newsSource["param_name"]["from"]}={$this->from}&";

    if ($this->to)
      $url .= "{$this->newsSource["param_name"]["to"]}={$this->to}&";

    if ($this->hasPagination)
      $url .= "{$this->newsSource["param_name"]["pageSize"]}={$this->pageSize}&";

    if ($this->uniqueParams)
      $url .= $this->uniqueParams;

    if ($this->apiKey)
      $url .= "{$this->newsSource["param_name"]["api_key"]}={$this->apiKey}";

    return $url;
  }
}
