<?php
require_once("cms.php");

class Article
{
  public $id = null;
  public $created = null;
  public $title = null;
  public $content = null;

  public function __construct($data = array()) {
    if (isset($data['id']))
        $this->id = (int) $data['id'];
    if (isset($data['created']))
        $this->created = (int) $data['created'];
    if (isset($data['title']))
        $this->title = preg_replace ("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title']);
    if (isset($data['content']))
        $this->content = htmlspecialchars($data['content']);
  }

  public function storeFormValues ($params) {

    $this->__construct($params);

    // Parse and store the publication date
    if (isset($params['created'])) {
      $created = explode ('-', $params['created']);

      if (count($created) == 3) {
        list ($y, $m, $d) = $created;
        $this->created = mktime (0, 0, 0, $m, $d, $y);
      }
    }
  }

  public static function getById($id) {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT *, UNIX_TIMESTAMP(created) AS created FROM articles WHERE id = :id";
    $st = $conn->prepare($sql);
    $st->bindValue(":id", $id, PDO::PARAM_INT);
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ($row) return new Article($row);
  }

  public static function getList($numrows=1000) {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT *, extract(epoch FROM created) AS created FROM articles
            ORDER BY created DESC";

    $st = $conn->prepare($sql);
    $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
    $st->execute();
    $list = array();

    while ($row = $st->fetch()) 
    {
      $article = new Article($row);
      $list[] = $article;
    }

    $sql = "SELECT COUNT(*) AS totalRows FROM articles";
    $totalRows = $conn->query($sql)->fetch();
    $conn = null;
    return (array ("results" => $list, "totalRows" => $totalRows[0]));
  }

  public function insert() {
    if (!is_null($this->id)) 
        trigger_error ("Article::insert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR);

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "INSERT INTO articles (created, title, content) VALUES (TO_TIMESTAMP(:created), :title, :content)";
    $st = $conn->prepare ($sql);
    $st->bindValue(":created", $this->created, PDO::PARAM_INT);
    $st->bindValue(":title", $this->title, PDO::PARAM_STR);
    $st->bindValue(":content", $this->content, PDO::PARAM_STR);
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }

  public function update() {
    if (is_null($this->id)) trigger_error ("Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR);
   
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "UPDATE articles SET created=TO_TIMESTAMP(:created), title=:title, content=:content WHERE id = :id";
    $st = $conn->prepare ($sql);
    $st->bindValue(":created", $this->created, PDO::PARAM_INT);
    $st->bindValue(":title", $this->title, PDO::PARAM_STR);
    $st->bindValue(":content", $this->content, PDO::PARAM_STR);
    $st->bindValue(":id", $this->id, PDO::PARAM_INT);
    $st->execute();
    $conn = null;
  }

  public function delete() {
    if (is_null($this->id)) trigger_error ("Article::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR);

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $st = $conn->prepare ("DELETE FROM articles WHERE id = :id LIMIT 1");
    $st->bindValue(":id", $this->id, PDO::PARAM_INT);
    $st->execute();
    $conn = null;
  }
}
?>