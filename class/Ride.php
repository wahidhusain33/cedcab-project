
<?php

include_once 'Dbcon.php';

class Ride extends Dbcon
{
    public $ride_date;
    public $pick;
    public $drop;
    public $total_distance;
    public $luggage;
    public $total_fare;
    public $status;
    public $customer_user_id;
    public $cab_type;

    function __construct()
    {
        $db = new Dbcon();
        $this->conn = $db->conn;
    }

    function FareCal($pick, $drop, $cab, $luggage = 0, $pickLoc, $dropLoc)
    {
        $distance = abs($pick - $drop);
        $fare = 0;
        switch ($cab) {
            case 'CedMicro':

                if ($distance <= 10) {
                    $fare = ($distance * 13.50) + 50;
                } else if ($distance <= 60 && $distance > 10) {
                    $fare = 135 + 50 + (($distance - 10) * 12);
                } else if ($distance <= 160 && $distance > 60) {
                    $fare = 135 + 50 + 600 + (($distance - 60) * 10.2);
                } else {
                    $fare = 135 + 50 + 600 + 1020 + (($distance - 160) * 8.50);
                }

                break;

            case 'CedMini':

                if ($distance > 0 && $distance <= 10) {
                    $fare = $distance * 14.50;
                } else if ($distance > 10 && $distance <= 60) {
                    $temp1 = 10 * 14.50;
                    $fare = (($distance - 10) * 13.00) + $temp1;
                } else if ($distance <= 160 && $distance > 60) {
                    $temp1 = 10 * 14.50;
                    $temp2 = 50 * 13.00;
                    $fare = (($distance - 60) * 11.20) + ($temp1 + $temp2);
                } else {
                    $temp1 = 10 * 14.50;
                    $temp2 = 50 * 13.00;
                    $temp3 = 100 * 11.20;
                    $fare = (($distance - 160) * 9.50) + ($temp1 + $temp2 + $temp3);
                }
                if ($luggage == 0) {
                    $fare += 0;
                } else if ($luggage > 0 && $luggage <= 10) {
                    $fare += 50;
                } else if ($luggage > 10 && $luggage <= 20) {
                    $fare += 100;
                } else {
                    $fare += 200;
                }

                $fare += 150;

                break;

            case "CedRoyal":

                if ($distance > 0 && $distance <= 10) {
                    $fare = $distance * 15.50;
                } else if ($distance > 10 && $distance <= 60) {
                    $temp1 = 10 * 15.50;
                    $fare = (($distance - 10) * 14.00) + $temp1;
                } else if ($distance <= 160 && $distance > 60) {
                    $temp1 = 10 * 15.50;
                    $temp2 = 50 * 14.00;
                    $fare = (($distance - 60) * 12.20) + ($temp1 + $temp2);
                } else {
                    $temp1 = 10 * 15.50;
                    $temp2 = 50 * 14.00;
                    $temp3 = 100 * 12.20;
                    $fare = (($distance - 160) * 10.50) + ($temp1 + $temp2 + $temp3);
                }

                if ($luggage == 0) {
                    $fare += 0;
                } else if ($luggage > 0 && $luggage <= 10) {
                    $fare += 50;
                } else if ($luggage > 10 && $luggage <= 20) {
                    $fare += 100;
                } else {
                    $fare += 200;
                }

                $fare += 200;
                break;

            case 'CedSUV':

                if ($distance > 0 && $distance <= 10) {
                    $fare = $distance * 16.50;
                } else if ($distance > 10 && $distance <= 60) {
                    $temp1 = 10 * 16.50;
                    $fare = (($distance - 10) * 15.00) + $temp1;
                } else if ($distance <= 160 && $distance > 60) {
                    $temp1 = 10 * 16.50;
                    $temp2 = 50 * 15.00;
                    $fare = (($distance - 60) * 13.20) + ($temp1 + $temp2);
                } else {
                    $temp1 = 10 * 16.50;
                    $temp2 = 50 * 15.00;
                    $temp3 = 100 * 13.20;
                    $fare = (($distance - 160) * 11.50) + ($temp1 + $temp2 + $temp3);
                }

                if ($luggage == 0) {
                    $fare += 0;
                } else if ($luggage > 0 && $luggage <= 10) {
                    $fare += 100;
                } else if ($luggage > 10 && $luggage <= 20) {
                    $fare += 200;
                } else {
                    $fare += 400;
                }

                $fare += 250;

                break;
        }
        $_SESSION['loc']['pick'] = $pick;
        $_SESSION['loc']['drop'] = $drop;
        $_SESSION['loc']['fare'] = $fare;
        $_SESSION['loc']['distance'] = $distance;
        $_SESSION['loc']['luggage'] = $luggage;
        $_SESSION['loc']['pickLoc'] = $pickLoc;
        $_SESSION['loc']['dropLoc'] = $dropLoc;
        $_SESSION['loc']['cab'] = $cab;


        $arr = [$pick, $drop, $distance, $fare, $luggage, $cab];

        return $arr;
    }
    function showFareCal($from, $to, $fare, $distance, $luggage, $cabtype)
    {

        if ($_SESSION['loc']['distance']) {
            $from = $_SESSION['loc']['pickLoc'];
            $to = $_SESSION['loc']['dropLoc'];
            $distance = $_SESSION['loc']['distance'];
            $luggage = $_SESSION['loc']['luggage'];
            $fare = $_SESSION['loc']['fare'];
            $customer_user_id = $_SESSION['user']['user_id'];
            $cabtype = $_SESSION['loc']['cab'];


            $squery = "INSERT INTO `tbl_ride`(`ride_date`,`from`,`to`,`total_distance`,`luggage`,`total_fare`,`status`,`customer_user_id`,`cab_type`) VALUES(now(),'$from','$to','$distance','$luggage','$fare','1','$customer_user_id','$cabtype')";

            $data = $this->conn->query($squery);
            if ($data == TRUE) {
                unset($_SESSION['loc']);
                return 1;
            } else {
                return 0;
            }
        }
    }

    function unsetSession()
    {
        unset($_SESSION['loc']);
        return 1;
    }

    function showData()
    {
        $res = array();
        if ($_SESSION['user']['user_id']) {
            $cus = $_SESSION['user']['user_id'];
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride` WHERE `customer_user_id`='$cus' AND `status`='1'";
            $result = $this->conn->query($sql);
            //    print_r($result);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }


                return $res;
            } else {
                return 0;
            }
        }
    }
    function showData1()
    {
        $res1 = array();
        if ($_SESSION['user']['user_id']) {
            $cus1 = $_SESSION['user']['user_id'];
            $sql1 = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride` WHERE `customer_user_id`='$cus1' AND `status`='0'";
            $result1 = $this->conn->query($sql1);
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $res1[] = $row1;
                }
                return $res1;
            } else {
                return 0;
            }
        }
    }

    function showData2()
    {
        $res2 = array();
        if ($_SESSION['user']['user_id']) {
            $cus2 = $_SESSION['user']['user_id'];
            $sql2 = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride` WHERE `customer_user_id`='$cus2' AND `status`='2'";

            $result2 = $this->conn->query($sql2);
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $res2[] = $row2;
                }
                return $res2;
            } else {
                return 0;
            }
        }
    }

    function showData3()
    {
        $res2 = array();
        if ($_SESSION['user']['user_id']) {
            $cus2 = $_SESSION['user']['user_id'];
            $sql2 = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride` WHERE `customer_user_id`='$cus2'";
            $result2 = $this->conn->query($sql2);
            // print_r($result2);

            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $res2[] = $row2;
                }
                return $res2;
            } else {
                return 0;
            }
        }
    }

    function cancelRide($ride)
    {

        $cus2 = $_SESSION['user']['user_id'];
        $sqli = "UPDATE `tbl_ride` SET `status`='0' WHERE `customer_user_id`='$cus2' AND `ride_id`='$ride'";
        $result = $this->conn->query($sqli);
        if ($result == true) {
            return $ride;
        } else {
            return 0;
        }
    }

    function Detail($ride_id)
    {
        $res = array();
        if ($_SESSION['user']['user_id']) {
            $squery = "SELECT * FROM `tbl_ride` WHERE `ride_id`='$ride_id'";
            $result = $this->conn->query($squery);

            if ($result->num_rows > 0) {
                while ($row2 = $result->fetch_assoc()) {
                    $res[] = $row2;
                }
                return $res;
            } else {
                return 0;
            }
        }
    }

    function Sum()
    {
        $cus2 = $_SESSION['user']['user_id'];
        $sum = "SELECT SUM(`total_fare`) AS `totalFare` FROM `tbl_ride` WHERE `customer_user_id`='$cus2' AND `status`='2'";
        $result = $this->conn->query($sum);
        $total_sum = $result->fetch_assoc();
        if ($result == true) {
            return $total_sum;
        } else {
            return 0;
        }
    }

    function allpending()
    {
        $res = array();
        $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride` WHERE `status`='1'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $res[] = $row;
            }


            return $res;
        } else {
            return 0;
        }
    }

    function allcanceled()
    {
        $res = array();
        $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride` WHERE `status`='0'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $res[] = $row;
            }


            return $res;
        } else {
            return 0;
        }
    }

    function totalearning()
    {
        $res = array();
        $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride` WHERE `status`='2'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $res[] = $row;
            }


            return $res;
        } else {
            return 0;
        }
    }

    function allride()
    {
        $res = array();
        $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $res[] = $row;
            }


            return $res;
        } else {
            return 0;
        }
    }

    function allusers()
    {
        $res = array();
        $sql = "SELECT * FROM `tbl_user` WHERE `is_admin`<>'1'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $res[] = $row;
            }
            return $res;
        } else {
            return 0;
        }
    }

    function earningsum()
    {

        $sum = "SELECT SUM(`total_fare`) AS `totalFare` FROM `tbl_ride` WHERE `status`='2'";
        $result = $this->conn->query($sum);
        $total_sum = $result->fetch_assoc();
        if ($result == true) {
            return $total_sum;
        } else {
            return 0;
        }
    }

    function acceptride($rideid)
    {
        $this->rideid = $rideid;

        $sqlquery = "UPDATE `tbl_ride` SET `status`='2' WHERE `status`='1' AND `ride_id`='$this->rideid'";

        $res = $this->conn->query($sqlquery);
        if ($res == true) {
            return 1;
        } else {
            return 0;
        }
    }

    function rejectride($rideid)
    {
        $this->rideid = $rideid;

        $sqlquery = "UPDATE `tbl_ride` SET `status`='0' WHERE `status`='1' AND `ride_id`='$this->rideid'";

        $res = $this->conn->query($sqlquery);
        if ($res == true) {
            return 1;
        } else {
            return 0;
        }
    }

    function Detailinfo($rideinfo)
    {
        $this->rideinfo = $rideinfo;
        $res = array();
        $squery = "SELECT * FROM `tbl_ride` WHERE `ride_id`='$this->rideinfo'";
        $result = $this->conn->query($squery);

        if ($result->num_rows > 0) {
            while ($row2 = $result->fetch_assoc()) {
                $res[] = $row2;
            }
            return $res;
        } else {
            return 0;
        }
    }
    function orderfun($sortval, $sort)
    {
        $this->sortval = $sortval;
        $this->sort = $sort;

        $res = array();

        $cus = $_SESSION['user']['user_id'];


        if ($this->sortval == 'date' && $this->sort == 'asc') {



            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `customer_user_id`='$cus' AND `status`='1' ORDER BY `ride_date` ASC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->sortval == 'date' && $this->sort == 'desc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `customer_user_id`='$cus' AND `status`='1' ORDER BY `ride_date` DESC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->sortval == 'fare' && $this->sort == 'asc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `customer_user_id`='$cus' AND `status`='1' ORDER BY `total_fare` ASC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `customer_user_id`='$cus' AND `status`='1' ORDER BY `total_fare` DESC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        }
    }

    function orderfun1($sortval, $sort)
    {
        $this->sortval = $sortval;
        $this->sort = $sort;
        $res = array();

        $cus = $_SESSION['user']['user_id'];

        if ($this->sortval == 'date' && $this->sort == 'asc') {

            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `customer_user_id`='$cus' AND `status`='0' ORDER BY `ride_date` ASC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
            // }
        } else if ($this->sortval == 'date' && $this->sort == 'desc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `customer_user_id`='$cus' AND `status`='0' ORDER BY `ride_date` DESC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->sortval == 'fare' && $this->sort == 'asc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `customer_user_id`='$cus' AND `status`='0' ORDER BY `total_fare` ASC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `customer_user_id`='$cus' AND `status`='0' ORDER BY `total_fare` DESC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        }
    }

    function orderfun2($sortval, $sort)
    {
        $this->sortval = $sortval;
        $this->sort = $sort;
        $res = array();

        $cus = $_SESSION['user']['user_id'];

        if ($this->sortval == 'date' && $this->sort == 'asc') {

            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `customer_user_id`='$cus' AND `status`='2' ORDER BY `ride_date` ASC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
            // }
        } else if ($this->sortval == 'date' && $this->sort == 'desc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `customer_user_id`='$cus' AND `status`='2' ORDER BY `ride_date` DESC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->sortval == 'fare' && $this->sort == 'asc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `customer_user_id`='$cus' AND `status`='2' ORDER BY `total_fare` ASC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `customer_user_id`='$cus' AND `status`='2' ORDER BY `total_fare` DESC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        }
    }

    function orderfun3($sortval, $sort)
    {
        $this->sortval = $sortval;
        $this->sort = $sort;
        $res = array();

        $cus = $_SESSION['user']['user_id'];

        if ($this->sortval == 'date' && $this->sort == 'asc') {

            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `customer_user_id`='$cus' ORDER BY `ride_date` ASC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->sortval == 'date' && $this->sort == 'desc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `customer_user_id`='$cus' ORDER BY `ride_date` DESC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->sortval == 'fare' && $this->sort == 'asc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `customer_user_id`='$cus' ORDER BY `total_fare` ASC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `customer_user_id`='$cus' ORDER BY `total_fare` DESC";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        }
    }

    function adminorderfun($orderby, $sort)
    {
        $this->orderby = $orderby;
        $this->sort = $sort;

        $res = array();

        if ($this->orderby == 'date' && $this->sort == 'asc') {

            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `status`='1' ORDER BY `ride_date` ASC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->orderby == 'date' && $this->sort == 'desc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `status`='1' ORDER BY `ride_date` DESC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->orderby == 'fare' && $this->sort == 'asc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `status`='1' ORDER BY `total_fare` ASC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `status`='1' ORDER BY `total_fare` DESC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        }
    }

    function adminorderfun1($orderby, $sort)
    {
        $this->orderby = $orderby;
        $this->sort = $sort;

        $res = array();

        if ($this->orderby == 'date' && $this->sort == 'asc') {

            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `status`='0' ORDER BY `ride_date` ASC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->orderby == 'date' && $this->sort == 'desc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `status`='0' ORDER BY `ride_date` DESC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->orderby == 'fare' && $this->sort == 'asc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `status`='0' ORDER BY `total_fare` ASC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `status`='0' ORDER BY `total_fare` DESC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        }
    }

    function adminorderfun2($orderby, $sort)
    {
        $this->orderby = $orderby;
        $this->sort = $sort;

        $res = array();

        if ($this->orderby == 'date' && $this->sort == 'asc') {

            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `status`='2' ORDER BY `ride_date` ASC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->orderby == 'date' && $this->sort == 'desc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
                WHERE `status`='2' ORDER BY `ride_date` DESC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->orderby == 'fare' && $this->sort == 'asc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `status`='2' ORDER BY `total_fare` ASC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            WHERE `status`='2' ORDER BY `total_fare` DESC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        }
    }

    function adminorderfun3($orderby, $sort)
    {
        $this->orderby = $orderby;
        $this->sort = $sort;
        $res = array();

        if ($this->orderby == 'date' && $this->sort == 'asc') {

            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            ORDER BY `ride_date` ASC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->orderby == 'date' && $this->sort == 'desc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            ORDER BY `ride_date` DESC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else if ($this->orderby == 'fare' && $this->sort == 'asc') {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            ORDER BY `total_fare` ASC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        } else {
            $sql = "SELECT `ride_id`,`from`,`to`,`cab_type`,`total_fare`,`luggage` FROM `tbl_ride`
            ORDER BY `total_fare` DESC";
            $result = $this->conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }

                return $res;
            } else {
                return 0;
            }
        }
    }
}

?>