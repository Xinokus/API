<?php

namespace objects;

class Agreement
{
    private $conn;
    private $table_name = "agreement";

    public $agreementid;
    public $organizationname;
    public $agreementdate;
    public $employeeid;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function readAll()
    {
        $query = "SELECT * FROM ".$this->table_name." ORDER BY agreementid";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function create(){
        $query="INSERT INTO ".$this->table_name." (agreementid,organizationname,agreementdate,employeeid) 
        VALUES (:agreementid,:organizationname,:agreementdate,:employeeid)";
        $stmt = $this->conn->prepare($query);
        $this->agreementid=htmlspecialchars(strip_tags($this->agreementid));
        $this->organizationname=htmlspecialchars(strip_tags($this->organizationname));
        $this->agreementdate=htmlspecialchars(strip_tags($this->agreementdate));
        $this->employeeid=htmlspecialchars(strip_tags($this->employeeid));
        $stmt->bindParam(':agreementid',$this->agreementid);
        $stmt->bindParam(':organizationname',$this->organizationname);
        $stmt->bindParam(':agreementdate',$this->agreementdate);
        $stmt->bindParam(':employeeid',$this->employeeid);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function delete()
    {
        $query = "delete from ".$this->table_name." where agreementid=:agreementid";
        $stmt = $this->conn->prepare($query);
        $this->agreementid = htmlspecialchars(strip_tags($this->agreementid));
        $stmt->bindParam(':agreementid',$this->agreementid);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function update()
    {
        $query = "update " . $this->table_name . " set
                                                 organizationname=:organizationname,
                                                 agreementdate=:agreementdate,
                                                 employeeid=:employeeid
                                                 where agreementid=:agreementid";
        $stmt = $this->conn->prepare($query);
        $this->organizationname = htmlspecialchars(strip_tags($this->organizationname));
        $this->agreementdate = htmlspecialchars(strip_tags($this->agreementdate));
        $this->employeeid = htmlspecialchars(strip_tags($this->employeeid));
        $this->agreementid = htmlspecialchars(strip_tags($this->agreementid));

        $stmt->bindParam(':organizationname',$this->organizationname);
        $stmt->bindParam(':agreementdate',$this->agreementdate);
        $stmt->bindParam(':employeeid',$this->employeeid);
        $stmt->bindParam(':agreementid',$this->agreementid);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function search($keyword)
    {
        $query="SELECT * FROM ".$this->table_name.
        " WHERE organizationname LIKE ?";

        $stmt = $this->conn->prepare($query);
        $keyword=htmlspecialchars(strip_tags($keyword));
        $keyword="%$keyword%";
        $stmt->bindParam(1,$keyword);
        $stmt->execute();
        return $stmt;
    }
}