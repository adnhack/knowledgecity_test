<?php

/*
* Class Students
* Description: Get all the students data
* @author Aaron Aceves
*/

class Students
{

  const LIMIT = 5;
  public $dbconnection;

  public function __construct(Database $db)
  {
    $this->dbconnection = $db->getConnection();
  }

  /*
  * Description: Return 1 record based on the UID
  * @visibility public
  * @param int $uid
  * @return array $result
  */
  public function getOne(int $uid) :array
  {
    //.. Get one student only
    return [];
  }

  /*
  * Description: Return all the students records
  * @visibility public
  * @param void
  * @return array $result
  */
  public function getAll() :array
  {
    //.. Get all students
    return [];
  }

  /*
  * Description: Search and return all the students in the range between the limit and offset
  * @visibility public
  * @param int $start
  * @return array $result
  */
  public function getRange(int $start) :array
  {
    $sql = $this->dbconnection->prepare("SELECT fname, lname, usergroup, email FROM students LIMIT :limit OFFSET :offset");
    $sql->bindValue(':limit', self::LIMIT, PDO::PARAM_INT);
    $sql->bindValue(':offset', (int) $start, PDO::PARAM_INT);
    $sql->execute();

    return $sql->fetchAll(PDO::FETCH_ASSOC);

  }

  /*
  * Description: Obtain all students total quantity
  * @visibility public
  * @param void
  * @return array $result
  */
  public function getStudentCount() :array
  {
    $sql = $this->dbconnection->prepare("SELECT count(*) as total FROM students");
    $sql->execute();
    return $sql->fetch(PDO::FETCH_ASSOC);
  }

}
