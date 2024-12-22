<?php

namespace objects;

class Employee
{
    private $conn;
    private $table_name = "employee";

    public $employeeid;
    public $sectionid;
    public $firstname;
    public $middlename;
    public $lastname;
    public $workposition;
    public $earnings;
    public $special;
    public $employeemonth;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function readAll()
    {
        $query = "SELECT * FROM ".$this->table_name." ORDER BY employeeid";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function create(){
        $query="INSERT INTO ".$this->table_name." (employeeid,sectionid,firstname,middlename,lastname,workposition,earnings,special,employeemonth) 
        VALUES (:employeeid,:sectionid,:firstname,:middlename,:lastname,:workposition,:earnings,:special,:employeemonth)";
        $stmt = $this->conn->prepare($query);
        $this->employeeid=htmlspecialchars(strip_tags($this->employeeid));
        $this->sectionid=htmlspecialchars(strip_tags($this->sectionid));
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->middlename=htmlspecialchars(strip_tags($this->middlename));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->workposition=htmlspecialchars(strip_tags($this->workposition));
        $this->earnings=htmlspecialchars(strip_tags($this->earnings));
        $this->special=htmlspecialchars(strip_tags($this->special));
        $this->employeemonth=htmlspecialchars(strip_tags($this->employeemonth));

        $stmt->bindParam(':employeeid',$this->employeeid);
        $stmt->bindParam(':sectionid',$this->sectionid);
        $stmt->bindParam(':firstname',$this->firstname);
        $stmt->bindParam(':middlename',$this->middlename);
        $stmt->bindParam(':lastname',$this->lastname);
        $stmt->bindParam(':workposition',$this->workposition);
        $stmt->bindParam(':earnings',$this->earnings);
        $stmt->bindParam(':special',$this->special);
        $stmt->bindParam(':employeemonth',$this->employeemonth);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function delete()
    {
        $query = "delete from ".$this->table_name." where employeeid=:employeeid";
        $stmt = $this->conn->prepare($query);
        $this->employeeid = htmlspecialchars(strip_tags($this->employeeid));
        $stmt->bindParam(':employeeid',$this->employeeid);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function update()
    {
        $query = "update " . $this->table_name . " set
                                                 employeeid=:employeeid,
                                                 sectionid=:sectionid,
                                                 firstname=:firstname,
                                                 middlename=:middlename,
                                                 lastname=:lastname,
                                                 workposition=:workposition,
                                                 earnings=:earnings,
                                                 special=:special,
                                                 employeemonth=:employeemonth
                                                 where employeeid=:employeeid";
        $stmt = $this->conn->prepare($query);
        $this->employeeid = htmlspecialchars(strip_tags($this->employeeid));
        $this->sectionid = htmlspecialchars(strip_tags($this->sectionid));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->middlename = htmlspecialchars(strip_tags($this->middlename));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->workposition = htmlspecialchars(strip_tags($this->workposition));
        $this->earnings = htmlspecialchars(strip_tags($this->earnings));
        $this->special = htmlspecialchars(strip_tags($this->special));
        $this->employeemonth = htmlspecialchars(strip_tags($this->employeemonth));

        $stmt->bindParam(':employeeid',$this->employeeid);
        $stmt->bindParam(':sectionid',$this->sectionid);
        $stmt->bindParam(':firstname',$this->firstname);
        $stmt->bindParam(':middlename',$this->middlename);
        $stmt->bindParam(':lastname',$this->lastname);
        $stmt->bindParam(':workposition',$this->workposition);
        $stmt->bindParam(':earnings',$this->earnings);
        $stmt->bindParam(':special',$this->special);
        $stmt->bindParam(':employeemonth',$this->employeemonth);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function search($keyword)
    {
        $query="SELECT * FROM ".$this->table_name.
        " WHERE employeeid = ?";

        $stmt = $this->conn->prepare($query);
        $keyword=htmlspecialchars(strip_tags($keyword));
        $keyword="$keyword";
        $stmt->bindParam(1,$keyword);
        $stmt->execute();
        return $stmt;
    }
}