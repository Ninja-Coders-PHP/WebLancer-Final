<?php
    class faqs {
        public function listFAQs($db)
        {
            $query = "SELECT * FROM `faqs`;";
            $pdostm = $db->prepare($query);
            $pdostm->execute();
            //fetch all faqs
            $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
            return $results;
        }

        public function getFAQById($db,$id)
        {
            $query = "SELECT * FROM `faqs` WHERE id=:id;";
            $pst = $db->prepare($query);
            $pst->bindParam(':id', $id);
            $pst->execute();
            $result = $pst->fetch(\PDO::FETCH_OBJ);
            return $result;
        }

        public function addFAQ($db,$question,$answer)
        {
            $query = "INSERT INTO `faqs` (`question`, `answer`) 
                        VALUES (:question, :answer); ";
            $pst = $db->prepare($query);

            $pst->bindParam(':question',$question);
            $pst->bindParam(':answer',$answer);
            $count = $pst->execute();
            return $count;
        }

        public function deleteFAQ($db,$id)
        {
            $query = "DELETE from `faqs` where id=:id";
            $pst = $db->prepare($query);
            $pst->bindParam(':id',$id);
            $count = $pst->execute();
            return $count;
        }

        public function updateFAQ($db,$id,$question,$answer)
        {
            $query = "UPDATE `faqs`
                       set question = :question, answer = :answer WHERE id = :id";
            $pst =  $db->prepare($query);
            $pst->bindParam(':id',$id);
            $pst->bindParam(':question',$question);
            $pst->bindParam(':answer',$answer);
            
            $count = $pst->execute();
            return $count;
        }
    }
?>