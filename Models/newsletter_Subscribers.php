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
    public function addSubscriber($db,$email)
    {
        $query = "INSERT INTO newsletter_subscribers (email_id) 
                        VALUES (:email); ";
        $pst = $db->prepare($query);
        $pst->bindParam(':email',$email);
        $count = $pst->execute();
        return $count;
    }
}