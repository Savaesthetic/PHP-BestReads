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

        // Test function to check if connection is working with SELECT *
        public function testHerokuDB() {
            $stmt = $this->DB->prepare("SELECT * FROM books;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Returns all of the images from the books table;
        public function getAllImages() {
            $stmt = $this->DB->prepare("SELECT image FROM books;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>