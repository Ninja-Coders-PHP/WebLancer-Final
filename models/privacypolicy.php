<?php
class privacypolicy
{
    public function getAllPolicies($db)
    {
        $query = "SELECT *  FROM privacy_policies";
        $pdostm = $db->prepare($query);
        $pdostm->execute();
        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    public function getPolicyById($db,$id)
    {
        $sql = "SELECT * FROM privacy_policies
                WHERE id =:id;";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $result = $pst->fetch(\PDO::FETCH_OBJ);
        return $result;
    }
    public function addPolicy($db,$name,$description,$created_date,$modified_date,$user_id)
    {
        $query = "INSERT INTO privacy_policies (name,description,created_date,modified_date,user_id) 
                    VALUES  (:name,:description,:created_date,:modified_date,:user_id);";
        $pst = $db->prepare($query);
        $pst->bindParam(':name',$name);
        $pst->bindParam(':description',$description);
        $pst->bindParam(':created_date',$created_date);
        $pst->bindParam(':modified_date',$modified_date);
        $pst->bindParam(':user_id',$user_id);
        $count = $pst->execute();
        return $count;
    }
    public function updatePolicy($db,$id,$name,$description,$created_date,$modified_date,$user_id)
    {

        $query = "Update privacy_policies
                       set name=:name,
                           description =:description,
                           created_date =:created_date,
                           modified_date =:modified_date,
                           user_id = :user_id
                           where id = :id ";
        $pst =  $db->prepare($query);
        $pst->bindParam(':id',$id);
        $pst->bindParam(':description',$description);
        $pst->bindParam(':name',$name);
        $pst->bindParam(':created_date',$created_date);
        $pst->bindParam(':modified_date',$modified_date);
        $pst->bindParam(':user_id',$user_id);
        $count = $pst->execute();
        return $count;
    }
    public function deletePolicy($db,$id)
    {
        $query = "DELETE  FROM privacy_policies where id =:id;";
        $pst = $db->prepare($query);
        $pst->bindParam(':id',$id);
        $count = $pst->execute();
        return $count;
    }
}
