<?php

class Dispute
{
    public function getStatuses($db){
        $query = "SELECT *  FROM statuses";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
    public function getDisputesInStatus($db, $status){
        //$query = "SELECT statuses.status as status, disputes.id, disputes.subject,disputes.dispute FROM disputes, statuses where statuses.id = disputes.status_id AND status_id = :status";
        $query = "SELECT statuses.status as status, 
                         disputes.id, 
                         disputes.subject, 
                         disputes.last_message,
                         disputes.project_ID,
                         projects.project_name
                  FROM disputes 
                  INNER JOIN statuses on statuses.id = disputes.status_id
                  INNER JOIN projects ON projects.id = disputes.project_id 
                  WHERE disputes.status_id = :status";

        $pdostm = $db->prepare($query);
        $pdostm->bindValue(':status', $status, \PDO::PARAM_STR);
        $pdostm->execute();
        $s = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $s;
    }
    public function getDisputeById($id, $db){
        $sql = "SELECT statuses.status as status, 
                       disputes.status_id,  
                       disputes.id, 
                       disputes.subject, 
                       disputes.last_message,
                       disputes.project_ID
                FROM disputes 
                INNER JOIN statuses ON statuses.id = disputes.status_id AND disputes.id = :idd";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $s = $pst->fetch(\PDO::FETCH_OBJ);
        return $s;
    }



    public function getAllDisputes($dbcon){

        $sql = "SELECT statuses.status AS status, 
                       disputes.id, 
                       disputes.subject,
                       disputes.last_message,
                       disputes.project_id,
                       projects.project_name
                FROM disputes 
                INNER JOIN statuses ON statuses.id = disputes.status_id
                INNER JOIN projects ON projects.id = disputes.project_id";

        //$sql = "SELECT * FROM disputes INNER JOIN statuses ON statuses.id = disputes.status_id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $disputes = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $disputes;
    }

    public function addDispute($subject, $last_message, $project_id, $status, $db)
    {
        $sql = "INSERT INTO disputes (`subject`, last_message, status_ID, project_id)
              VALUES (:subject, :last_message, :status, :project_id) ";
        $pst = $db->prepare($sql);
        $pst->bindParam(':subject', $subject);
        $pst->bindParam(':last_message', $last_message);
        $pst->bindParam(':status', $status);
        $pst->bindParam(':project_id', $project_id);

        $count = $pst->execute();
        return $count;
    }

    public function deleteDispute($id, $db){
        $sql = "DELETE FROM disputes WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;

    }

    public function updateDispute($id, $subject, $last_message, $project_id, $status, $db){
        $sql = "UPDATE disputes
                SET `subject` = :subject,
                    last_message = :last_message,
                    status_id = :status,
                    project_id = :project_id
                WHERE id = :id;
        ";

        $pst =  $db->prepare($sql);

        $pst->bindParam(':subject', $subject);
        $pst->bindParam(':last_message', $last_message);
        $pst->bindParam(':status', $status);
        $pst->bindParam(':project_id', $project_id);
        $pst->bindParam(':id', $id);

        $count = $pst->execute();

        return $count;
    }

    public function getProjects($db){
        $query = "SELECT projects.id, 
                         projects.project_name
                  FROM projects 
                  WHERE projects.status_id != 3";

        $pdostm = $db->prepare($query);
        $pdostm->execute();
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);

        return $results;
    }
}