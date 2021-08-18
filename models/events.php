<?php
    class events {
        public function listEvents($db)
        {
            $query = "SELECT * FROM `event_bookings`;";
            $pdostm = $db->prepare($query);
            $pdostm->execute();
            //fetch all faqs
            $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
            return $results;
        }

        public function getEventById($db,$id)
        {
            $query = "SELECT * FROM `event_bookings` WHERE id=:id;";
            $pst = $db->prepare($query);
            $pst->bindParam(':id', $id);
            $pst->execute();
            $result = $pst->fetch(\PDO::FETCH_OBJ);
            return $result;
        }

        public function addEvent($db,$first_name,$last_name,$email,$phone_number)
        {
            $query = "INSERT INTO `event_bookings` (`first_name`, `last_name`,`email`,`phone_number`) 
                        VALUES (:first_name, :last_name,:email,:phone_number); ";
            $pst = $db->prepare($query);

            $pst->bindParam(':first_name',$first_name);
            $pst->bindParam(':last_name',$last_name);
            $pst->bindParam(':email',$email);
            $pst->bindParam(':phone_number',$phone_number);
            $count = $pst->execute();
            return $count;
        }

        public function deleteEvent($db,$id)
        {
            $query = "DELETE from `event_bookings` where id=:id";
            $pst = $db->prepare($query);
            $pst->bindParam(':id',$id);
            $count = $pst->execute();
            return $count;
        }

        public function updateEvent($db,$id,$first_name,$last_name,$email,$phone_number)
        {
            $query = "UPDATE `event_bookings`
                       set first_name = :first_name, last_name = :last_name,email=:email,
                       phone_number = :phone_number WHERE id = :id";
            $pst =  $db->prepare($query);
            $pst->bindParam(':id',$id);
            $pst->bindParam(':first_name',$first_name);
            $pst->bindParam(':last_name',$last_name);
            $pst->bindParam(':email',$email);
            $pst->bindParam(':phone_number',$phone_number);
            
            $count = $pst->execute();
            return $count;
        }
    }
?>