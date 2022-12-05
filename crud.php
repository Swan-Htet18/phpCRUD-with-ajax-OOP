<?php
    include('db.php');

    class DataCRUD extends Database
    {
        public function insertData($table,$data)
        {
            $sql="INSERT INTO ".$table." (".implode(",",array_keys($data)).") VALUES ('".implode("','",array_values($data))."')";
            return mysqli_query($this->conn,$sql);
        }

        public function selectData($table)
        {
            $sql="SELECT * FROM ".$table;
            return mysqli_query($this->conn,$sql);
        }

        public function deleteData($table,$where)
        {
            foreach($where as $key => $value) {
                $a=$key."='".$value."'";
            }
            $sql="DELETE FROM ".$table." WHERE ".$a;
            return mysqli_query($this->conn,$sql);
        }
        public function editData($table,$where)
        {
            foreach($where as $key => $value) {
                $a=$key."='".$value."'";
            }
            $sql="SELECT * FROM ".$table." WHERE ".$a;
            return mysqli_query($this->conn,$sql);
        }
    }
    $obj=new DataCRUD;
    date_default_timezone_set('Asia/Yangon');

    if(isset($_POST['name']) && isset($_POST['email']))
    {
        $myarray=["name"=>$_POST['name'],"email"=>$_POST['email'],"created_date"=>date('Y-m-d'),"modified_date"=>date('Y-m-d')];
        $result=$obj->insertData("user",$myarray);
        if($result)
        {
            header("location:index.php");
        }
    }
    if(isset($_GET['id']))
    {
        $condition=["id" => $_GET['id']];
        $result=$obj->deleteData("user",$condition);
        if($result)
        {
            header("location:index.php");
        }
    }
    
?>