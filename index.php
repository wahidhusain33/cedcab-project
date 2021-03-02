<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ced-Cab</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <style>
  body{
    font-family: 'Cinzel', serif;
  }
  </style>
</head>

<body>
  <?php include_once "layout/header.php" ?>
  <div id="container">
    <div class="div1" id="div1">
      Pick your Destination
    </div>
    <div class="div1" id="div2">
      Choose from a range of Catergories and Prices
    </div>
    <div id="bookDiv">
      <h2>LET US DROP YOU</h2>

      <div id="bookDiv1">

        <form action="" method="POST" id="form">
          <div class="input-group mb-3">
            <label class="input-group-text" for="pick">Pick Up</label>
            <select class="form-select" id="pick" class="pick" name="pick">
              <option value="Pick_Location" selected>Location</option>

            </select>
          </div>

          <div class="input-group mb-3">
            <label class="input-group-text" for="drop">Drop</label>
            <select class="form-select" id="drop" class="drop" name="drop">
              <option value="Drop_Location" selected>Location</option>

            </select>
          </div>

          <div class="input-group mb-3">
            <label class="input-group-text" for="sel">CAB Type</label>
            <select class="form-select" id="sel" name="cab">
              <option selected>Select Cab</option>
              <option value="CedMicro">CedMicro</option>
              <option value="CedMini">CedMini</option>
              <option value="CedRoyal">CedRoyal</option>
              <option value="CedSUV">CedSUV</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Luggage</span>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="place" placeholder="In kg" name="luggage">
          </div>

          <div class="col-12">
            <input class="btn btn-primary" type="submit" id="submit" name='submit' value="Calculate Fare">
          </div>

        </form>

      </div>
    </div>
  </div>

  <?php include_once "layout/footer.php" ?>

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
          <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="book">Book a Ride</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
  $(document).ready(function() {
    dropdownfun();

    $("#submit").on("click", e => {
      e.preventDefault();
      var pick = $("#pick").val();


      var drop = $("#drop").val();
      var cab = $("#sel").val();
      var luggage = $("#place").val();
      var pickLoc = $("#pick option:selected").text();
      var dropLoc = $("#drop option:selected").text();

      $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {
          pick: pick,
          drop: drop,
          cab: cab,
          luggage: luggage,
          'pickLoc': pickLoc,
          'dropLoc': dropLoc,
          'action': 'FareCal'
        },
        success: function(data) {
          let cal = JSON.parse(data);
          console.log(cal);

          if (cal[4] != 0 && cal[4] != null) {

            $(".modal-body").html("Pickup Location : " + pickLoc + "<br>Drop Location: " + dropLoc + " <br>Cab Type : " + cab + "<br> Distance : " + cal[2] + " Km <br> Fare : Rs " + cal[3] + "<br> Luggage : " + cal[4] + " kg");

            $("#modal").modal('show');
          } else {
            $(".modal-body").html("Pickup Location : " + pickLoc + "<br>Drop Location: " + dropLoc + " <br>Cab Type : " + cab + "<br> Distance : " + cal[2] + " Km <br> Fare : Rs " + cal[3]);

            $("#modal").modal('show');
          }

        }
      });
    });

    $("#close").on("click", function() {
      $("#modal").modal('hide');
    });

    $("#book").on("click", function() {
      // $("#sel").prop("disabled", true);
      window.location.href = "login.php";
      $("#modal").modal('hide');
    });


    $("#sel").change(function() {

      var sel = $("#sel").val();

      if (sel == "CedMicro") {
        $("#place").prop("disabled", true);
        $("#place").attr(
          "placeholder",
          "Sorry!!! You can't take luggage with you ."
        );
      } else {
        $("#place").prop("disabled", false);
        $("#place").attr("placeholder", "In kg");
      }
    });


    $("#pick").on("change", function() {
      $("#drop option").show();
      $("#drop option[value=" + $(this).val() + "]").hide();

    });

    $("#drop").on("change", function() {
      $("#pick option").show();
      $("#pick option[value=" + $(this).val() + "]").hide();
    });



  });

  function dropdownfun() {
    let input = {
      action: 'checkdropdown'
    };
    $.ajax({
      type: 'POST',
      url: 'helper.php',
      data: input,
      success: function(res) {
        let location = JSON.parse(res);
        console.log(location);

        for (var i = 0; i < location.length; i++) {
          $('#pick').append($('<option>').val(location[i]['distance']).text(location[i]['name']));
          $('#drop').append($('<option>').val(location[i]['distance']).text(location[i]['name']));

        }
      },
      error: function(err) {
        console.log(err);
      }


    });

  }
</script>

</html>