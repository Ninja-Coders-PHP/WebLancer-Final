<?php
class newsletter_details{

    public function getAllNewsletter($db)
    {
        $query = "SELECT *  FROM newsletter_details";
        $pdostm = $db->prepare($query);
        $pdostm->execute();
        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
    public function getNewsletterById($db,$id)
    {
        $query = "SELECT id,subject,body,created_date FROM newsletter_details WHERE id = :id ";
        $pst = $db->prepare($query);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $n = $pst->fetch(\PDO::FETCH_OBJ);
        return $n;
    }

    public function addNewsLetter ($db,$subject,$body,$date)
    {
        $query = "INSERT INTO newsletter_details (subject,body,created_date) 
                    VALUES  (:subject,:body,:date);";
        $pst = $db->prepare($query);
        $pst->bindParam(':subject',$subject);
        $pst->bindParam(':body',$body);
        $pst->bindParam(':date',$date);
        $count = $pst->execute();
        return $count;
    }

    public  function updateNewsLetter($db,$id,$subject,$body,$date)
    {

        $query = "Update newsletter_details
                       SET subject = :subject,
                           body = :body,
                           created_date = :date
                           where newsletter_details.id = :id ";
        $pst = $db->prepare($query);
        $pst->bindParam(':subject',$subject);
        $pst->bindParam(':body',$body);
        $pst->bindParam(':date',$date);
        $pst->bindParam(':id',$id);
        $count = $pst->execute();
        return $count;
    }
    public function deleteNewsLetter($db,$id)
    {
        $query = "DELETE from newsletter_details where id=:id";
        $pst = $db->prepare($query);
        $pst->bindParam(':id',$id);
        $count = $pst->execute();
        return $count;
    }
}