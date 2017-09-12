<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Event<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/event">Event</a></li>
            <li class="active">Event Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Event Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/event" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form action="" method="post" onsubmit="return checkeventForm()" accept-charset="utf-8" enctype="multipart/form-data">

             <?php
             // echo "<pre>";

             // print_r($event_attr);
             // echo "<br><br>";
             // print_r($event_specification);
             // echo "<br><br>";
             // print_r($event_images);
             // echo "<br><br>";print_r($event_date_time);
             // echo "<br><br>";
             //  die;
                foreach($event_edit as $e_res)
                {
                  ?>
                <!-- /.box-header -->
                <div class="box-body">
                    <div>
                        <div id="msg_div">
                            <?php echo $this->session->flashdata('message');?>
                        </div>
                    </div>    
                   
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Event Title<span class="text-danger">*</span></label>
                                <input name="event_title" class="form-control" type="text" id="event_title" value="<?php echo $e_res->event_title;?>" />
                               <span id="error_event_title" class="text-danger"></span>
                            </div>
                        </div> 
                          <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Parent Category<span class="text-danger">*</span></label>
                               <select class="form-control" id="event_parent_cat_id" name="event_parent_cat_id" onchange="getSubCategoryList(this.value)">
                                   <option value=""></option>
                                   <?php 
                                        foreach ($category_list as $c_list)
                                        {
                                            ?>
                                            <option value="<?php echo $c_list->category_id; ?>" <?php if($c_list->category_id == $e_res->event_parent_category_id){ ?> selected <?php } ?> ><?php echo $c_list->category_name; ?></option>
                                            <?php
                                        }
                                    ?>
                               </select>
                               <span id="error_perent_category" class="text-danger"></span>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Sub Category<span class="text-danger">*</span></label>
                                <select class="form-control"  name="event_category_id" id="event_category_id">
                                   <?php 
                                        foreach ($sub_category_list as $sc_list)
                                        {
                                            ?>
                                            <option value="<?php echo $sc_list->category_id; ?>" <?php if($sc_list->category_id == $e_res->event_category_id){ ?> selected <?php } ?> ><?php echo $sc_list->category_name; ?></option>
                                            <?php
                                        }
                                    ?>                               
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    <div id="specification_details" style="display: none;">
                    <label>Specification</label>
                    <div id="allspcifiction">                    
                    </div>
                    </div>
                    <div class="row">                     
                        <div class="form-group col-md-4">                           
                            <label>Event Start Date<span class="text-danger">*</span></label>
                            <div class='input-group date' id='event_start_date'>
                                <input type="text" class="form-control event_start_date" name="event_start_date" id="event_start_date" placeholder="" value="" onkeyup="validate_form_onchange('event_start_date', this.value)">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                             <span id="error_start_date" class="text-danger"></span>
                        </div> 
                        <div class="form-group col-md-4">
                            <label>Event End Date<span class="text-danger">*</span></label>
                            <div class='input-group date' id='event_end_date'>
                                <input type="text" class="form-control event_end_date" name="event_end_date" id="event_end_date">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                             <span id="error_end_date" class="text-danger"></span>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Event Price</label>
                               <input type="text" name="event_price" id="event_price" value="" class="form-control">
                               <span id="error_event_price" class="text-danger"></span>
                            </div>
                        </div>
                                                 
                    </div>
                    <div class="row">                        
                          
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                          <div class="input text">
                                <label>Event Seats</label>
                               <input type="number" min="0" name="event_seats" id="event_seats" value="" class="form-control">
                              <span id="error_seats" class="text-danger"></span>
                            </div>
                        </div>          
                        <div class="form-group col-md-4">
                            <div class="input text">
                             <label>Event Day Slot</label>
                               <select class="form-control" name="event_day_slot" onchange="Get_diffrence_day(this.value)" id="event_day_slot" > 
                                  <option value=""></option>       
                                  <option value="1">Multiple</option>
                                  <option value="0">Single</option>
                              </select>
                              <span id="error_day_slot" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Event Discount</label>
                               <select class="form-control" id="event_discount_id" name="event_discount_id">
                                   <option value=""></option>
                                   <?php 
                                        foreach ($discount_list as $d_list)
                                        {
                                            ?>
                                            <option value="<?php echo $d_list->discount_id ; ?>"><?php echo $d_list->discount_name; ?></option>
                                            <?php
                                        }
                                    ?>
                               </select>

                            </div>
                        </div> 
                       
                    </div>
                    <div class="row">
                     <div class="form-group col-md-4">
                            <div class="input text">
                              <label>Event Status</label>
                               <select class="form-control" name="event_status" >         
                                  <option value="1">Active</option>
                                  <option value="0">Deactive</option>
                               </select>
                               
                            </div>
                        </div>
                       <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Event Image</label>
                                <input type="file" name="event_thumb_img" id="event_thumb_img">
                                <span id="error_event_thum_img" class="text-danger"></span>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Event Multiple Images</label>
                                <input type="file" multiple name="event_images[]" id="event_images" id="demo-hor-12">
                                <span id="error_event_img" class="text-danger"></span>
                            </div>  
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span id="previewImg"></span>
                        </div>
                    </div>
                    <div id="show_event_timing">

                    </div>
                    <div class="row">
                          <div class="form-group col-md-2">
                            <div class="input text">
                                <label>Attribute</label><br>
                                 <button class="btn btn-success btn-sm" type="button" id="add_attr_box" ><i class="fa fa-plus"></i>&nbsp; Add Attribute</button>                                 
                            </div>
                        </div> 
                        <div class="col-md-2">
                            <div class="input text">
                                <label>&nbsp;</label><br>
                                <button class="btn btn-danger btn-sm" type="button" style="margin-left: 20px; display: none;" id="removeButton"><i class="fa fa-remove"></i></button>
                                                                
                            </div>
                        </div>
                    </div>
                    <div id="attributeGroup">         
                                                      
                    </div>   
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input text">
                                <label>Event Description</label>
                              <textarea class="form-control" rows="6" name="event_description"><?php echo set_value('event_description');?> </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/event">Cancel</a>
                </div>

            </form>
           
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">


$("#event_images").on("change", function (e) {
        var files = e.target.files,
        filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
           // $('#img_valid').css('display', 'none');
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function (e) {
               var file = e.target;
                    var img = new Image();
                    img.src = e.target.result;
                    var res = null;
                    img.onload = function() { 
                   // alert(img.src);                                            
                    if(this.width > 600 && this.height > 400){
                     $("#previewImg").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>").insertAfter("#product_images");
                    }
                    else{            
                       // $('#img_valid').css('display', 'block');
                        $('#error_event_img').html("Image height width must be min (600*400).")
                        return false;
                    }
                    }
            });
            fileReader.readAsDataURL(f);
        }
   });

 $(function () {          

        $('#event_start_date').datetimepicker({
            minDate:new Date(),
            format: 'Y-M-D'
        });
        $('#event_end_date').datetimepicker({
            useCurrent: false,
            format: 'Y-M-D'
        });
        $("#event_start_date").on("dp.change", function (e) {
            $('#event_end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#event_end_date").on("dp.change", function (e) {
            $('#event_start_date').data("DateTimePicker").maxDate(e.date);
             
        });  
    });

 $(function () {
       
        $('#emp_dob_i').datetimepicker({
             format: 'Y-M-D'
        });    
    });

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

function Get_diffrence_day(str){
     
     if(str === "1")
     {
        var start_date = $('.event_start_date').val();
        var end_date = $('.event_end_date').val();
        var date1 = new Date(start_date);
        var date2 = new Date(end_date);
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        var startday = date1.getDate();
        diffDays = diffDays+1; 
        var i = '';
        for(i = 1 ; i <= diffDays; i++){
           if(i == 1){
             var nextdate = new Date();
             nextdate.setDate(startday);
           }else{
            var nextdate = new Date();
            nextdate.setDate(startday);
           }
            $('#show_event_timing').append('<div class="row"><div class="col-md-4"><div class="col-md-10"><div class="input text"><label>Event Timeing</label><input class="form-control" id="event_date'+i+'" name="event_time[]" type="text" value="'+formatDate(nextdate.toDateString())+'"/></div></div><div class="col-md-2"><div class="input text"> <label>&nbsp;</label><button class="btn btn-success btn-s" type="button" onclick="addMore_timing('+i+')"><i class="fa fa-plus"></i></button></div></div></div><div class="col-md-2"><div class="input text"><label>&nbsp;</label><input class="form-control" type="text" required name="event_time[]" id="event_timeing" value="" placeholder="Start Time" /></div></div><div class="col-md-2"><div class="input text"><label>&nbsp;</label><input class="form-control" type="text" name="event_time[]" required placeholder="End Time" id="event_timeing" value="" /></div></div></div><div id="TextBoxesGroup'+i+'"></div><input type="hidden" name="timing_counter[]" value="3" id="timing_counter'+i+'" />'); //add input box
                startday = startday+1;

        }
      }else{
        $('#show_event_timing').html('');
      }              
    }

    var a=0; 
    function addMore_timing(str){
        //alert(str); return false;
              var timing_val = $('#timing_counter'+str).val();
                      
              $('#timing_counter'+str).val(Number(timing_val) + Number(3));
              var event_date = $('#event_date'+str).val();
                var counter = 0;
                var newTextBoxDiv = $(document.createElement('div'))
                .attr("id", 'TextBoxDiv'+str+a);
                newTextBoxDiv.after().html(
                '<div id="extra_timingBox'+str+'"><input class="form-control"  name="event_time[]" type="hidden" value="'+event_date+'"/><div class="row"><div class="col-md-4"><div class="col-md-5"><div class="input text"><label></label><input class="form-control" name="event_time[]" type="text" placeholder="Start Time" required value=""/></div></div><div class="col-md-5"><div class="input text"><label></label><input class="form-control" name="event_time[]" required type="text" placeholder="End Time" value=""/></div></div><div class="col-md-1"><label></label><button class="btn btn-danger btn-s" type="button" id="removeButton'+str+'" onclick="remove_timing('+str+a+')"><i class="fa fa-remove"></i></button></div></div></div>');
                    a++;
                   newTextBoxDiv.appendTo("#TextBoxesGroup"+str);           

    }

     function remove_timing(str){
      
       $("#TextBoxDiv"+str).remove(); 
       var timing_val = $('#timing_counter'+str).val();
       $('#timing_counter'+str).val(Number(timing_val) - Number(3));        
         
     }

  function getSubCategoryList(category_id)
    {
        GetAllSpecification(category_id);
        var str = 'category_id='+category_id;

        var PAGE = '<?php echo base_url(); ?>admin/event/getSubCategoryList';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            { 

                if(data != "")
                {
                    $('#event_category_id').html(data);
                }
                else
                {
                    $('#event_category_id').html('<option value=""></option>');
                }
            } 
        });
    }
 
function GetAllSpecificationVal(str){
  var check_or_not = document.getElementById("check_or_not"+str).checked;
    if(check_or_not){  
       var PAGE = '<?php echo base_url(); ?>admin/event/getAllSpecificationVal';        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : 'specification_id='+str,
            success:function(data)
            {                  
                if(data != "")
                {
                    $('#allspcifictionVal'+str).html(data);
                                          
                }
                else
                {
                    $('#allspcifictionVal').html('');
                }
            } 
        });
    }else{
        $('#remove_sp_val'+str).remove();
    }
   
}
 function GetAllSpecification(category_id)
    {
        //alert(category_id); return false;
       if(category_id){
        var str = 'category_id='+category_id;

        var PAGE = '<?php echo base_url(); ?>admin/event/getAllSpecification';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            { 
              if(data != "")
                {
                    $('#specification_details').show();
                    $('#allspcifiction').html(data);
                }

            } 
        });
      }else{
         $('#specification_details').hide();
        $('#allspcifiction').html('');
      } 
    }

$(document).ready(function()
 {

   var counter = 1;
    $("#add_attr_box").click(function () {
         $('#removeButton').show();
        
            var AttrTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'Attrbox' + counter);
            AttrTextBoxDiv.after().html(
             '<div class="row"><div class="form-group col-md-3"><div class="input text"><label>Attribute Name</label><input name="attribute[]" class="form-control" type="text" required id="Attribute_name"/></div></div>'+'<div class="form-group col-md-3"><div class="input text"><label>Attribute Value</label><input name="attribute[]" class="form-control" type="text" required id="attribute_value"/></div></div></div>');

            AttrTextBoxDiv.appendTo("#attributeGroup");        
            counter++;

        });

        $("#removeButton").click(function () {
        counter--;
        $("#Attrbox" + counter).remove();         
        if(counter == 1){
        $('#removeButton').hide();
        
        }


        });
});

function checkeventForm(){

 //Get reference of FileUpload.
var fileUpload = document.getElementById("event_thum_image");

 if($('#event_title').val() == '')
    {
        $('#error_event_title').html('Event Title is required*');
        document.getElementById('event_title').style.border='1px solid red';
        return false;
    }
    else
    {
        $('#error_event_title').html('');
        document.getElementById('event_title').style.border='1px solid #ccc';
        
    }
    
    if($('#event_parent_cat_id').val() == ''){
        $('#error_perent_category').html('Parent Category is required*');
        document.getElementById('event_parent_cat_id').style.border='1px solid red';
        return false;
    }
    else
    {
        $('#error_perent_category').html('');
         document.getElementById('event_parent_cat_id').style.border='1px solid #ccc';
       
    }
      
    if($('.event_start_date').val() == ''){

        $('#error_start_date').html('Event Start Date is required*');
         $(".event_start_date").css("border", "1px solid red");
        return false;
    }
    else
    {
        $('#error_start_date').html('');
         $(".event_start_date").css("border", "1px solid #ccc");
    }

    if($('.event_end_date').val() == ''){
        $('#error_end_date').html('Event End Date is required*');
        $(".event_start_date").css("border", "1px solid red");
        return false;
    }
    else
    {
        $('#error_end_date').html('');
         $(".event_start_date").css("border", "1px solid #ccc");
    }

    if($('#event_price').val() == ''){
        $('#error_event_price').html('Event Price is required*');
        document.getElementById('event_price').style.border='1px solid red';
        return false;
    }
    else
    {
        if (!$.isNumeric($('#event_price').val()))
        {            
            $('#error_event_price').html('Event Price Is Must Be Numeric!');
            document.getElementById('event_price').style.border='1px solid red';
            return false;
        }
        else
        {                
           $('#error_event_price').html('');
            document.getElementById('event_price').style.border='1px solid #ccc';            
        }   
    }

    if($('#event_seats').val() == ''){
        $('#error_seats').html('Event Seats is required*');
        document.getElementById('event_seats').style.border='1px solid red';
        return false;
    }
    else
    {
        $('#error_seats').html('');
         document.getElementById('event_seats').style.border='1px solid #ccc';
               
    }

 
    if($('#event_day_slot').val() == ''){
        $('#error_day_slot').html('Event Day Slot value is required*');
        document.getElementById('event_day_slot').style.border='1px solid red';
        return false;
    }
    else
    {
        $('#error_day_slot').html('');
         document.getElementById('event_day_slot').style.border='1px solid #ccc';      
    }

    if(document.getElementById("event_thum_image").files.length == "")
     {
        $('#error_event_thum_img').html('Event image value is required!');
        return false;
     }
     else
     {
         var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
            if (regex.test(fileUpload.value.toLowerCase())) {
         
                //Check whether HTML5 is supported.
                if (typeof (fileUpload.files) != "undefined") {
                    //Initiate the FileReader object.
                    var reader = new FileReader();
                    //Read the contents of Image File.
                    reader.readAsDataURL(fileUpload.files[0]);
                    reader.onload = function (e) {
                        //Initiate the JavaScript Image object.
                        var image = new Image();
         
                        //Set the Base64 string return from FileReader as source.
                        image.src = e.target.result;
                               
                        //Validate the File Height and Width.
                        image.onload = function () {
                            var height = this.height;
                            var width = this.width;
                            //alert(width); return false;                   
                            if (height < 400 && width < 600) {
                              $('#error_event_thum_img').html('Event Image Size Must Be (600*400)!');
                              return false;
                            }else{
                                
                                $('#error_event_thum_img').html('');
                                return true;
                            }
                            
                        };
         
                    }
                } else {
                   $('#error_event_thum_img').html('This browser does not support HTML5');
                    return false;
                }
            } else {
               $('#error_event_thum_img').html('Please select a valid Image file.')
                return false;
            }
       }

   if(document.getElementById("event_images").files.length == "")
     {
        $('#error_event_img').html('Event Multiple Image is required!');
        return false;
     }
}

</script>