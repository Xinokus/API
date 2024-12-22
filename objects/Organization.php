<?php

namespace objects;

class Organization
{
    private $conn;
    private $table_name = "organization";

    public $organizationname;
    public $agreementid;
    public $countryid;
    public $address;
    public $phone;
    public $email;
    public $website;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function readAll()
    {
        $query = "SELECT * FROM ".$this->table_name." ORDER BY organizationname";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function create(){
        $query="INSERT INTO ".$this->table_name." (organizationname,agreementid,countryid,address,phone,email,website) 
        VALUES (:organizationname,:agreementid,:countryid,:address,:phone,:email,:website)";
        $stmt = $this->conn->prepare($query);
        $this->organizationname=htmlspecialchars(strip_tags($this->organizationname));
        $this->agreementid=htmlspecialchars(strip_tags($this->agreementid));
        $this->countryid=htmlspecialchars(strip_tags($this->countryid));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->website=htmlspecialchars(strip_tags($this->website));
        $stmt->bindParam(':organizationname',$this->organizationname);
        $stmt->bindParam(':agreementid',$this->agreementid);
        $stmt->bindParam(':countryid',$this->countryid);
        $stmt->bindParam(':address',$this->address);
        $stmt->bindParam(':phone',$this->phone);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':website',$this->website);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function delete()
    {
        $query = "delete from ".$this->table_name." where organizationname=:organizationname";
        $stmt = $this->conn->prepare($query);
        $this->organizationname = htmlspecialchars(strip_tags($this->organizationname));
        $stmt->bindParam(':organizationname',$this->organizationname);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function update()
    {
        $query = "update " . $this->table_name . " set
                                                 organizationname=:organizationname,
                                                 agreementid=:agreementid,
                                                 countryid=:countryid,
                                                 address=:address,
                                                 phone=:phone,
                                                 email=:email,
                                                 website=:website
                                                 where organizationname=:organizationname";
        $stmt = $this->conn->prepare($query);
        $this->organizationname = htmlspecialchars(strip_tags($this->organizationname));
        $this->agreementid = htmlspecialchars(strip_tags($this->agreementid));
        $this->countryid = htmlspecialchars(strip_tags($this->countryid));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->website = htmlspecialchars(strip_tags($this->website));

        $stmt->bindParam(':organizationname',$this->organizationname);
        $stmt->bindParam(':agreementid',$this->agreementid);
        $stmt->bindParam(':countryid',$this->countryid);
        $stmt->bindParam(':address',$this->address);
        $stmt->bindParam(':phone',$this->phone);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':website',$this->website);

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