<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


    <title>Admin Dashboard</title>
</head>

<body>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            height: 25vh;
            margin-top: 2vh;
        }

        #cont1,
        #cont2,
        #cont3,
        #cont4,
        #cont5,
        #cont6 {
            background-color: burlywood;
            width: 25%;
            height: 25vh;
            margin: 2%;
            border: 1px solid blue;
            text-align: center;
        }

        #foot {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: red;
            color: white;
            text-align: center;
        }

        body {
            background-color: black;
            font-family: 'Cinzel', serif;
        }

        input {
            color: darkgoldenrod;
            background-color: black;
        }

        input:hover {
            background-color: brown;
            color: whitesmoke;
        }

        table {
            margin-bottom: 30vh;
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: burlywood;
            color: black;
        }

        table,
        th,
        td {
            border: 1px solid white;
            color: white;
            text-align: center;
        }

        span {
            font-size: 22px;
        }

        #divcon2 {
            margin-top: 45vh;
            margin-left: 34%;
        }

        #add {
            margin-left: 12%;
            font-size: 20px;
        }

        #up {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
        }

        #update {
            color: darkgoldenrod;
            background-color: black;
        }

        #update:hover {
            background-color: brown;
            color: whitesmoke;
        }

        #addloc,#addDis{
            padding: 5px;
        }
        #addIt{
            margin-left: 20%;
            margin-top: 3vh;
            margin-bottom: 3vh;
        }
    </style>
    <?php
    include_once 'layout/header.php';
    ?>
    <div class="container">

        <div id="cont1">
            <h2>All Pending Rides</h2>
            <span id="pending"></span><br>
            <input type="submit" name="allpending" id="allpending" value="Pending Rides">
        </div>
        <div id="cont2">
            <h2>All Canceled Rides</h2>
            <span id="canceled"></span><br>
            <input type="submit" name="allcanceled" id="allcanceled" value="Canceled Rides">
        </div>
        <div id="cont3">
            <h2>Total Earnings</h2>
            <span id="earningsum"></span><br>
            <input type="submit" name="totalearning" id="totalearning" value="Total Earnings">
        </div>
        <div id="cont4">
            <h2>All Rides</h2>
            <span id="all"></span><br>
            <input type="submit" name="allride" id="allride" value="All Rides">
        </div>
        <div id="cont5">
            <h2>All Users</h2>
            <span id="users"></span><br>
            <input type="submit" name="allusers" id="allusers" value="All Users">
        </div>
        <div id="cont6">
            <h2>Locations</h2>
            <span id="loc"></span><br>
            <input type="submit" name="location" id="location" value="Location">
        </div>
    </div>

    <div id="divcon2">
        <select name="sort" id="sort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>

        <select name="order" id="order">
            <option value="date">By Ride Date</option>
            <option value="fare">By Fare</option>
        </select>

        <input type="submit" name="apply" id="apply" value='Apply'>
        <input type="submit" name="apply" id="apply1" value='Apply' style="display:none;">
        <input type="submit" name="apply" id="apply2" value='Apply' style="display:none;">
        <input type="submit" name="apply" id="apply3" value='Apply' style="display:none;">
        <input type="submit" name="add" id="add" value='Add Location' style="display:none;"><br><br>
        <input type="text" name="Location" id="addloc" placeholder="Add Location" style="display:none;">
        <input type="text" name="Distance" id="addDis" placeholder="Add Distance" style="display:none;">
        <input type="submit" name="addIt" id="addIt" value="Add It"  style="display:none;">
    </div>
    <div id="up" style="display: none;">
        <label for="locationname">Location :</label><br>
        <input type="text" name="locationname" id="locationname" value="" required><br>
        <label for="distance">Distance :</label><br>
        <input type="text" name="distance" id="distance" value="" required><br>
        <label for="available">Available :</label><br>
        <input type="text" name="available" id="available" value="" required>
        <input type="submit" name="updatebtn" id="updatebtn" value="Update">
    </div>
    <table id="tbl">
        <tbody>

        </tbody>
    </table>

    <div class="modal" tabindex="-1" role="dialog" id="modal2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Detail</h2>

                    <button type="button" class="close" data-dismiss="modal" id="close2" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">Hide Details</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once 'layout/footer.php';
    ?>

    <script src="assets/admin.js"></script>

</body>
</html>