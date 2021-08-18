<?php


class Freelancer
{
    public function getAllProjects($db,$user_id) {

        $sql = "SELECT statuses.status AS status, 
                       projects.id, 
                       projects.desc,
                       projects.project_name,
                       projects.freelancer_ID
                FROM projects 
                INNER JOIN statuses ON statuses.id = projects.status_id
                INNER JOIN freelancer_profiles ON freelancer_profiles.id = projects.freelancer_ID
                WHERE freelancer_profiles.user_id = :freelancer_id
                ORDER BY projects.id ASC";

        $pdostm = $db->prepare($sql);
        $pdostm->bindParam(':freelancer_id', $user_id);

        $pdostm->execute();

        $projects = $pdostm->fetchAll(\PDO::FETCH_OBJ);

        return $projects;
    }

    public function addFreelancer($db, $user_id, $profession, $skills, $linked_in)
    {
        $query = "INSERT INTO `freelancer_profiles` (`user_id`, `profession`, `skills`, `linked_in`) 
                    VALUES (:user_id, :profession, :skills, :linked_in); ";
        $pst = $db->prepare($query);

        $pst->bindParam(':user_id',$user_id);
        $pst->bindParam(':profession',$profession);
        $pst->bindParam(':skills',$skills);
        $pst->bindParam(':linked_in',$linked_in);
        $count = $pst->execute();
        return $count;
    }
}