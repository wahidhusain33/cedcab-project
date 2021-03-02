$(document).ready(function(){

  // dropdown();
    $("#submit").click(function(e){
        e.preventDefault();
        $.ajax({
          url: "../helper.php",
          type: "POST",
          datatype:"html",
          data:$("#form").serialize(),
          success:function(data){
           $(".modal-body").html(data);
           $("#modal").modal('show');
          }
        });
      });
      $("#sel").change(function () {
        var sel = $("#sel").val();
        // console.log(sel);
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


    
    
    $("#pick").on("change",function(){
        $("#drop option").show();
        $("#drop option[value=" +$(this).val()+"]").hide();
  
    });
  
    $("#drop").on("change",function(){
        $("#pick option").show();
        $("#pick option[value=" +$(this).val()+"]").hide();
    });
    
  
    // $("#close").on("click",function(){
    //   $("#modal").modal('hide');
    // });
  
    // $("#changes").on("click",function(){
    //   $("#sel").prop("disabled", true);
    //   $("#modal").modal('hide');
    // });

});

// function dropdown(){
//   $.ajax({
//     url:'helper.php',
//     type:'POST',
//     data:{
//       'action':'dropdown',
//     }
//     success:function(data){
//       console.log(data);
//     }
//   });
// }