<?php
class newsletter_Subscribers{
    public function getAllSubscribers($db)
    {
        $query = "SELECT *  FROM newsletter_subscribers";
        $pdostm = $db->prepare($query);
        $pdostm->execute();
        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
    public function getSubscribersById($db, $id)
    {
        $query = "SELECT * FROM newsletter_subscribers  
                        WHERE id=:id;";
        $pst = $db->prepare($query);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $u = $pst->fetch(\PDO::FETCH_OBJ);
        return $u;
    }
    public function addSubscriber($db,$email,$name)
    {
        $query = "INSERT INTO newsletter_subscribers (email_id,name) 
                        VALUES (:email,:name); ";
        $pst = $db->prepare($query);
        $pst->bindParam(':email',$email);
        $pst->bindParam(':name',$name);
        $count = $pst->execute();
        return $count;
    }

    public function updateSubscribers($db,$id,$email,$name)
    {
        $query = "Update newsletter_subscribers
                       set email_id = :email, name=:name
                           where id = :id ";
        $pst =  $db->prepare($query);
        $pst->bindParam(':id',$id);
        $pst->bindParam(':email',$email);
        $pst->bindParam(':name',$name);
        $count = $pst->execute();
        return $count;
    }

    public function deleteSubscribers($db,$id)
    {
        $query = "DELETE from newsletter_subscribers where id =:id;";
        $pst = $db->prepare($query);
        $pst->bindParam(':id',$id);
        $count = $pst->execute();
        return $count;
    }
}