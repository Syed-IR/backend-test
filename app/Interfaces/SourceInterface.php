<?php
namespace App\Interfaces;

interface SourceInterface
{
  /**
   * Transform newsapi response for our database.
   *
   * @param  array  $data
   * @return array
   */
  public function newsapi($data);

  /**
   * Transform guardian response for our database.
   *
   * @param  array  $data
   * @return array
   */
  public function guardian($data);

  /**
   * Transform nyt response for our database.
   *
   * @param  array  $data
   * @return array
   */
  public function nyt($data);
}
