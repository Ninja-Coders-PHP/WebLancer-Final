<?php

class Project
{
    public function getStatuses($db){
        $query = "SELECT *  FROM statuses";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
    public function getProjectsInStatus($db, $status){
        //$query = "SELECT statuses.status as status, projects.id, projects.desc,projects.project FROM projects, statuses where statuses.id = projects.status_id AND status_id = :status";
        $query = "SELECT statuses.status as status, 
                         projects.id, 
                         projects.desc, 
                         projects.project_name,
                         projects.freelancer_ID
                  FROM projects 
                  INNER JOIN statuses on statuses.id = projects.status_id 
                  WHERE status_id = :status";

        $pdostm = $db->prepare($query);
        $pdostm->bindValue(':status', $status, \PDO::PARAM_STR);
        $pdostm->execute();
        $s = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $s;
    }
    public function getProjectById($id, $db){
        $sql = "SELECT statuses.status as status, 
                       projects.status_id,  
                       projects.id, 
                       projects.desc, 
                       projects.project_name,
                       projects.freelancer_ID
                FROM projects 
                INNER JOIN statuses ON statuses.id = projects.status_id AND projects.id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $s = $pst->fetch(\PDO::FETCH_OBJ);
        return $s;
    }



    public function getAllProjects($dbcon){

        $sql = "SELECT statuses.status AS status, 
                       projects.id, 
                       projects.desc,
                       projects.project_name,
                       projects.freelancer_ID
                FROM projects 
                INNER JOIN statuses ON statuses.id = projects.status_id ";

        //$sql = "SELECT * FROM projects INNER JOIN statuses ON statuses.id = projects.status_id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $projects = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $projects;
    }

    public function addProject($desc, $project_name, $freelancer_id, $status, $db)
    {
        $sql = "INSERT INTO projects (`desc`, project_name, status_ID, freelancer_id)
              VALUES (:desc, :project_name, :status, :freelancer_id) ";
        $pst = $db->prepare($sql);

        $pst->bindParam(':desc', $desc);
        $pst->bindParam(':project_name', $project_name);
        $pst->bindParam(':status', $status);
        $pst->bindParam(':freelancer_id', $freelancer_id);

        $count = $pst->execute();
        return $count;
    }

    public function deleteProject($id, $db){
        $sql = "DELETE FROM projects WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;

    }

    public function updateProject($id, $desc, $project_name, $freelancer_id, $status, $db){
        $sql = "UPDATE projects
                SET `desc` = :desc,
                    project_name = :project_name,
                    status_id = :status,
                    freelancer_ID = :freelancer_id
                WHERE id = :id
        
        ";

        $pst =  $db->prepare($sql);

        $pst->bindParam(':desc', $desc);
        $pst->bindParam(':project_name', $project_name);
        $pst->bindParam(':status', $status);
        $pst->bindParam(':freelancer_id', $freelancer_id);
        $pst->bindParam(':id', $id);

        $count = $pst->execute();

        return $count;
    }

    public function getFreelancers($db){
        $query = "SELECT freelancer_profiles.id, users.first_name, users.last_name
                    FROM freelancer_profiles
                    JOIN users ON users.id = freelancer_profiles.user_id
                    WHERE users.role_id = 6";

        $pdostm = $db->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
}