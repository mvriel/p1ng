<?php

class P1ngIssueTable extends Doctrine_Table
{

  /**
   * Returns a (Zend) Lucene index object
   *
   * @return Zend_Search_Lucene_Interface
   */
  static public function getLuceneIndex()
  {
    ProjectConfiguration::registerZend();

    $index = self::getLuceneIndexFilename();
    if (file_exists($index))
    {
      return Zend_Search_Lucene::open($index);
    }

    return Zend_Search_Lucene::create($index);
  }

  /**
   * Returns the path to the Lucene index file.
   *
   * @return string
   */
  static public function getLuceneIndexFilename()
  {
    return sfConfig::get('sf_data_dir') . '/lucene/issue.' . sfConfig::get('sf_environment') . '.index';
  }

  /**
   * Finds all issues related to the given Lucene query.
   *
   * @param string $query
   *
   * @return array|Doctrine_Collection
   */
  public function getForLuceneQuery($query)
  {
    $hits = self::getLuceneIndex()->find($query);

    $pks = array();
    foreach ($hits as $hit)
    {
      $pks[] = $hit->pk;
    }

    if (empty($pks))
    {
      return array();
    }

    $q = $this->createQuery('i')
      ->whereIn('i.id', $pks)
      ->limit(20);

    return $q->execute();
  }
}
