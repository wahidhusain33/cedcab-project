<?php

session_start();

include_once 'Dbcon.php';

class User extends Dbcon
{
    public $email_id;
    public $name;
    public $dateofsignup;
    public $mobile;
    public $status;
    public $password;
    public $is_admin;

    function __construct()
    {

        $db = new Dbcon();
        $this->conn = $db->conn;
    }
    function signup($name, $email, $mob, $pass, $file)
    {
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
        $this->mob = $mob;

        $sql = "INSERT INTO `tbl_user`(`email_id`, `name`, `dateofsignup`, `mobile`, `status`,`password`,`is_admin`,`profile`)
        VALUES('$this->email','$this->name', now(),'$this->mob', '1','$this->pass', '0','$file')";

        $data = $this->conn->query($sql);

        if ($data == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }
    
    function login($email, $pass)
    {

        $this->email = $email;
        $this->password = md5($pass);

        $sql1 = "SELECT * FROM `tbl_user` WHERE `email_id`='$email' AND `password`='$pass'";
        $result = $this->conn->query($sql1);

        if ($result->num_rows > 0) {
            $users = $result->fetch_assoc();
            if ($users['is_admin'] == 1) {
                $_SESSION['admin']['email_id'] = $users['email_id'];
                $_SESSION['admin']['is_admin'] = $users['is_admin'];
                $_SESSION['admin']['name'] = $users['name'];
                $_SESSION['admin']['mobile'] = $users['mobile'];
                $_SESSION['admin']['admin_id'] = $users['user_id'];
                return 1;
            } else {
                if ($users['status'] == 1) {
                    $_SESSION['user']['email_id'] = $users['email_id'];
                    $_SESSION['user']['is_admin'] = $users['is_admin'];
                    $_SESSION['user']['name'] = $users['name'];
                    $_SESSION['user']['mobile'] = $users['mobile'];
                    $_SESSION['user']['user_id'] = $users['user_id'];

                    return 0;
                } else {
                    return -1;
                }
            }
        } else {
            return -2;
        }
    }

    function update($name, $password, $mobile)
    {
        $this->name = $name;
        $this->password = $password;
        $this->mobile = $mobile;
        $user = $_SESSION['user']['email_id'];

        $squery = "UPDATE `tbl_user` SET `name`='$this->name', `mobile`='$this->mobile',`password`='$this->password' WHERE `email_id`='$user'";

        $res = $this->conn->query($squery);

        if ($res == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }

    function updateadmin($name,$password,$mobile){
        $this->name = $name;
        $this->password = $password;
        $this->mobile = $mobile;
        $admin = $_SESSION['admin']['email_id'];

        $squery = "UPDATE `tbl_user` SET `name`='$this->name', `mobile`='$this->mobile',`password`='$this->password' WHERE `email_id`='$admin'";

        $res = $this->conn->query($squery);

        if ($res == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }

    function blockuser($userid)
    {
        $this->userid = $userid;
        $squery = "UPDATE `tbl_user` SET `status`='0' WHERE `status`='1' AND `user_id`='$this->userid'";

        $res = $this->conn->query($squery);

        if ($res == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }

    function unblockuser($userid)
    {
        $this->userid = $userid;
        $squery = "UPDATE `tbl_user` SET `status`='1' WHERE `status`='0' AND `user_id`='$this->userid'";

        $res = $this->conn->query($squery);

        if ($res == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }
}
