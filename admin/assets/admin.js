$(document).ready(function() {

    $("select").css('display', 'none');
    $("#apply").css('display', 'none');

    $("#close").on("click", function() {
        $("#modal2").css('display', 'none');
    });
    $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
            'action': 'allcanceled'
        },
        success: function(res) {
            let response = JSON.parse(res);
            if (response.length > 0) {
                $("#canceled").text("Canceled Rides : " + response.length);
            } else {
                $("#canceled").text("Canceled Rides : " + 0);
            }
        }
    });

    $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
            'action': 'allride'
        },
        success: function(res) {
            let response = JSON.parse(res);
            if (response.length > 0) {
                $("#all").text("All Rides : " + response.length);
            } else {
                $("#all").text("All Rides : " + 0);
            }
        }
    });

    $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
            'action': 'allusers'
        },
        success: function(res) {
            let response = JSON.parse(res);
            if (response.length > 0) {
                $("#users").text("All Users : " + response.length);
            } else {
                $("#users").text("All Users : " + 0);
            }
        }
    });

    $.ajax({

        type: 'POST',
        url: '../helper.php',
        data: {
            action: 'earningsum'
        },
        success: function(res) {
            var total = JSON.parse(res);
            let fare = total.totalFare;
            if (fare > 0) {
                $("#earningsum").text("Total Earning : " + fare + " Rs");
            } else {
                $("#earningsum").text("Total Earning : " + 0 + " Rs");
            }

        }

    });

    $.ajax({

        type: 'POST',
        url: '../helper.php',
        data: {
            action: 'allpending'
        },
        success: function(res) {
            let response = JSON.parse(res);
            if (response.length > 0) {
                $("#pending").text("Pending Rides : " + response.length);
            } else {
                $("#pending").text("Pending Rides : " + 0);
            }

        }

    });

    $.ajax({

        type: 'POST',
        url: '../helper.php',
        data: {
            action: 'loclength'
        },
        success: function(res) {
            let response = JSON.parse(res);
            if (response.length > 0) {
                $("#loc").text("Locations : " + response.length);
            } else {
                $("#loc").text("Locations : " + 0);
            }
        }
    });

    $("#allpending").on("click", function() {
        $("td").css('display', 'none');
        $("th").css('display', 'none');
        $("select").css('display', 'inline');
        $("#apply").css('display', 'inline');
        $("#apply2").css('display', 'none');
        $("#apply3").css('display', 'none');
        $("#apply1").css('display', 'none');
        $("#add").css('display', 'none');
        $("#up").css("display", "none");
        $("#addloc").css("display", "none");
        $("#addDis").css("display", "none");
        $("#addIt").css("display", "none");

        $.ajax({
            type: 'POST',
            url: '../helper.php',
            data: {
                'action': 'allpending'
            },
            success: function(res) {
                let response = JSON.parse(res);
                console.log(response);
                let row = $('<tr></tr>');
                let th1 = $('<th></th>').text('Ride Id');
                let th2 = $('<th></th>').text('Pickup Location');
                let th3 = $('<th></th>').text('Drop Location');
                let th4 = $('<th></th>').text('Cabtype');
                let th5 = $('<th></th>').text('Estimated Earning');
                let th6 = $('<th></th>').text('Luggage');
                let th7 = $('<th></th>').text("Action");

                row.append(th1, th2, th3, th4, th5, th6, th7);
                $('#tbl').append(row);

                for (let i = 0; i < response.length; i++) {
                    let row = $('<tr></tr>');
                    let td1 = $('<td></td>').text(response[i]['ride_id']);
                    let td2 = $('<td></td>').text(response[i]['from']);
                    let td3 = $('<td></td>').text(response[i]['to']);
                    let td4 = $('<td></td>').text(response[i]['cab_type']);
                    let td5 = $('<td></td>').text(response[i]['total_fare']);
                    let td6 = $('<td></td>').text(response[i]['luggage']);
                    let td7 = $('<td></td>').append("<input type='submit' onclick='acceptride(" + response[i]['ride_id'] + ")' value='Accept'><input type='submit' onclick='rejectride(" + response[i]['ride_id'] + ")' value='Reject'>");


                    row.append(td1, td2, td3, td4, td5, td6, td7);
                    $('#tbl').append(row);

                }

            }

        });

    });

    $("#allcanceled").on("click", function() {
        $("td").css('display', 'none');
        $("th").css('display', 'none');
        $("#apply").css('display', 'none');
        $("#apply2").css('display', 'none');
        $("#apply3").css('display', 'none');
        $("#apply1").css('display', 'inline');
        $("select").css('display', 'inline');
        $("#add").css('display', 'none');
        $("#up").css("display", "none");
        $("#addloc").css("display", "none");
        $("#addDis").css("display", "none");
        $("#addIt").css("display", "none");
        $.ajax({
            type: 'POST',
            url: '../helper.php',
            data: {
                'action': 'allcanceled'
            },
            success: function(res) {
                let response = JSON.parse(res);
                console.log(response);
                let row = $('<tr></tr>');
                let th1 = $('<th></th>').text('Ride Id');
                let th2 = $('<th></th>').text('Pickup Location');
                let th3 = $('<th></th>').text('Drop Location');
                let th4 = $('<th></th>').text('Cabtype');
                let th5 = $('<th></th>').text('Expected Earning');
                let th6 = $('<th></th>').text('Luggage');
                let th7 = $('<th></th>').text("Action");

                row.append(th1, th2, th3, th4, th5, th6, th7);
                $('#tbl').append(row);

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

    $("#totalearning").on("click", function() {
        $("td").css('display', 'none');
        $("th").css('display', 'none');
        $("#apply").css('display', 'none');
        $("#apply1").css('display', 'none');
        $("#apply3").css('display', 'none');
        $("#apply2").css('display', 'inline');
        $("select").css('display', 'inline');
        $("#add").css('display', 'none');
        $("#up").css("display", "none");
        $("#addloc").css("display", "none");
        $("#addDis").css("display", "none");
        $("#addIt").css("display", "none");
        $.ajax({
            type: 'POST',
            url: '../helper.php',
            data: {
                'action': 'totalearning'
            },
            success: function(res) {
                let response = JSON.parse(res);
                console.log(response);
                let row = $('<tr></tr>');
                let th1 = $('<th></th>').text('Ride Id');
                let th2 = $('<th></th>').text('Pickup Location');
                let th3 = $('<th></th>').text('Drop Location');
                let th4 = $('<th></th>').text('Cabtype');
                let th5 = $('<th></th>').text('Total Earning');
                let th6 = $('<th></th>').text('Luggage');
                let th7 = $('<th></th>').text("Action");

                row.append(th1, th2, th3, th4, th5, th6, th7);
                $('#tbl').append(row);

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

    $("#allride").on("click", function() {
        $("td").css('display', 'none');
        $("th").css('display', 'none');
        $("#apply").css('display', 'none');
        $("#apply1").css('display', 'none');
        $("#apply2").css('display', 'none');
        $("#apply3").css('display', 'inline');
        $("select").css('display', 'inline');
        $("#add").css('display', 'none');
        $("#up").css("display", "none");
        $("#addloc").css("display", "none");
        $("#addDis").css("display", "none");
        $("#addIt").css("display", "none");
        $.ajax({
            type: 'POST',
            url: '../helper.php',
            data: {
                'action': 'allride'
            },
            success: function(res) {
                let response = JSON.parse(res);
                console.log(response);
                let row = $('<tr></tr>');
                let th1 = $('<th></th>').text('Ride Id');
                let th2 = $('<th></th>').text('Pickup Location');
                let th3 = $('<th></th>').text('Drop Location');
                let th4 = $('<th></th>').text('Cabtype');
                let th5 = $('<th></th>').text('Earning');
                let th6 = $('<th></th>').text('Luggage');
                let th7 = $('<th></th>').text("Action");

                row.append(th1, th2, th3, th4, th5, th6, th7);
                $('#tbl').append(row);

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


    $("#allusers").on("click", function() {
        $("td").css('display', 'none');
        $("th").css('display', 'none');
        $("#apply").css('display', 'none');
        $("#apply1").css('display', 'none');
        $("#apply2").css('display', 'none');
        $("#apply3").css('display', 'none');
        $("select").css('display', 'none');
        $("#add").css('display', 'none');
        $("#up").css("display", "none");
        $("#addloc").css("display", "none");
        $("#addDis").css("display", "none");
        $("#addIt").css("display", "none");
        // $("th").toggle();
        $.ajax({
            type: 'POST',
            url: '../helper.php',
            data: {
                'action': 'allusers'
            },
            success: function(res) {
                let response = JSON.parse(res);
                console.log(response);
                let row = $('<tr></tr>');
                let th1 = $('<th></th>').text('User Id');
                let th2 = $('<th></th>').text('Email id');
                let th3 = $('<th></th>').text('Name');
                let th4 = $('<th></th>').text('Signup Date');
                let th5 = $('<th></th>').text('Mobile No');
                let th6 = $('<th></th>').text('Status');
                let th7 = $('<th></th>').text("Action");

                row.append(th1, th2, th3, th4, th5, th6, th7);
                $('#tbl').append(row);


                for (let i = 0; i < response.length; i++) {
                    if (response[i]['status'] == 0) {
                        let row = $('<tr></tr>');
                        let td1 = $('<td></td>').text(response[i]['user_id']);
                        let td2 = $('<td></td>').text(response[i]['email_id']);
                        let td3 = $('<td></td>').text(response[i]['name']);
                        let td4 = $('<td></td>').text(response[i]['dateofsignup']);
                        let td5 = $('<td></td>').text(response[i]['mobile']);
                        let td6 = $('<td></td>').text('Blocked');
                        let td7 = $('<td></td>').append("<input type='submit' onclick='unblock(" + response[i]['user_id'] + ")' value='Unblock'>");

                        row.append(td1, td2, td3, td4, td5, td6, td7);
                        $('#tbl').append(row);

                    } else {
                        let row = $('<tr></tr>');
                        let td1 = $('<td></td>').text(response[i]['user_id']);
                        let td2 = $('<td></td>').text(response[i]['email_id']);
                        let td3 = $('<td></td>').text(response[i]['name']);
                        let td4 = $('<td></td>').text(response[i]['dateofsignup']);
                        let td5 = $('<td></td>').text(response[i]['mobile']);
                        let td6 = $('<td></td>').text('Unblocked');
                        let td7 = $('<td></td>').append("<input type='submit' onclick='block(" + response[i]['user_id'] + ")' value='Block'>");

                        row.append(td1, td2, td3, td4, td5, td6, td7);
                        $('#tbl').append(row);

                    }

                }

            }

        });

    });


    $("#location").on("click", function() {
        // console.log(1);
        $("td").css('display', 'none');
        $("th").css('display', 'none');
        $("#apply").css('display', 'none');
        $("#apply1").css('display', 'none');
        $("#apply2").css('display', 'none');
        $("#apply3").css('display', 'none');
        $("#add").css('display', 'inline');
        $("select").css('display', 'none');
        $("#up").css("display", "none");
        $("#addloc").css("display", "none");
        $("#addDis").css("display", "none");
        $("#addIt").css("display", "none");
        $.ajax({
            type: 'POST',
            url: '../helper.php',
            data: {
                'action': 'location'
            },
            success: function(res) {
                let response = JSON.parse(res);
                console.log(response);
                let row = $('<tr></tr>');
                let th1 = $('<th></th>').text('Name');
                let th2 = $('<th></th>').text('Distance');
                let th3 = $('<th></th>').text('Available');
                let th4 = $('<th></th>').text('Action');

                row.append(th1, th2, th3, th4);
                $('#tbl').append(row);

                for (let i = 0; i < response.length; i++) {
                    let row = $('<tr></tr>');
                    let td1 = $('<td></td>').text(response[i]['name']);
                    let td2 = $('<td></td>').text(response[i]['distance']);
                    let td3 = $('<td></td>').text(response[i]['is_available']);
                    let td4 = $('<td></td>').append("<input type='submit'  onclick='updateloc(" + response[i]['id'] + ")' value='Update'><input type='submit' onclick='deleteloc(" + response[i]['id'] + ")' value='Delete'>");

                    row.append(td1, td2, td3, td4);
                    $('#tbl').append(row);

                }

            }

        });

    });


    $("#apply").on('click', function() {
        let admin_ordering = $("#order").val();
        let sort = $("#sort").val();
        $("td").css('display', 'none');
        $("th").css('display', 'none');
        $.ajax({
            type: 'POST',
            url: '../helper.php',
            data: {
                admin_ordering: admin_ordering,
                sort: sort,
                'action': 'admin_ordering'
            },
            success: function(res) {
                let ord = JSON.parse(res);
                console.log(ord);
                // console.log(res);

                let row = $('<tr></tr>');
                let th1 = $('<th></th>').text('Ride Id');
                let th2 = $('<th></th>').text('Pickup Location');
                let th3 = $('<th></th>').text('Drop Location');
                let th4 = $('<th></th>').text('Cabtype');
                let th5 = $('<th></th>').text('Estimated Earning');
                let th6 = $('<th></th>').text('Luggage');
                let th7 = $('<th></th>').text("Action");

                row.append(th1, th2, th3, th4, th5, th6, th7);
                $('#tbl').append(row);

                for (let i = 0; i < ord.length; i++) {
                    let row = $('<tr></tr>');
                    let td1 = $('<td></td>').text(ord[i]['ride_id']);
                    let td2 = $('<td></td>').text(ord[i]['from']);
                    let td3 = $('<td></td>').text(ord[i]['to']);
                    let td4 = $('<td></td>').text(ord[i]['cab_type']);
                    let td5 = $('<td></td>').text(ord[i]['total_fare']);
                    let td6 = $('<td></td>').text(ord[i]['luggage']);
                    let td7 = $('<td></td>').append("<input type='submit' onclick='acceptride(" + ord[i]['ride_id'] + ")' value='Accept'><input type='submit' onclick='rejectride(" + ord[i]['ride_id'] + ")' value='Reject'>");


                    row.append(td1, td2, td3, td4, td5, td6, td7);
                    $('#tbl').append(row);

                }
            }

        });
    });

    $("#apply1").on('click', function() {
        $("td").css('display', 'none');
        $("th").css('display', 'none');
        let admin_ordering = $("#order").val();
        let sort = $("#sort").val();
        $.ajax({
            type: 'POST',
            url: '../helper.php',
            data: {
                admin_ordering: admin_ordering,
                sort: sort,
                'action': 'admin_ordering1'
            },
            success: function(res) {
                let ord = JSON.parse(res);
                console.log(ord);

                let row = $('<tr></tr>');
                let th1 = $('<th></th>').text('Ride Id');
                let th2 = $('<th></th>').text('Pickup Location');
                let th3 = $('<th></th>').text('Drop Location');
                let th4 = $('<th></th>').text('Cabtype');
                let th5 = $('<th></th>').text('Expected Earning');
                let th6 = $('<th></th>').text('Luggage');
                let th7 = $('<th></th>').text("Action");

                row.append(th1, th2, th3, th4, th5, th6, th7);
                $('#tbl').append(row);

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
        $("th").css('display', 'none');
        let admin_ordering = $("#order").val();
        let sort = $("#sort").val();
        $.ajax({
            type: 'POST',
            url: '../helper.php',
            data: {
                admin_ordering: admin_ordering,
                sort: sort,
                'action': 'admin_ordering2'
            },
            success: function(res) {
                let ord = JSON.parse(res);
                console.log(ord);
                // console.log(res);
                let row = $('<tr></tr>');
                let th1 = $('<th></th>').text('Ride Id');
                let th2 = $('<th></th>').text('Pickup Location');
                let th3 = $('<th></th>').text('Drop Location');
                let th4 = $('<th></th>').text('Cabtype');
                let th5 = $('<th></th>').text('Total Earning');
                let th6 = $('<th></th>').text('Luggage');
                let th7 = $('<th></th>').text("Action");

                row.append(th1, th2, th3, th4, th5, th6, th7);
                $('#tbl').append(row);

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
        $("th").css('display', 'none');
        let admin_ordering = $("#order").val();
        let sort = $("#sort").val();
        $.ajax({
            type: 'POST',
            url: '../helper.php',
            data: {
                admin_ordering: admin_ordering,
                sort: sort,
                'action': 'admin_ordering3'
            },
            success: function(res) {
                let ord = JSON.parse(res);
                console.log(ord);

                let row = $('<tr></tr>');
                let th1 = $('<th></th>').text('Ride Id');
                let th2 = $('<th></th>').text('Pickup Location');
                let th3 = $('<th></th>').text('Drop Location');
                let th4 = $('<th></th>').text('Cabtype');
                let th5 = $('<th></th>').text('Earning');
                let th6 = $('<th></th>').text('Luggage');
                let th7 = $('<th></th>').text("Action");

                row.append(th1, th2, th3, th4, th5, th6, th7);
                $('#tbl').append(row);

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

    $("#updatebtn").on('click', function() {
        let loc = $("#locationname").val();
        let dis = $("#distance").val();
        let avail = $("#available").val();

        $.ajax({
            type: 'POST',
            url: '../helper.php',
            data: {
                loc: loc,
                dis: dis,
                avail: avail,
                action: 'Updation'
            },
            success: function(res) {
                alert('Location Updated');
                location.reload();
            }
        });
    });

    $("#add").on('click',function(){
        $("#addloc").css('display','inline');
        $("#addDis").css('display','inline');
        $("#add").css('display','none');
        $("#addIt").css('display','block');
    });

    $("#addIt").on('click',function(){
        let loc=$("#addloc").val();
        let dis=$("#addDis").val();
        $.ajax({
            type:'POST',
            url:'../helper.php',
            data:{
                loc:loc,
                dis:dis,
                action:'addLoc'
            },
            success:function(res){
                location.reload();
                console.log(res);
            }
        });
    });
});

function acceptride(rideid) {

    $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
            rideid: rideid,
            'action': 'acceptride'
        },
        success: function(res) {
            console.log(res);
            alert("Ride request accepted");
            location.reload();
        }

    });
}

function rejectride(rideid) {
    $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
            rideid: rideid,
            'action': 'rejectride'
        },
        success: function(res) {
            console.log(res);
            alert("Ride request rejected");
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
            action: 'detailedinfo'
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

function block(user) {
    // console.log(user);
    $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
            user: user,
            'action': 'block'
        },
        success: function(res) {
            alert("User blocked");
            location.reload();
            console.log(res);
        }

    });
}

function unblock(user) {
    // console.log(user);

    $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
            user: user,
            'action': 'unblock'
        },
        success: function(res) {
            alert("User unblocked");
            location.reload();
            console.log(res);
        }

    });
}

function deleteloc(locid) {
    $.ajax({

        type: 'POST',
        url: '../helper.php',
        data: {
            locid: locid,
            action: 'deleteloc'
        },
        success: function(res) {
            alert("Location Deleted");
            location.reload();
            console.log(res);
        }
    });
}

function updateloc(locid) {
    $("td").css('display', 'none');
    $("th").css('display', 'none');
    $("#apply").css('display', 'none');
    $("#apply1").css('display', 'none');
    $("#apply2").css('display', 'none');
    $("#apply3").css('display', 'none');
    $("#add").css('display', 'none');
    $("select").css('display', 'none');
    $("#up").css("display", "block")
    // console.log(locid);
    $.ajax({
        type: 'POST',
        url: '../helper.php',
        data: {
            locid: locid,
            action: 'updateloc'
        },
        success: function(res) {
            let response = JSON.parse(res);

            for (let i = 0; i < response.length; i++) {
                $("#locationname").val(response[i]['name']);
                $("#distance").val(response[i]['distance']);
                $("#available").val(response[i]['is_available']);
            }
        }
    });
}