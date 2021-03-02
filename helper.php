<?php
include_once './class/User.php';
include_once './class/Location.php';
include_once './class/Ride.php';

$action = $_POST['action'];


switch ($action) {
    case ('signup'):

        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];

        $filename = $_FILES['fileupload']['name'];
        $filetype = $_FILES['fileupload']['type'];
        $filetmp_name = $_FILES['fileupload']['tmp_name'];
        $fileerror = $_FILES['fileupload']['error'];
        $filesize = $_FILES['fileupload']['size'];

        $ext = pathinfo($filename);
        $valid_ext = array('jpg', 'jpeg', 'png');
        if (in_array($ext['extension'], $valid_ext)) {
            $new_file_name = rand() . "." . $ext['extension'];
            $path = "uploads/" . $new_file_name;
            if (move_uploaded_file($filetmp_name, $path)) {
                $cls = new User();
                $status = $cls->signup($name, $email, $mobile, $password, $path);
                echo ($status);
                // json_encode(array("status" =>
            } else {
                echo 0;
            }
        }
        break;
    case ('login'):
        $user_email = $_POST['uname'];
        $pass = $_POST['pass'];
        $User = new User();
        $conn1 = $User->login($user_email, $pass);
        echo trim($conn1);
        break;

    case ('checkdropdown'):
        $cls = new Location();
        $loc = $cls->dropdown();
        echo json_encode($loc);
        break;

    case ('FareCal'):
        $pick = $_POST['pick'];
        $drop = $_POST['drop'];
        $cab = $_POST['cab'];
        $luggage = $_POST['luggage'];
        $pickLoc = $_POST['pickLoc'];
        $dropLoc = $_POST['dropLoc'];

        $cls = new Ride();
        $loc = $cls->FareCal($pick, $drop, $cab, $luggage, $pickLoc, $dropLoc);

        echo json_encode($loc);
        break;

    case 'showFare':
        $from = $_POST['pick'];
        $to = $_POST['drop'];
        $fare = $_POST['fare'];
        $distance = $_POST['distance'];
        $luggage = $_POST['luggage'];
        $cab = $_POST['cab'];

        $ride = new Ride();
        $data = $ride->showFareCal($from, $to, $fare, $distance, $luggage, $cab);
        echo $data;
        break;

    case 'location':
        $loc = new Location();
        $res = $loc->showLoc();
        echo json_encode($res);
        // echo 1;
        break;


    case 'pending':
        $ridedata = new Ride();
        $res = $ridedata->showData();
        echo json_encode($res);
        // print_r($res);
        break;

    case 'cancel':
        $dataride = new Ride();
        $res1 = $dataride->showData1();
        echo json_encode($res1);
        // print_r($res);
        break;

    case 'exp':
        $dataride = new Ride();
        $res1 = $dataride->showData2();
        echo json_encode($res1);
        // print_r($res);
        break;

    case 'all':
        $dataride = new Ride();
        $res1 = $dataride->showData3();
        echo json_encode($res1);
        // print_r($res);
        break;

    case 'cancelRide':
        $rideid = $_POST['ride'];
        $cancelRide = new Ride();
        $response = $cancelRide->cancelRide($rideid);
        echo json_encode($response);
        break;

    case 'detailed':

        $ride = $_POST['rideid'];
        $detail = new Ride();
        $res = $detail->Detail($ride);
        echo json_encode($res);
        break;

    case 'showSum':
        $showSum = new Ride();
        $response = $showSum->Sum();
        echo json_encode($response);
        break;

    case 'unsetSession':
        $unset = new Ride();
        $res = $unset->unsetSession();
        echo $res;
        break;

    case 'update':
        $name = $_POST['name'];
        $password = $_POST['password'];
        $mobile = $_POST['mobile'];

        $update = new User();
        $res = $update->update($name, $password, $mobile);
        echo $res;
        break;

    case 'updateadmin':
        $name = $_POST['name'];
        $password = $_POST['password'];
        $mobile = $_POST['mobile'];

        $update = new User();
        $res = $update->updateadmin($name, $password, $mobile);
        echo $res;
        break;

    case 'allpending':
        $ridedata = new Ride();
        $res = $ridedata->allpending();
        echo json_encode($res);
        // print_r($res);
        break;

    case 'allcanceled':
        $dataride = new Ride();
        $res1 = $dataride->allcanceled();
        echo json_encode($res1);
        // print_r($res);
        break;

    case 'totalearning':
        $dataride = new Ride();
        $res1 = $dataride->totalearning();
        echo json_encode($res1);
        // print_r($res);
        break;

    case 'allride':
        $dataride = new Ride();
        $res1 = $dataride->allride();
        echo json_encode($res1);
        // print_r($res);
        break;

    case 'allusers':
        $dataride = new Ride();
        $res1 = $dataride->allusers();
        echo json_encode($res1);
        // print_r($res);
        break;

    case 'earningsum':
        $showSum = new Ride();
        $response = $showSum->earningsum();
        echo json_encode($response);
        break;

    case 'acceptride':
        $rideid = $_POST['rideid'];
        $accept = new Ride();
        $response = $accept->acceptride($rideid);
        echo $response;
        break;

    case 'rejectride':
        $rideid = $_POST['rideid'];
        $reject = new Ride();
        $response = $reject->rejectride($rideid);
        echo $response;
        break;

    case 'detailedinfo':
        $ride = $_POST['rideid'];
        $detail = new Ride();
        $res = $detail->Detailinfo($ride);
        echo json_encode($res);
        break;

    case 'block':
        $userid = $_POST['user'];
        $block = new User();
        $response = $block->blockuser($userid);
        echo $response;
        break;
    case 'unblock':
        $userid = $_POST['user'];
        $unblock = new User();
        $response = $unblock->unblockuser($userid);
        echo $response;
        break;

    case 'ordering':
        $orderby = $_POST['ordering'];
        $sort = $_POST['sort'];
        $ordering = new Ride();
        $response = $ordering->orderfun($orderby, $sort);
        echo json_encode($response);
        // echo $response;
        break;

    case 'ordering1':
        $orderby = $_POST['ordering'];
        $sort = $_POST['sort'];
        $ordering = new Ride();
        $response = $ordering->orderfun1($orderby, $sort);
        echo json_encode($response);
        // echo $response;
        break;

    case 'ordering2':
        $orderby = $_POST['ordering'];
        $sort = $_POST['sort'];
        $ordering = new Ride();
        $response = $ordering->orderfun2($orderby, $sort);
        echo json_encode($response);
        // echo $response;
        break;

    case 'ordering3':
        $orderby = $_POST['ordering'];
        $sort = $_POST['sort'];
        $ordering = new Ride();
        $response = $ordering->orderfun3($orderby, $sort);
        echo json_encode($response);
        // echo $response;
        break;

    case 'admin_ordering':
        $orderby = $_POST['admin_ordering'];
        $sort = $_POST['sort'];
        $ordering = new Ride();
        $response = $ordering->adminorderfun($orderby, $sort);
        echo json_encode($response);
        // echo $response;
        break;
    case 'admin_ordering1':
        $orderby = $_POST['admin_ordering'];
        $sort = $_POST['sort'];
        $ordering = new Ride();
        $response = $ordering->adminorderfun1($orderby, $sort);
        echo json_encode($response);
        // echo $response;
        break;
    case 'admin_ordering2':
        $orderby = $_POST['admin_ordering'];
        $sort = $_POST['sort'];
        $ordering = new Ride();
        $response = $ordering->adminorderfun2($orderby, $sort);
        echo json_encode($response);
        // echo $response;
        break;
    case 'admin_ordering3':
        $orderby = $_POST['admin_ordering'];
        $sort = $_POST['sort'];
        $ordering = new Ride();
        $response = $ordering->adminorderfun3($orderby, $sort);
        echo json_encode($response);
        // echo $response;
        break;

    case 'deleteloc':
        $locid = $_POST['locid'];
        $del = new Location();
        $delete = $del->deleteloc($locid);
        echo $delete;
        break;

    case 'updateloc':
        $locid = $_POST['locid'];
        $up = new Location();
        $update = $up->updateLoc($locid);
        echo json_encode($update);
        break;

    case 'Updation':
        $loc = $_POST['loc'];
        $dis = $_POST['dis'];
        $avail = $_POST['avail'];
        $up = new Location();
        $update = $up->updateLocation($loc, $dis, $avail);
        echo $update;
        break;

    case 'loclength':
        $up = new Location();
        $update = $up->Locationlength();
        echo json_encode($update);
        break;

        case 'addLoc':
            $loc=$_POST['loc'];
            $dis=$_POST['dis'];
            $up = new Location();
            $update = $up->addLoc($loc,$dis);
            echo json_encode($update);
            break;
}
