<?php
    class contactUsUsers {
        public function listMessages($db)
        {
            $query = "SELECT * FROM `contact_us_details`;";
            $pdostm = $db->prepare($query);
            $pdostm->execute();
            //fetch all result
            $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
            return $results;
        }

        public function getMessageById($db,$id)
        {
            $query = "SELECT * FROM `contact_us_details` WHERE id=:id;";
            $pst = $db->prepare($query);
            $pst->bindParam(':id', $id);
            $pst->execute();
            $result = $pst->fetch(\PDO::FETCH_OBJ);
            return $result;
        }

        public function addMessage($db,$first_name,$last_name,$email,$subject,$message)
        {
            $query = "INSERT INTO `contact_us_details` (`first_name`, `last_name`, `email`, `subject`, `message`) 
                        VALUES (:first_name, :last_name,:email,:subject,:message); ";
            $pst = $db->prepare($query);

            $pst->bindParam(':first_name',$first_name);
            $pst->bindParam(':last_name',$last_name);
            $pst->bindParam(':email',$email);
            $pst->bindParam(':subject',$subject);
            $pst->bindParam(':message', $message);
            $count = $pst->execute();
            return $count;
        }

        public function deleteMessage($db,$id)
        {
            $query = "DELETE from `contact_us_details` where id=:id";
            $pst = $db->prepare($query);
            $pst->bindParam(':id',$id);
            $count = $pst->execute();
            return $count;
        }

        public function updateMessage($db,$id,$first_name,$last_name,$email,$subject,$message)
        {
            $query = "UPDATE `contact_us_details`
                       set first_name = :first_name, last_name = :last_name, email = :email,
                           subject = :subject, message = :message WHERE id = :id";
            $pst =  $db->prepare($query);
            $pst->bindParam(':id',$id);
            $pst->bindParam(':first_name',$first_name);
            $pst->bindParam(':last_name',$last_name);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':subject',$subject);
            $pst->bindParam(':message',$message);
            
            $count = $pst->execute();
            return $count;
        }
    }
?>