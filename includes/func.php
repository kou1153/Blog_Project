<?php

function getPost($id, $conn) {
  $sql = "SELECT * FROM posts, users WHERE post_id = ? AND posts.user_id = users.id";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows == 1) {
    return $result->fetch_assoc();
  } else {
    return false;
  }
}

function getUser($id, $conn){
  $sql = "SELECT * FROM users WHERE users.id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows == 1) {
    return $result->fetch_assoc();
  } else {
    return false;
  }
}
class Comment {
    //class properties
    public $comment_text;
    public $comment_author;
    public $comment_user_id;
    public $post_id;
    public $comment_id;
    public $comment;
    public $comments = [];
    public $conn;
    public $insert_id;
  
    // constructor function
    public function __construct($post_id, $conn) {
      $this->post_id = $post_id;
      $this->conn = $conn;
    }
  
    // Comment methods : CRUD etc
    public function getComments() {
      $sql = "SELECT * FROM comments, users WHERE comments.post_id = ? and comments.user_id = users.id ORDER BY date_created DESC";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("i", $this->post_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $this->comments = $result->fetch_all(MYSQLI_ASSOC);
    }
  
    public function createComment($comment_text, $user_id) {
      $sql = "INSERT INTO comments (user_id, post_id, message) VALUES (?,?,?)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("iis", $user_id, $this->post_id, $comment_text);
      $stmt->execute();
      if($stmt->affected_rows == 1) {
        $this->insert_id = $stmt->insert_id;
        $this->getComments();
      }
    } 
  }
?>