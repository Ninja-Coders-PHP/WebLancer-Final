<?php
class roles
{
    public function getRoles($db)
    {
        $query = "SELECT *  FROM roles";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
}