<style>
.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
#country-list{z-index: 9999; float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>webroot/image-picker/image-picker.css">
<style type="text/css">
   .thumbnails li img{
   width: 60px;
   }
</style>
<aside class="right-side">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>    
            product<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/product">product</a></li>
            <li class="active">product Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">product Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/product" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form action="" method="post" onsubmit="return checkProductForm()" accept-charset="utf-8" enctype="multipart/form-data">
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
                            <select name="measurement_type" id="measurement_type" onchange="getAllMsmType(this.value)"  class="form-control">
                                <option value="">Select measurement</option>  
                                <?php
                                foreach ($measurement_list as $msm_res) 
                                {
                                    ?>
                                    <option value="<?php echo $msm_res->measurement_id; ?>"><?php echo $msm_res->measurement_name; ?></option>
                                    <?php
                                }
                                ?>                  
                            </select>   
                            <span id="error_measurement_type" class="text-danger"> </span>                          
                         </div>
                        </div>
                          <span id="msm_value"></span>
                       </div>                   
                       <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Product Title<span class="text-danger">*</span></label>
                                <input name="product_title" class="form-control" type="text" id="product_title" value="<?php echo set_value('product_title'); ?>" />
                               <span id="error_product_title" class="text-danger"></span>
                            </div>
                        </div> 
                          <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Parent Category<span class="text-danger">*</span></label>
                               <select class="form-control" id="product_parent_cat_id" name="category_id[]" onchange="getParentSubCategory(this.value,'parent_sub')">
                                   <option value=""></option>
                                   <?php 
                                        foreach ($category_list as $c_list)
                                        {
                                            ?>
                                            <option value="<?php echo $c_list->category_id ; ?>"><?php echo $c_list->category_name; ?></option>
                                            <?php
                                        }
                                    ?>
                               </select>
                               <span id="error_perent_category" class="text-danger"></span>
                            </div>
                        </div> 
                        <span id="cate_img_loder"></span>
                        <div id="product_category_id"></div>
                    </div>                   
                    <div class="row">                     
                        
                         <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Product Shipping<span class="text-danger">*</span></label>
                               <select class="form-control" id="product_shipping_id" name="product_shipping_id">
                                   <option value=""></option>
                                   <?php 
                                        foreach ($shipping_list as $s_list)
                                        {
                                            ?>
                                            <option value="<?php echo $s_list->shipping_id ; ?>"><?php echo $s_list->shipping_name; ?></option>
                                            <?php
                                        }
                                    ?>
                               </select>
                               <span id="error_product_shipping" class="text-danger"></span>
                            </div>
                        </div> 
                         <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Product Tax<span class="text-danger">*</span></label>
                               <select class="form-control" id="product_tax_id" name="product_tax_id">
                                   <option value=""></option>
                                   <?php 
                                        foreach ($tax_list as $t_list)
                                        {
                                            ?>
                                            <option value="<?php echo $t_list->tax_id ; ?>"><?php echo $t_list->tax_name; ?></option>
                                            <?php
                                        }
                                    ?>
                               </select>
                               <span id="error_product_tax" class="text-danger"></span>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Product Discount</label>
                               <select class="form-control" id="product_discount_id" name="product_discount_id">
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
                                <label>Manufacturer</label>
                               <select class="form-control" id="product_brand_id" name="product_brand_id">
                                   <option value=""></option>
                                   <?php 
                                        foreach ($brand_list as $b_list)
                                        {
                                            ?>
                                            <option value="<?php echo $b_list->brand_id ; ?>"><?php echo $b_list->brand_name; ?></option>
                                            <?php
                                        }
                                    ?>
                               </select>
                               <span id="error_product_brand" class="text-danger"></span>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Purchase Price</label>
                               <input type="text" name="product_purchase_price" id="product_purchase_price" placeholder="0.00" value="" class="form-control">
                               <span id="error_purchase_price" class="text-danger"></span>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <div class="input text" id="sale_price_input">
                                <label>MRP</label>
                               <input type="text" onkeyup="getMrpDiscount(this.value)" name="product_sale_price" id="product_sale_price" placeholder="0.00"  class="form-control">
                               <span id="error_sale_price" class="text-danger"></span>
                            </div>
                        </div>        
                        <div id="price_filter" style="display: none;">
                        <div class="form-group col-md-4">
                        <br>
                          <div class="input text">
                                <label>Including Taxes</label>&nbsp;
                                <input type="radio" checked="checked" value="include" id="include_tax" name="include_exclude_tax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <label>Excluded Taxes</label>&nbsp;
                                <input type="radio" id="exclude_tax" name="include_exclude_tax" value="exclude">
                          </div>
                        </div>  
                        <div class="form-group col-md-4">
                        <br>
                          <div class="input text">
                                <label>Default</label>&nbsp;
                                <input type="radio" checked="checked" id="check_custom_price" value="default" onclick="customPrice(this.value)" name="apply_price">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <label>Custom</label>&nbsp;
                                <input type="radio" onclick="customPrice(this.value)" id="check_custom_price" value="custom" name="apply_price">
                          </div>
                        </div>    
                        </div>                                
                    </div>  
                    <div class="row" id="custom_price" style="display: none;">
                        <div class="form-group col-md-3" id="custom_price_div">
                           <div class="input text"><label>Price For Dr. <span id="per_for_doctor"></span></label>
                              <input type="text" readonly="readonly" placeholder="0.00" name="price_for_doctor" id="price_for_doctor" value="" class="form-control">
                              <span id="error_sale_price" class="text-danger"></span>
                           </div>
                        </div>
                        <div class="form-group col-md-3" id="custom_price_div">
                           <div class="input text">
                               <label>Price For Chemist <span id="per_for_chemist"></span></label>
                               <input type="text" readonly="readonly" name="price_for_chemist" placeholder="0.00" id="price_for_chemist" value="" class="form-control"><span id="error_sale_price" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-3" id="custom_price_div">
                           <div class="input text">
                              <label>Price For Hospitalist <span id="per_for_hospitalist"></span></label>
                              <input type="text" readonly="readonly" placeholder="0.00" name="price_for_hospitalist" id="price_for_hospitalist" value="" class="form-control"><span id="error_sale_price" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-3" id="custom_price_div">
                           <div class="input text">
                              <label>Price For Pharma Wholesaler <span id="per_for_pharma"></span></label>
                              <input type="text" readonly="readonly" placeholder="0.00" name="price_for_pharma" id="price_for_pharma" value="" class="form-control"><span id="error_sale_price" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                          <div class="input text">
                                <label>Product Quntity</label>
                               <input type="number" name="product_qty" id="product_qty" value="" class="form-control">
                              <span id="error_qty" class="text-danger"></span>
                            </div>
                        </div>          
                        <div class="form-group col-md-4">
                            <div class="input text">
                             <label>Currency Type</label>
                                <select name="product_currency_type" id="product_currency_type" class="form-control" >
                                   <option value="INR">India Rupees – INR</option>
                                </select>
                              <span id="error_curcy_type" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Product Status</label>
                              <select class="form-control" name="product_status" >         
                                  <option value="1">Active</option>
                                  <option value="0">Deactive</option>
                              </select>
                               
                            </div>
                        </div>
                    </div>
                      <div class="row">                        
                          <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Expiry date</label>
                                <input type="text" class="form-control" id="expiry_date" name="expiry_date" >
                               <span id="error_expiry_date" class="text-danger"></span>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>HSN Code</label>
                               <input type="text" name="hsn_code" id="hsn_code" value="" class="form-control">
                               <span id="error_hsn_code" class="text-danger"></span>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Formula</label>
                               <input type="text" name="product_formula" id="product_formula" value="" class="form-control">
                               <span id="error_product_formula" class="text-danger"></span>
                            </div>
                        </div>        
                    </div>
                    <div class="row">
                     <div class="form-group col-md-3">
                            <div class="input text">
                                <label>Attribute</label><br>
                                 <button class="btn btn-success btn-sm" type="button" id="add_attr_box" ><i class="fa fa-plus"></i>&nbsp; Add Attribute</button>                                 
                            </div>
                        </div> 
                         <div class="form-group col-md-1">
                            <div class="input text">
                                <label>&nbsp;</label><br>
                                 <button class="btn btn-danger btn-sm" type="button" id="removeButton" style="display: none;"  ><i class="fa fa-remove"></i></button>                                 
                            </div>
                        </div> 
                         <div class="form-group col-md-4">
                          <div class="input text">
                                <label>Minimum Order Quantity</label>
                               <input type="number" min="1" name="product_moq" id="product_moq" value="1" class="form-control">
                              <span id="error_qty" class="text-danger"></span>
                            </div>
                        </div>                                 
                    </div>
                    <div id="attributeGroup">        
                                                      
                    </div>
                    <div class="row">
                     <br>
                         <div class="form-group col-md-12">
                            <div class="input text">
                                <label>Product Image</label>
                                <select id="product_img" name="product_img" class="image-picker show-html">          
                                      <option data-img-src="<?php echo base_url()?>webroot/product_images/tablate.png" value="<?php echo base_url()?>webroot/product_images/tablate.png"></option>
                                      <option data-img-src="<?php echo base_url()?>webroot/product_images/syrup.jpg" value="<?php echo base_url()?>webroot/product_images/syrup.jpg"></option>
                                      <option data-img-src="<?php echo base_url()?>webroot/product_images/injection.png" value="<?php echo base_url()?>webroot/product_images/injection.png"></option>
                                      <option data-img-src="<?php echo base_url()?>webroot/product_images/homeopathic.jpg" value="<?php echo base_url()?>webroot/product_images/homeopathic.jpg"></option> 
                                      <option data-img-src="<?php echo base_url()?>webroot/product_images/others.jpg" value="<?php echo base_url()?>webroot/product_images/others.jpg"></option>
                                  </select>
                                  </div>
                              </div>
                        </div>
                                
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input text">
                                <label>Product Description</label>
                              <textarea class="form-control" rows="6" name="product_description"><?php echo set_value('product_description');?> </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/product">Cancel</a>
                </div>
            </form>
           
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript" src="<?php echo base_url(); ?>webroot/image-picker/image-picker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webroot/image-picker/image-picker.min.js"></script>
<script type="text/javascript">
 $("#product_img").imagepicker();

   function getMrpDiscount(mrp)
   {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>admin/product/getMrpDiscountPriceList",         
            data: "mrp="+mrp,
            success: function(data)
            {
             
                 var JSONObject = JSON.parse(data);
                 $('#per_for_doctor').text(JSONObject.discountmrp_for_dr+'%');
                 $('#per_for_chemist').text(JSONObject.discountmrp_for_chemist+'%');
                 $('#per_for_pharma').text(JSONObject.discountmrp_for_pharma_wholseller+'%');
                 $('#per_for_hospitalist').text(JSONObject.discountmrp_for_hospitalist+'%');
                 $('#price_for_doctor').val(JSONObject.dr_price);
                 $('#price_for_chemist').val(JSONObject.chemist_price);
                 $('#price_for_pharma').val(JSONObject.pharma_price);
                 $('#price_for_hospitalist').val(JSONObject.hospitalist_price);
                 $('#custom_price').show();
                 $('#price_filter').show();
            }
          });
   }
 function customPrice(price_type)
 {
    if(price_type == 'custom')
    {
         $('#price_for_doctor').removeAttr('readonly');
         $('#price_for_chemist').removeAttr('readonly');
         $('#price_for_pharma').removeAttr('readonly');
         $('#price_for_hospitalist').removeAttr('readonly');
         $('#per_for_doctor').hide();
         $('#per_for_chemist').hide();
         $('#per_for_pharma').hide();
         $('#per_for_hospitalist').hide();
    }
    else
    {
         $('#price_for_doctor').attr('readonly' , true);
         $('#price_for_chemist').attr('readonly', true);
         $('#price_for_pharma').attr('readonly' , true);
         $('#price_for_hospitalist').attr('readonly' , true);
         $('#per_for_doctor').show();
         $('#per_for_chemist').show();
         $('#per_for_pharma').show();
         $('#per_for_hospitalist').show();
         getMrpDiscount($('#product_sale_price').val());
    }
 }
   
    function getAllMsmType(measurement_id)
    { 
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>admin/product/getAllMsmType",
            data:'measurement_id='+measurement_id,
            success: function(data){
                $("#msm_value").html(data);
            }
        });
    }

    $("#product_images").on("change", function (e) {
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
                        if(this.width > 600 && this.height > 400){
                            $("#previewImg").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>").insertAfter("#previewImg");
                        }
                        else{            
                         
                            $('#error_product_img').html("Image height width must be min (600*400).")
                            return false;
                        }
                        }
                });
                fileReader.readAsDataURL(f);
            }
    });

    $(function(){
      
            $('#expiry_date').datetimepicker({
                 format: 'Y-M-D'
            });    
    });

    function getParentSubCategory(category_id , parent_sub='')
    {       
        if(parent_sub == 'parent_sub')
        {
            $('#product_category_id').html('');
        }

        var str = 'category_id='+category_id;
        var PAGE = '<?php echo base_url(); ?>admin/product/getSubCategoryList';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,           
            success:function(data)
            {               
               $('#cate_img_loder').html('');
                if(data != "")
                {   
                  $('#product_category_id').append('<div class="form-group col-md-4"><div class="input text"><label>Parent Category</label><select onchange="getParentSubCategory(this.value,1)" name="category_id[]" id="category_sub_id" class="form-control" >'+data+'</select></div>');
                }                
            } 
        });
    }

$(document).ready(function()
 {



   var counter = 1;
    $("#add_attr_box").click(function () {
         $('#removeButton').show();
        
            var AttrTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'Attrbox' + counter);
            AttrTextBoxDiv.after().html(
             '<div class="row"><div class="form-group col-md-3"><div class="input text"><label>Attribute Name</label><input name="attribute_name[]" class="form-control" type="text" required id="Attribute_name"/></div></div>'+'<div class="form-group col-md-2"><div class="input text"><label>Attribute Value</label><input class="form-control" type="number" id="attribute_box_value'+counter+'" onkeyup="attribute_value_box('+counter+')"/></div></div></div><div id="show_attr_val'+counter+'"></div><input type="hidden" name="attr_counter[]" value="" id="attr_counter'+counter+'" />');

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

function attribute_value_box(str){ 
     var attribute_box_value = $('#attribute_box_value'+str).val();
     if(attribute_box_value){
        $('#show_attr_val'+str).html('');
        var i = '';
        for(i = 0 ; i < attribute_box_value; i++ ){
            $('#attr_counter'+str).val(i+1);
            $('#show_attr_val'+str).append('<div id="attr_val_box'+str+i+'"><div class="row"><div class="col-md-2"><div class="input text"><label>&nbsp;</label><input class="form-control" type="text" required name="attr_value[]" id="attr_value" value="" placeholder="Attribute Value" /></div></div><div class="col-md-2"><div class="input text"><label>&nbsp;</label><input class="form-control" type="number" required name="attr_value[]" id="attr_value" value="" placeholder="Attribute Price" /></div></div><div class="col-md-2"><div class="input text"><label>&nbsp;</label><input type="file" name="attr_img_'+i+'" id="attr_value" value="'+i+'" placeholder="Attribute Image" /><input type="hidden" name="attr_img_val[]" value="'+i+'" id="attr_img_val'+i+'" />&nbsp;&nbsp;</div></div><div class="col-md-1"><label>&nbsp;</label><br><button class="btn btn-danger btn-s" type="button" id="removeButton'+str+i+'" onclick="remove_attr_val('+str+','+i+')"><i class="fa fa-remove"></i></button></div></div>');//add input box
        }
     } 
}

function remove_attr_val(str,str2){
   // alert(str2); return false;
    $('#attr_val_box'+str+str2).remove();
    var attribute_box_value = $('#attribute_box_value'+str).val();
    var attr_counter = $('#attr_counter'+str).val();
    if(attribute_box_value == '1'){
      $('#attribute_box_value'+str).val('');
      $('#attr_counter'+str).val('');  
    }else{
        $('#attribute_box_value'+str).val(Number(attribute_box_value)-1);
        $('#attr_counter'+str).val(Number(attr_counter)-1);
    }
}

function checkProductForm(){
    //Get reference of FileUpload.
    var fileUpload = document.getElementById("product_thumb_img");
     
    if($('#measurement_type').val() == ''){
        
        $('#error_measurement_type').html('Measurement Type is required*'); 
        $('#measurement_type').focus();
        return false;
    }
    else
    {
        $('#error_measurement_type').html('');         
    }
  
    if($('#product_title').val() == ''){
        
        $('#error_product_title').html('Product Title is required*'); 
        $('#product_title').focus();
        return false;
    }
    else
    {
        $('#error_product_title').html('');         
    }   
   
    
    if($('#product_parent_cat_id').val() == ''){
        $('#error_perent_category').html('Parent Category is required*');
        $('#product_parent_cat_id').focus();
        return false;
    }
    else
    {
        $('#error_perent_category').html('');        
    }

    if($('#product_qty').val() == ''){
        $('#error_qty').html('Purchase Quntity is required*');
        $('#product_qty').focus();
        return false;
    }
    else
    {
        $('#error_qty').html('');
    } 

    if($('#expiry_date').val() == ''){
        $('#error_expiry_date').html('Expiry date is required*');
        $('#expiry_date').focus();
        return false;
    }
    else
    {
        $('#error_expiry_date').html('');
    }   

    if($('#hsn_code').val() == ''){
        $('#error_hsn_code').html('HSN Code is required*');
        $('#hsn_code').focus();
        return false;
    }
    else
    {
        $('#error_hsn_code').html('');
    }   

    if($('#product_formula').val() == ''){
        $('#error_product_formula').html('Product Formula is required*');
        $('#product_formula').focus();
        return false;
    }
    else
    {
        $('#error_product_formula').html('');
    }   
}

</script>