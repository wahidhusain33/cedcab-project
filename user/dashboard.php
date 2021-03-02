<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <style>
    body {
      background-color: black;
      font-family: 'Cinzel', serif;
    }

    .container {
      display: flex;
      width: 100%;
      height: 40vh;
      margin-top: 5vh;
    }

    #cont1,
    #cont2,
    #cont3,
    #cont4 {
      background-color: burlywood;
      width: 30%;
      height: 35vh;
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

    input {
      color: darkgoldenrod;
      background-color: black;
      margin-top: 3vh;
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

    #sort {
      margin-left: 70%;
    }
    select{
      background-color: burlywood;
    }
  </style>
</head>

<body>
  <?php include_once 'layout/header.php' ?>

  <div class="container">
    <div id="cont2">
      <h2>Pending Rides</h2>
      <span id="pendingride"></span><br>
      <input type="submit" name="pending" id="pending" value="Pending_Rides">
    </div>
    <div id="cont3">
      <h2>Canceled Rides</h2>
      <span id="canceledride"></span><br>
      <input type="submit" name="cancel" id="cancel" value="Canceled_Rides">
    </div>
    <div id="cont3">
      <h2>Total Expenses</h2>
      <span id="expense"></span><br>
      <input type="submit" name="exp" id="exp" value="Total_Expenses">
    </div>
    <div id="cont4">
      <h2>All Rides</h2>
      <span id="allride"></span><br>
      <input type="submit" name="all" id="all" value="All_Rides">
    </div>
  </div>
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

  <table id="tbl">
    <tr>
      <th>Ride_id</th>
      <th>Pickup Location</th>
      <th>Drop Location</th>
      <th>CabType</th>
      <th>Fare</th>
      <th>Luggage</th>
      <th>Action</th>
    </tr>
    <tbody>

    </tbody>
  </table>
  <?php include_once 'layout/footer.php' ?>

  <?php if (isset($_SESSION['loc']['pickLoc'])) { ?>
    <div class="modal" tabindex="-1" role="dialog" id="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title">Booking Detail</h2>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <h2>Pickup Location :<span id="pick"><?php echo $_SESSION['loc']['pickLoc']; ?></span></h2><br>
            <h2>Drop Location: <span id="drop"><?php echo $_SESSION['loc']['dropLoc']; ?></span></h2><br>
            <h2>Cab Type : <span id="cab"><?php echo $_SESSION['loc']['cab']; ?></span></h2><br>
            <h2>Total Fare : <span id="fare"><?php echo $_SESSION['loc']['fare'] . ' Rs'; ?></span></h2><br>
            <h2>Distance : <span id="distance"><?php echo $_SESSION['loc']['distance'] . 'Km'; ?></span></h2><br>
            <h2>Luggage : <span id="luggage"><?php echo $_SESSION['loc']['luggage'] . ' Kg'; ?></span></h2><br>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="book">Book a Ride</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>


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
          <!-- <button type="button" class="btn btn-primary" id="book">Book a Ride</button> -->
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeIt">Hide Detail</button>
        </div>
      </div>
    </div>
  </div>

</body>

<script>
  $(document).ready(function() {
    $("#modal").modal('show');

    $("#close").on("click", function() {
      $("#modal").modal('hide');

      $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
          'action': 'unsetSession'
        },
        success: function(response) {
          console.log(response);
        }

      });
    });

    $("#closeIt").on("click", function() {
      $("#modal2").css('display', 'none');
    });

    $("#book").on("click", e => {
      let pick = $("#pick").text();
      let drop = $("#drop").text();
      let fare = $("#fare").text();
      let distance = $("#distance").text();
      let luggage = $("#luggage").text();
      let cab = $("#cab").text();

      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
          pick: pick,
          drop: drop,
          fare: fare,
          distance: distance,
          luggage: luggage,
          cab: cab,
          'action': 'showFare'
        },
        success: function(res) {
          // console.log(res);
          $("#modal").modal('hide');
          alert('Ride booked successfully!!!');
          location.reload();
        }
      });
    });

    //Pending Rides onload

    $.ajax({
      type: 'POST',
      url: '../helper.php',
      data: {
        'action': 'pending'
      },
      success: function(res) {
        let response = JSON.parse(res);
        console.log(response);
        let pending = response.length;
        if(pending>0){
        $("#pendingride").text("Pending Rides : " + pending);
        }
        else{
          $("#pendingride").text("Pending Rides : " + 0);
        }
        for (let i = 0; i < response.length; i++) {
          let row = $('<tr></tr>');
          let td1 = $('<td></td>').text(response[i]['ride_id']);
          let td2 = $('<td></td>').text(response[i]['from']);
          let td3 = $('<td></td>').text(response[i]['to']);
          let td4 = $('<td></td>').text(response[i]['cab_type']);
          let td5 = $('<td></td>').text(response[i]['total_fare']);
          let td6 = $('<td></td>').text(response[i]['luggage']);
          let td7 = $('<td></td>').append("<input type='submit' onclick='canceled(" + response[i]['ride_id'] + ")' value='Cancel'><input type='submit' onclick='detail(" + response[i]['ride_id'] + ")' value='View Details'>");


          row.append(td1, td2, td3, td4, td5, td6, td7);
          $('#tbl').append(row);

        }

      }

    });

    $.ajax({
      type: 'POST',
      url: '../helper.php',
      data: {
        'action': 'cancel'
      },
      success: function(res) {
        let response = JSON.parse(res);
        console.log(response);
        let cancel = response.length;
        if(cancel>0){
        $("#canceledride").text("Cancel Rides : " + cancel);
        }
        else{
          $("#canceledride").text("Cancel Rides : " + 0);
        }
      }
    });

    //Pending Rides on click

    $("#pending").on("click", () => {
      $("td").css('display', 'none');
      $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
          'action': 'pending'
        },
        success: function(res) {
          let response = JSON.parse(res);
          let pending = response.length;
          console.log(response);
          $("#pendingride").text("Pending Rides : " + pending);

          for (let i = 0; i < response.length; i++) {

            let row = $('<tr></tr>');
            let td1 = $('<td></td>').text(response[i]['ride_id']);
            let td2 = $('<td></td>').text(response[i]['from']);
            let td3 = $('<td></td>').text(response[i]['to']);
            let td4 = $('<td></td>').text(response[i]['cab_type']);
            let td5 = $('<td></td>').text(response[i]['total_fare']);
            let td6 = $('<td></td>').text(response[i]['luggage']);
            let td7 = $('<td></td>').append("<input type='submit' onclick='canceled(" + response[i]['ride_id'] + ")' value='Cancel'><input type='submit' onclick='detail(" + response[i]['ride_id'] + ")' value='View Details'>");

            row.append(td1, td2, td3, td4, td5, td6, td7);
            $('#tbl').append(row);

          }

        }

      });
    });

    //CANCEL RIDES

    $("#cancel").on("click", function() {
      $("td").css('display', 'none');
      $("#apply").css('display', 'none');
      $("#apply2").css('display', 'none');
      $("#apply3").css('display', 'none');
      $("#apply1").css('display', 'inline');

      $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
          'action': 'cancel'
        },
        success: function(res) {
          let response = JSON.parse(res);
          console.log(response);
          let cancel = response.length;
          $("#canceledride").text("Cancel Rides : " + cancel);

          for (let i = 0; i < response.length; i++) {
            let row = $('<tr></tr>');
            let td1 = $('<td></td>').text(response[i]['ride_id']);
            let td2 = $('<td></td>').text(response[i]['from']);
            let td3 = $('<td></td>').text(response[i]['to']);
            let td4 = $('<td></td>').text(response[i]['cab_type']);
            let td5 = $('<td></td>').text(response[i]['total_fare']);
            let td6 = $('<td></td>').text(response[i]['luggage']);
            let td7 = $('<td></td>').append("<input type='submit' onclick='detail(" + response[i]['ride_id'] + ")' value='View Details'>");


            row.append(td1, td2, td3, td4, td5, td6, td7);
            $('#tbl').append(row);

          }

        }

      });

    });

    //Total Expenses and completed rides
    $.ajax({

      type: 'POST',
      url: '../helper.php',
      data: {
        action: 'showSum'
      },
      success: function(res) {
        var total = JSON.parse(res);
        let fare = total.totalFare;
        if(fare>0){
        $("#expense").text("Total Expenses : " + fare + " Rs");
        }
        else{
          $("#expense").text("Total Expenses : " + 0 + " Rs");
        }
      }

    });




    $("#exp").on("click", function() {
      $("td").css('display', 'none');
      $("#apply").css('display', 'none');
      $("#apply1").css('display', 'none');
      $("#apply3").css('display', 'none');
      $("#apply2").css('display', 'inline');
      $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
          'action': 'exp'
        },
        success: function(res) {
          let response = JSON.parse(res);
          // console.log(response);

          for (let i = 0; i < response.length; i++) {
            let row = $('<tr></tr>');
            let td1 = $('<td></td>').text(response[i]['ride_id']);
            let td2 = $('<td></td>').text(response[i]['from']);
            let td3 = $('<td></td>').text(response[i]['to']);
            let td4 = $('<td></td>').text(response[i]['cab_type']);
            let td5 = $('<td></td>').text(response[i]['total_fare']);
            let td6 = $('<td></td>').text(response[i]['luggage']);
            let td7 = $('<td></td>').append("<input type='submit' onclick='detail(" + response[i]['ride_id'] + ")' value='View Details'>");


            row.append(td1, td2, td3, td4, td5, td6, td7);
            $('#tbl').append(row);

          }

        }

      });

    });

    $.ajax({
      type: 'POST',
      url: '../helper.php',
      data: {
        'action': 'all'
      },
      success: function(res) {
        let response = JSON.parse(res);
        console.log(response);
        let all = response.length;
        console.log(response);
        if(all>0){
        $("#allride").text("All Rides : " + all);
        }
        else{
          $("#allride").text("All Rides : " + 0);
        }
      }
    });


    $("#all").on("click", function() {
      $("td").css('display', 'none');
      $("#apply").css('display', 'none');
      $("#apply1").css('display', 'none');
      $("#apply2").css('display', 'none');
      $("#apply3").css('display', 'inline');
      $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
          'action': 'all'
        },
        success: function(res) {
          let response = JSON.parse(res);
          console.log(response);
          let all = response.length;
          console.log(response);
          $("#allride").text("All Rides : " + all);

          for (let i = 0; i < response.length; i++) {
            let row = $('<tr></tr>');
            let td1 = $('<td></td>').text(response[i]['ride_id']);
            let td2 = $('<td></td>').text(response[i]['from']);
            let td3 = $('<td></td>').text(response[i]['to']);
            let td4 = $('<td></td>').text(response[i]['cab_type']);
            let td5 = $('<td></td>').text(response[i]['total_fare']);
            let td6 = $('<td></td>').text(response[i]['luggage']);
            let td7 = $('<td></td>').append("<input type='submit' onclick='detail(" + response[i]['ride_id'] + ")' value='View Details'>");


            row.append(td1, td2, td3, td4, td5, td6, td7);
            $('#tbl').append(row);

          }

        }

      });

    });

    $("#apply").on('click', function() {
      let ordering = $("#order").val();
      let sort = $("#sort").val();
      $("td").css('display', 'none');
      $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
          ordering: ordering,
          sort: sort,
          'action': 'ordering'
        },
        success: function(res) {
          let ord = JSON.parse(res);
          console.log(ord);
          // console.log(res);

          for (let i = 0; i < ord.length; i++) {
            let row = $('<tr></tr>');
            let td1 = $('<td></td>').text(ord[i]['ride_id']);
            let td2 = $('<td></td>').text(ord[i]['from']);
            let td3 = $('<td></td>').text(ord[i]['to']);
            let td4 = $('<td></td>').text(ord[i]['cab_type']);
            let td5 = $('<td></td>').text(ord[i]['total_fare']);
            let td6 = $('<td></td>').text(ord[i]['luggage']);
            let td7 = $('<td></td>').append("<input type='submit' onclick='canceled(" + ord[i]['ride_id'] + ")' value='Cancel'><input type='submit' onclick='detail(" + ord[i]['ride_id'] + ")' value='View Details'>");


            row.append(td1, td2, td3, td4, td5, td6, td7);
            $('#tbl').append(row);
          }
        }
      });
    });

    $("#apply1").on('click', function() {
      $("td").css('display', 'none');

      let ordering = $("#order").val();
      let sort = $("#sort").val();
      $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
          ordering: ordering,
          sort: sort,
          'action': 'ordering1'
        },
        success: function(res) {
          let ord = JSON.parse(res);
          console.log(ord);

          for (let i = 0; i < ord.length; i++) {
            let row = $('<tr></tr>');
            let td1 = $('<td></td>').text(ord[i]['ride_id']);
            let td2 = $('<td></td>').text(ord[i]['from']);
            let td3 = $('<td></td>').text(ord[i]['to']);
            let td4 = $('<td></td>').text(ord[i]['cab_type']);
            let td5 = $('<td></td>').text(ord[i]['total_fare']);
            let td6 = $('<td></td>').text(ord[i]['luggage']);
            let td7 = $('<td></td>').append("<input type='submit' onclick='detail(" + ord[i]['ride_id'] + ")' value='View Details'>");


            row.append(td1, td2, td3, td4, td5, td6, td7);
            $('#tbl').append(row);
          }
        }
      });
    });

    $("#apply2").on('click', function() {
      $("td").css('display', 'none');

      let ordering = $("#order").val();
      let sort = $("#sort").val();
      $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
          ordering: ordering,
          sort: sort,
          'action': 'ordering2'
        },
        success: function(res) {
          let ord = JSON.parse(res);
          console.log(ord);
          // console.log(res);
          for (let i = 0; i < ord.length; i++) {
            let row = $('<tr></tr>');
            let td1 = $('<td></td>').text(ord[i]['ride_id']);
            let td2 = $('<td></td>').text(ord[i]['from']);
            let td3 = $('<td></td>').text(ord[i]['to']);
            let td4 = $('<td></td>').text(ord[i]['cab_type']);
            let td5 = $('<td></td>').text(ord[i]['total_fare']);
            let td6 = $('<td></td>').text(ord[i]['luggage']);
            let td7 = $('<td></td>').append("<input type='submit' onclick='detail(" + ord[i]['ride_id'] + ")' value='View Details'>");


            row.append(td1, td2, td3, td4, td5, td6, td7);
            $('#tbl').append(row);
          }
        }
      });
    });

    $("#apply3").on('click', function() {
      $("td").css('display', 'none');
      let ordering = $("#order").val();
      let sort = $("#sort").val();
      $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
          ordering: ordering,
          sort: sort,
          'action': 'ordering3'
        },
        success: function(res) {
          let ord = JSON.parse(res);
          console.log(ord);

          for (let i = 0; i < ord.length; i++) {
            let row = $('<tr></tr>');
            let td1 = $('<td></td>').text(ord[i]['ride_id']);
            let td2 = $('<td></td>').text(ord[i]['from']);
            let td3 = $('<td></td>').text(ord[i]['to']);
            let td4 = $('<td></td>').text(ord[i]['cab_type']);
            let td5 = $('<td></td>').text(ord[i]['total_fare']);
            let td6 = $('<td></td>').text(ord[i]['luggage']);
            let td7 = $('<td></td>').append("<input type='submit' onclick='detail(" + ord[i]['ride_id'] + ")' value='View Details'>");


            row.append(td1, td2, td3, td4, td5, td6, td7);
            $('#tbl').append(row);

          }
        }
      });
    });

  });

  function canceled(ride) {
    // console.log(1);
    $.ajax({
      type: 'POST',
      url: '../helper.php',
      data: {
        ride: ride,
        action: 'cancelRide'
      },
      success: function(res) {
        console.log(res);
        alert('Ride Canceled');
        location.reload();
      }
    });
  }

  function detail(rideid) {

    $.ajax({
      type: 'POST',
      url: '../helper.php',
      data: {
        rideid: rideid,
        action: 'detailed'
      },
      success: function(res) {
        let response = JSON.parse(res);
        console.log(response);

        for (let i = 0; i < response.length; i++) {
          $("#modal2").show();

          if (response[i]['status'] == 1) {
            $(".modal-body").html("<strong>Ride Date : </strong>" + response[i]['ride_date'] + "<br> <strong> Pickup Location : </strong>" + response[i]['from'] + "<br><strong>Drop Location: </strong>" + response[i]['to'] + " <br><strong>Cab Type : </strong>" + response[i]['cab_type'] + "<br><strong> Fare : Rs </strong>" + response[i]['total_fare'] + "<br><strong> Luggage : </strong>" + response[i]['luggage'] + " kg <br> <strong>Status :</strong> Pending");
          } else if (response[i]['status'] == 2) {
            $(".modal-body").html("<strong>Ride Date : </strong>" + response[i]['ride_date'] + "<br> <strong> Pickup Location : </strong>" + response[i]['from'] + "<br><strong>Drop Location: </strong>" + response[i]['to'] + " <br><strong>Cab Type : </strong>" + response[i]['cab_type'] + "<br><strong> Fare : Rs </strong>" + response[i]['total_fare'] + "<br><strong> Luggage : </strong>" + response[i]['luggage'] + " kg <br> <strong>Status :</strong> Completed");
          } else {
            $(".modal-body").html("<strong>Ride Date : </strong>" + response[i]['ride_date'] + "<br> <strong> Pickup Location : </strong>" + response[i]['from'] + "<br><strong>Drop Location: </strong>" + response[i]['to'] + " <br><strong>Cab Type : </strong>" + response[i]['cab_type'] + "<br><strong> Fare : Rs </strong>" + response[i]['total_fare'] + "<br><strong> Luggage : </strong>" + response[i]['luggage'] + " kg <br> <strong>Status :</strong> Canceled");
          }
        }
      }

    });
  }
</script>

</html>