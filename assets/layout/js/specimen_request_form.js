
$(document).on('click','#addcartdatabtn',function(e){
var data = $("#addcartdata").serialize();
var $subject = $("#subject").val();
var $series  = $("#series").val();
var $edition = $("#edition").val();
var $type    = $("#type").val();
var $remarks = $("#remarks").val();

if($subject=="" || $subject=="Select Subject")
{
    $("span").css("display", "block");
    $("#result").html('<div class="warning_popup alert alert-warning alert-dismissible"><a href="#" id="cls" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  Alert!</strong> Select Subject First</div>');
      
       $("#cls" ).click(function() {
        $("span").css("display", "none");
      });

    return;
 
}
if($series=="" || $series=="Select Series")
{
   $("span").css("display", "block");
    $("#result").html('<div class="warning_popup alert alert-warning alert-dismissible"><a href="#" id="cls" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  Alert!</strong> Select Series First</div>');
      
      $( "#cls" ).click(function() {
        $("span").css("display", "none");
      });

    return;
}
if($edition =="" || $edition =="Select Edition")
{
    $("span").css("display", "block");
    $("#result").html('<div class = "warning_popup alert alert-warning alert-dismissible"><a href="#" id="cls" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  Alert!</strong> Select Edition First</div>');
      
      $( "#cls" ).click(function() {
        $("span").css("display", "none");
      });

    return;
}
if($type  =="" || $type  =="Select Type")
{
 $("span").css("display", "block");
    $("#result").html('<div class="warning_popup alert alert-warning alert-dismissible"><a href="#" id="cls" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  Alert!</strong> Select Type First</div>');
      
      $( "#cls" ).click(function() {
        $("span").css("display", "none");
      });

    return;
}
if($remarks == "")
{
    $("span").css("display", "block");
    $("#result").html('<div class="warning_popup alert alert-warning alert-dismissible"><a href="#" id="cls" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  Alert!</strong>  Enter Remarks</div>');
      
      $( "#cls" ).click(function() {
        $("span").css("display", "none");
      });

    return;
}


var csrfToken = '{{ csrf_token() }}';
$.ajax({
          data: data,
          type: "POST",
          //url:"{{ URL::to('savespecimenformdata') }}",
          url: "http://localhost/bms/savespecimenformdata",
         success: function(data)
         {
           location.reload();
            var jsonresult= JSON.stringify(data);
            var myObj = JSON.parse(data);
               if(myObj.status=="warning"){

                $("span").css("display", "block");
                $("#result").html('<div class="warning_popup  alert alert-warning alert-dismissible"><a href="#" id="cls" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Alert!</strong> Enter the Quantity</div>');
                $( "#cls" ).click(function() {
                      $("span").css("display", "none");
                    });
                  return;
               }
               else
               {

                       show_cart_count();
                       $("span").css("display", "block");
                       $("#result").html('<div class="success_popup  alert alert-success alert-dismissible"><a href="#" id="cls" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-check" aria-hidden="true"></i>  Success!</strong>  Item Added to the cart Successfully, Please check into the cart.</div>');
                             $( "#cls" ).click(function() {
                              $("span").css("display", "none");
                            });
                             /*$("#school").multiselect("deselectAll", false);
                             $('.multiselect-selected-text').html('---Select School---');
                             $('#mcmsection').hide();*/
                             $('#alldata').html("");
                             $("#addcartdata")[0].reset();
               }

               $('html, body').animate({ scrollTop: 0 }, 500); 
           }
       
       });

});


function show_cart_count()
{ 
    $.ajax({  
                 type:"post",
                 url:"refreshcarddata.php?req_type=count", 
                 success:function(response){ 
                 document.getElementById("total_items").value=response.trim();
            } 
    });
}
function show_cart()
{
   /* $("#cart").hide();*/
    $.ajax({
              type:"post",
              url:"refreshcarddata.php",
              success:function(response){
               $("#cart").toggle();
               document.getElementById("cart").innerHTML=response;
          }
    });
}
//END-----------------------------------------------------------
 $(document).on('click','#finalsubmit',function(e){
  var data = $("#cartform").serialize();

  $.ajax({
             type: "post",
             data: data,
             url: "createrequest.php",
             success: function(data)
             {
                  if($('#result').html("<div class='alert  msgxyz alert-dismissible' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+data+"</div>"))
                  {
                      window.location.href = "dashboard.php?tab=all&success=1";
                  }
            }

      });
});

$(document).on('click','#updatesubmit',function(e){
  var remark=$("#remarks").val();
  if(remark=="")
  {
    alert("Please Enter Your Remarks");
    return false;
  }
 else{
       var data = $("#exe_updatequantity_form").serialize();
     /*  alert(data);
       return;*/
     
       $.ajax({
                data:data,
                type:"post",
                url:"updatequantity.php",
               
               success: function(response)
               {
                    alert("Quantity has been updated");
                   
                  //window.location.href = "reject_list.php?success=1";
                 
                  window.location.href = "dashboard.php?tab=all&success=1";

                 
               }

            });
 }

});

$(document).on('click','#sts_approved',function(e){
  var status=$("#statusaaa").val();
  var  remark=$("#remarks").val();
  
  /*alert(remarks);
  return;*/

  /*alert(status);
  return;*/
  if($('input[name="status"]:checked').length == 0)
  {
         alert('Please Select The Status');
         return false;
  } 
  else if(remark==""){
    alert('Please Enter Your Remarks');
         return false;
  }
     
     
      else
      {
         var data = $("#approvalform").serialize();
           /*alert(data);
           return;*/
        
            $.ajax({
                     data:data,
                     type:"post",
                     url:"update_quantity_manager.php",
                     success: function(response)
                      {
                         //alert(response);
                         window.location.href = "specimenlist.php?success=1";
                         
                          /*if($('#successsss').html())
                          {
                            ;
                          }
                          else
                          {
                            window.location.href = "specimenlist.php?success=0";
                          }*/
                     
                      }
                 
                  });
      }

});
/*$(document).on('click','#approval',function(e){
    var approved_status=$("#statusaaa").val();
 
      if(status==" ")
      {
         alert("Please select the status");
         return false;
      }
      else
      {
         var data = $("#approvedform").serialize();
       
            $.ajax({
                       data:data,
                       type:"post",
                       url:"approve_status_superadmin.php",
                       success: function(data)
                       {
                          if($('#successsss').html())
                          {
                             window.location.href = "finalapproval_list.php?success=1";
                          }
                          else
                          {
                            window.location.href = "finalapproval_list.php?success=0";
                          }
                      }
                  });


      }

});*/



