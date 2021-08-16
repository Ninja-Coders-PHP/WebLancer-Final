<?php
    class  users{

        public function listUsers($db)
        {
            $query = "SELECT users.id,users.first_name,users.last_name,users.phone_number,users.preferred_user_name,users.email,users.role_id,users.password,roles.role_name as role_name 
                        FROM `users`INNER JOIN roles ON users.role_id = roles.id;";
            $pdostm = $db->prepare($query);
            $pdostm->execute();
            //fetch all result
            $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
            return $results;
        }
        public function getUserById($db,$id)
        {
            $query = "SELECT users.id,users.first_name,users.last_name,users.phone_number,users.preferred_user_name,users.email,users.password,users.role_id,roles.role_name as role_name 
                        FROM `users`INNER JOIN roles ON users.role_id = roles.id 
                        WHERE users.id=:id;";
            $pst = $db->prepare($query);
            $pst->bindParam(':id', $id);
            $pst->execute();
            $u = $pst->fetch(\PDO::FETCH_OBJ);
            return $u;
        }
        public function getUserByUserName($db,$userName)
        {
            $query = "SELECT users.id,users.first_name,users.last_name,users.phone_number,users.preferred_user_name,users.email,users.password,users.role_id,roles.role_name as role_name 
                        FROM `users`INNER JOIN roles ON users.role_id = roles.id 
                        WHERE users.preferred_user_name =:username;";
            $pst = $db->prepare($query);
            $pst->bindParam(':username', $userName);
            $pst->execute();
            $u = $pst->fetch(\PDO::FETCH_OBJ);
            return $u;
        }
        public function addUsers($db,$first_name,$last_name,$preferred_user_name,$phone_number,$email,$role,$password)
        {
            $query = "INSERT INTO `users` (`role_id`, `first_name`, `last_name`, `phone_number`, `preferred_user_name`, `email`,`password`) 
                        VALUES (:role,:first_name, :last_name,:phn_num,:preferred_name,:email,:password); ";
            $pst = $db->prepare($query);

            $pst->bindParam(':role',$role);
            $pst->bindParam(':first_name',$first_name);
            $pst->bindParam(':last_name',$last_name);
            $pst->bindParam(':preferred_name',$preferred_user_name);
            $pst->bindParam(':phn_num',$phone_number);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':password', $password);
            $count = $pst->execute();
            return $count;
        }

        public function deleteUser($db,$id)
        {
            $query = "DELETE from users where id=:id";
            $pst = $db->prepare($query);
            $pst->bindParam(':id',$id);
            $count = $pst->execute();
            return $count;
        }
        public function updateUser($db,$id,$first_name,$last_name,$preferred_user_name,$phone_number,$email,$role,$password)
        {
            $query = "Update users
                       set first_name = :fname,
                           last_name = :lname,
                           preferred_user_name = :username,
                           phone_number = :phn,
                           email = :email,
                           password = :password,
                           role_id = :role
                           where id = :id ";
            $pst =  $db->prepare($query);
            $pst->bindParam(':id',$id);
            $pst->bindParam(':role',$role);
            $pst->bindParam(':fname',$first_name);
            $pst->bindParam(':lname',$last_name);
            $pst->bindParam(':username',$preferred_user_name);
            $pst->bindParam(':phn',$phone_number);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':password', $password);
            $count = $pst->execute();
            return $count;
        }
    }