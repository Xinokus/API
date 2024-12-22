<?php

namespace objects;

class Orders
{
    private $conn;
    private $table_name = "orders";

    public $orderid;
    public $agreementid;
    public $equipmenttype;
    public $userscomment;
    public $employeeid;
    public $organizationname;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function readAll()
    {
        $query = "SELECT * FROM ".$this->table_name." ORDER BY orderid";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function create(){
        $query="INSERT INTO ".$this->table_name." (orderid,agreementid,equipmenttype,userscomment,employeeid,organizationname) 
        VALUES (:orderid,:agreementid,:equipmenttype,:userscomment,:employeeid,:organizationname)";
        $stmt = $this->conn->prepare($query);
        $this->orderid=htmlspecialchars(strip_tags($this->orderid));
        $this->agreementid=htmlspecialchars(strip_tags($this->agreementid));
        $this->equipmenttype=htmlspecialchars(strip_tags($this->equipmenttype));
        $this->userscomment=htmlspecialchars(strip_tags($this->userscomment));
        $this->employeeid=htmlspecialchars(strip_tags($this->employeeid));
        $this->organizationname=htmlspecialchars(strip_tags($this->organizationname));

        $stmt->bindParam(':orderid',$this->orderid);
        $stmt->bindParam(':agreementid',$this->agreementid);
        $stmt->bindParam(':equipmenttype',$this->equipmenttype);
        $stmt->bindParam(':userscomment',$this->userscomment);
        $stmt->bindParam(':employeeid',$this->employeeid);
        $stmt->bindParam(':organizationname',$this->organizationname);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function delete()
    {
        $query = "delete from ".$this->table_name." where orderid=:orderid";
        $stmt = $this->conn->prepare($query);
        $this->orderid = htmlspecialchars(strip_tags($this->orderid));
        $stmt->bindParam(':orderid',$this->orderid);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function update()
    {
        $query = "update " . $this->table_name . " set
                                                 orderid=:orderid,
                                                 agreementid=:agreementid,
                                                 equipmenttype=:equipmenttype,
                                                 userscomment=:userscomment,
                                                 employeeid=:employeeid,
                                                 organizationname=:organizationname
                                                 where orderid=:orderid";
        $stmt = $this->conn->prepare($query);
        $this->orderid = htmlspecialchars(strip_tags($this->orderid));
        $this->agreementid = htmlspecialchars(strip_tags($this->agreementid));
        $this->equipmenttype = htmlspecialchars(strip_tags($this->equipmenttype));
        $this->userscomment = htmlspecialchars(strip_tags($this->userscomment));
        $this->employeeid = htmlspecialchars(strip_tags($this->employeeid));
        $this->organizationname = htmlspecialchars(strip_tags($this->organizationname));

        $stmt->bindParam(':orderid',$this->orderid);
        $stmt->bindParam(':agreementid',$this->agreementid);
        $stmt->bindParam(':equipmenttype',$this->equipmenttype);
        $stmt->bindParam(':userscomment',$this->userscomment);
        $stmt->bindParam(':employeeid',$this->employeeid);
        $stmt->bindParam(':organizationname',$this->organizationname);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function search($keyword)
    {
        $query="SELECT * FROM ".$this->table_name.
        " WHERE orderid = ?";

        $stmt = $this->conn->prepare($query);
        $keyword=htmlspecialchars(strip_tags($keyword));
        $keyword="$keyword";
        $stmt->bindParam(1,$keyword);
        $stmt->execute();
        return $stmt;
    }
}