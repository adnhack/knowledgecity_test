<?php

/*
* Class: Format
* @description: Gives format to the given data
* @author Aaron Aceves
*/
class Format
{

  public $students;

  public function __construct(Students $students) {
    $this->students = $students;
  }

  /*
  * Description: Create a Json format based on the given data
  * @visibility public
  * @param int $initial
  * @return string json $result
  */
  public function createJson(int $initial) :string
  {
    $result['data'] = $this->students->getRange($initial);
    $result['counter'] = $this->getCounter();
    return json_encode($result);
  }

  /*
  * Description: Calculate the total records on the DB
  * @visibility public
  * @param void
  * @return int $result
  */
  public function getCounter() :int
  {
    $result = $this->students->getStudentCount();
    return $result['total'];
  }

  /*
  * Description: Create a html format based on the given data
  * @visibility public
  * @param int $initial
  * Not used at this moment
  * @return string json $result
  */
  public function createHTML(int $initial) :sring
  {
    //.. Create HTML content. Not needed, just in case
  }

  /*
  * Description: Create a text format based on the given data
  * @visibility public
  * Not used at this moment
  * @param int $initial
  * @return string json $result
  */
  public function createText(int $initial) :string
  {
    //.. Create TEXT content. Not needed, just in case
  }

}
