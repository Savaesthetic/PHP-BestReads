<?php
    // This class has a constructor to connect to a database.
    // Author: Alex Sava
    class Model {
        private $DB; // The instance variable used in every method below

        // Connect to an existing database
        public function __construct() {
            try {
                $url = parse_url(getenv("DATABASE_URL"));
                $this->DB = new PDO("pgsql:" . sprintf(
                    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                    $url["host"],
                    $url["port"],
                    $url["user"],
                    $url["pass"],
                    ltrim($url["path"], "/")
                ));
                $this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            } catch ( PDOException $e ) {
                echo ('Error establishing Connection');
                exit ();
            }
        }

        public function testHerokuDB() {
            $stmt = $this->DB->prepare("SELECT * FROM books;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllQuotations() {
            $stmt = $this->DB->prepare("SELECT * FROM quotations ORDER BY rating DESC;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function getAllUsers(){
            $stmt = $this->DB->prepare("SELECT * FROM users;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function addQuote($quote, $author) {
            $stmt = $this->DB->prepare("INSERT INTO quotations (added, quote, author, rating, flagged) VALUES (NOW(), '" . $quote . "', '" . $author . "', 0, 0);");
            $stmt->execute();
        }
        
        public function addUser($accountname, $psw){
            $stmt = $this->DB->prepare("INSERT INTO users (username, password) VALUES ('" . $accountname . "', '" . $psw . "');");
            $stmt->execute();
        }   


        public function verifyCredentials($accountName, $psw){
            $stmt = $this->DB->prepare("SELECT * FROM users WHERE username='" . $accountName . "' AND password='" . $psw . "';");
            $stmt->execute();
            return count($stmt->fetchAll(PDO::FETCH_ASSOC)) == 1;
        }
        
        public function verifyUsername($accountName){
            $stmt = $this->DB->prepare("SELECT * FROM users WHERE username='" . $accountName . "';");
            $stmt->execute();
            return count($stmt->fetchAll(PDO::FETCH_ASSOC)) == 1;
        }
        
        // Raise the rating of the quote with the given $ID by 1
        public function raiseRating($ID) {
            $query =  "UPDATE quotations SET rating=rating+1 WHERE id='" . $ID . "';" ;
            $stmt = $this->DB->prepare ($query);
            $stmt->execute ();
        }
        
        // Decrease the rating of the quote with the given $ID by 1
        public function decreaseRating($ID) {
            $query =  "UPDATE quotations SET rating=rating-1 WHERE id='" . $ID . "';" ;
            $stmt = $this->DB->prepare ($query);
            $stmt->execute ();
        }
        
        // Delete the rating of the quote with the given $ID
        public function deleteRating($ID) {
            $query =  "DELETE FROM quotations WHERE id='" . $ID . "';" ;
            $stmt = $this->DB->prepare ($query);
            $stmt->execute ();
        }
    }
?>