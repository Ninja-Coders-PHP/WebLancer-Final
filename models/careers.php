<?php
class careers
{
    public function listCareers($db)
    {
        $query = "SELECT * FROM `careers`;";
        $pdostm = $db->prepare($query);
        $pdostm->execute();
        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    public function getCareersById($db, $id)
    {
        $query = "SELECT * FROM `careers` WHERE id=:id;";
        $pst = $db->prepare($query);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $result = $pst->fetch(\PDO::FETCH_OBJ);
        return $result;
    }

    public function addCareer($db, $job_title, $job_description, $expected_pay)
    {
        $query = "INSERT INTO `careers` (`job_title`, `job_description`, `expected_pay`) 
                        VALUES (:job_title, :job_description, :expected_pay); ";
        $pst = $db->prepare($query);

        $pst->bindParam(':job_title', $job_title);
        $pst->bindParam(':job_description', $job_description);
        $pst->bindParam(':expected_pay', $expected_pay);
        $count = $pst->execute();
        return $count;
    }

    public function deleteCareer($db, $id)
    {
        $query = "DELETE from `careers` where id=:id";
        $pst = $db->prepare($query);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }

    public function updateCareer($db, $id, $job_title, $job_description, $expected_pay)
    {
        $query = "UPDATE `careers`
                       set job_title = :job_title, job_description = :job_description, expected_pay = :expected_pay WHERE id = :id";
        $pst =  $db->prepare($query);
        $pst->bindParam(':id', $id);
        $pst->bindParam(':job_title', $job_title);
        $pst->bindParam(':job_description', $job_description);
        $pst->bindParam(':expected_pay', $expected_pay);

        $count = $pst->execute();
        return $count;
    }
}
