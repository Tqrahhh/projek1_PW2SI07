<?php

    class Topups {
        private $conn;
        private $table_name = "topups";

        public $id;
        public $user_id;
        public $game_id;
        public $amount;
        public $topup_date;

        public function __construct($db){
            $this->conn = $db;
        }

        public function index(){
            $query = "SELECT * FROM {$this->table_name}";
            $data = $this->conn->prepare($query);
            $data->execute();
            return $data;
        }

        public function store(){
            $query = "INSERT INTO {$this->table_name} 
                    (user_id, game_id, amount, topup_date) 
                    VALUES (?, ?, ?, ?)";
            $data = $this->conn->prepare($query);
        
            return $data->rowCount() > 0;
        }

        public function edit(){
            $query = "SELECT * FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
            return $data;
        }

        public function update(){
            $query = "UPDATE {$this->table_name} 
                    SET user_id=?, game_id=?, amount=?, topup_date=?
                    WHERE id=?";
            $data = $this->conn->prepare($query);
        
            $data->execute([ 
                $this->user_id,
                $this->game_id,
                $this->amount,
                $this->topup_date,
                $this->id
            ]);
        
            return $data->rowCount() > 0;
        }

        public function delete(){
            $query = "DELETE FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
        
            return $data->rowCount() > 0;
        }
    }

?>
