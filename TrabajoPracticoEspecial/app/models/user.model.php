<?php
require_once './app/models/model.php';
class UserModel extends Model{
    
    public function getByUser($user) {
        $query = $this->db->prepare('SELECT * FROM users WHERE user = ?');
        $query->execute([$user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}

/*busca un usuario específico en la base de datos utilizando su nombre de usuario. */