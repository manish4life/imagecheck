<?php 
if(isset($_REQUEST['submit'])){
echo "<pre>";print_r($_FILES);die;
//$return_msg = getMimeType($_FILES);
    
$mediapath = $_FILES['myfile']['tmp_name'];
$return_msg = getimagesize($mediapath);
echo "<pre>";print_r($return_msg);die;
}

?>
<form action="" enctype="multipart/form-data" method="POST">

<input type="file" name="myfile">
<input type="submit" name="submit" value="submit">

</form>

<script type="text/javascript">
$(document).ready(function(){
    $('#featured_image').bind('change', function() {
     var file_data = $("#featured_image").prop("files")[0];
     var form_data = new FormData();
     form_data.append('file',file_data);
           $.ajax({
             url: "/home/isimage",
             method: "POST",
             data: form_data,
             context: document.body,
             processData: false, 
             contentType: false,
           }).done(function(response) {
             console.log(response);
             var obj = jQuery.parseJSON( response );
             //alert( obj.msg);
             if(obj.success == '0'){
                $("#err_msg_featured_image").html(obj.msg);
                $("#invalid_image").val('NO');
                $("#invalid_image_msg").val(obj.msg);
                $("#err_msg_final").html(obj.msg);
             } else {
               $("#err_msg_featured_image").html('');
                $("#invalid_image").val('YES');
                $("#invalid_image_msg").val('');
                $("#err_msg_final").html('');
             }
             
           });
       });
});
