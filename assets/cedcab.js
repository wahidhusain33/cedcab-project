$(document).ready(function(){
    $("#formId").on("submit",function(e){
        e.preventDefault();

        if ($('#fileupload').get(0).files.length === 0) {
            alert("Please submit all the required details");
        }

       let formdata = new FormData(this);
       formdata.append("action","signup")
        $.ajax({
            type:"POST",
            url: "./helper.php",
            contentType: false,
            processData: false,
            data: formdata,
            success:function(data){

                console.log(data);
                if(data==1){
                    window.location = 'login.php';
                }
                else if(data==0){
                    alert("User already Exist");
                }
            }
        });
    });
    $("#sub").on("click",e=>{
        e.preventDefault();

        var uname=$("#uname").val();
        var pass=$("#pass").val();

        $.ajax({
            url:"./helper.php",
            type:"POST",
            data:{
                'uname':uname,
                'pass':pass,
                'action':'login'
            },
            success:function(flag){
                flag = flag.trim();
                // console.log(typeof(flag));
                // debugger;
                // console.log(flag);
                switch(flag) {
                    
                    case '1':
                    console.log('this is admin');
                    window.location.href = "admin/admin_module.php";
                    break;
                    
                    case '0':
                    console.log('this is active customer');
                    window.location.href = "user/dashboard.php";
                    break;
                    
                    case '-1':
                    // console.log('this is blocked customer');
                    alert("Your are blocked");
                    break;
                    
                    case '-2':
                    // console.log('this is worng credentials');
                    alert("Please register first!!!");
                    break;
                    
                    default:
                    console.log('somthing went wrong' + flag);

                    break;
                    }
             }
            });
        });
    });
