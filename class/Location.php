<?php
include_once 'Dbcon.php';

class Location extends Dbcon
{
    public $name;
    public $distance;
    public $available;
    public $arr_location = array();

    function __construct()
    {
        $db = new Dbcon();
        $this->conn = $db->conn;
    }

    function dropdown()
    {

        $sql = "SELECT * FROM `tbl_location`";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->arr_location[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_location;
    }

    function showLoc()
    {
        $sql = "SELECT * FROM `tbl_location`";
        $result = $this->conn->query($sql);
        $res = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $res[] = $row;
            }
            return $res;
        } else {
            return 0;
        }
    }

    function deleteloc($locid)
    {
        $this->locid = $locid;
        $squery = "UPDATE `tbl_location` SET `is_available`='0' WHERE `id`='$this->locid' AND `is_available`='1'";
        $result = $this->conn->query(($squery));

        if ($result == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }
    function updateloc($locid)
    {
        $this->locid = $locid;
        $_SESSION['id'] = $this->locid;
        // echo $_SESSION['id'];
        $squery = "SELECT * FROM `tbl_location` WHERE `id`='$this->locid'";
        $result = $this->conn->query($squery);
        $res = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $res[] = $row;
            }
            return $res;
        } else {
            return 0;
        }
    }
    function updateLocation($loc, $dis, $avail)
    {
        $this->loc = $loc;
        $this->dis = $dis;
        $this->avail = $avail;
        $id = $_SESSION['id'];

        $sql = "UPDATE `tbl_location` SET `name`='$this->loc', `distance`='$this->dis', `is_available`='$this->avail' WHERE `id`='$id'";

        $result = $this->conn->query($sql);

        if ($result == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }

    function Locationlength()
    {
        $squery = "SELECT * FROM `tbl_location`";
        $result = $this->conn->query($squery);
        $res = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $res[] = $row;
            }
            return $res;
        } else {
            return 0;
        }
    }

    function addLoc($loc,$dis){
        $sql="INSERT INTO `tbl_location` (`name`,`distance`,`is_available`) VALUES('$loc','$dis','1')";
        $result = $this->conn->query($sql);

        if($result==TRUE){
            return 1;
        }
        else{
            return 0;
        }
    }
}
