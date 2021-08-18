<?php
class feedback
{
    public function listFeedback($db)
    {
        $query = "SELECT * FROM `feedback_websites`;";
        $pdostm = $db->prepare($query);
        $pdostm->execute();
        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    public function getFeedbackById($db, $id)
    {
        $query = "SELECT * FROM `feedback_websites` WHERE id=:id;";
        $pst = $db->prepare($query);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $result = $pst->fetch(\PDO::FETCH_OBJ);
        return $result;
    }

    public function addFeedback($db, $user_id, $stars, $reviews)
    {
        $query = "INSERT INTO `feedback_websites` (`user_id`, `stars`, `reviews`) 
                        VALUES (:user_id, :stars, :reviews); ";
        $pst = $db->prepare($query);

        $pst->bindParam(':user_id', $user_id);
        $pst->bindParam(':stars', $stars);
        $pst->bindParam(':reviews', $reviews);
        $count = $pst->execute();
        return $count;
    }

    public function deleteFeedback($db, $id)
    {
        $query = "DELETE from `feedback_websites` where id=:id";
        $pst = $db->prepare($query);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }

    public function updateFeedback($db, $id, $user_id, $stars, $reviews)
    {
        $query = "UPDATE `feedback_websites`
                       set user_id = :user_id, stars = :stars, reviews = :reviews WHERE id = :id;";
        $pst =  $db->prepare($query);
        $pst->bindParam(':id', $id);
        $pst->bindParam(':user_id', $user_id);
        $pst->bindParam(':stars', $stars);
        $pst->bindParam(':review', $reviews);

        $count = $pst->execute();
        return $count;
    }
}
