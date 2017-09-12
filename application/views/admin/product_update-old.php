<style>
.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
#country-list{z-index: 9999; float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
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
                    <?php 
                   
                    foreach ($product_edit as $prd_value) 
                    {
                     ?>
                      <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Product Title<span class="text-danger">*</span></label>
                                <input name="product_title" class="form-control" type="text" id="product_title" value="<?php echo $prd_value->product_title;?>" />
                               <span id="error_product_title" class="text-danger"></span>
                            </div>
                        </div>                                                             
                        
                         <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Product Shipping<span class="text-danger">*</span></label>
                               <select class="form-control" id="product_shipping_id" name="product_shipping_id">
                                   <option value=""></option>
                                   <?php 
                                        foreach ($shipping_list as $s_list)
                                        {
                                            ?>
                                            <option  <?php if($s_list->shipping_id == $prd_value->product_shipping_id){ echo "selected";} ?> value="<?php echo $s_list->shipping_id ; ?>"><?php echo $s_list->shipping_name; ?></option>
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
                                            <option <?php if($t_list->tax_id == $prd_value->product_tax_id){ echo "selected";} ?> value="<?php echo $t_list->tax_id ; ?>"><?php echo $t_list->tax_name; ?></option>
                                            <?php
                                        }
                                    ?>
                               </select>
                               <span id="error_product_tax" class="text-danger"></span>
                            </div>
                        </div> 
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Product Discount</label>
                               <select class="form-control" id="product_discount_id" name="product_discount_id">
                                   <option value=""></option>
                                   <?php 
                                        foreach ($discount_list as $d_list)
                                        {
                                            ?>
                                            <option <?php if($d_list->discount_id == $prd_value->product_discount_id){ echo "selected";} ?> value="<?php echo $d_list->discount_id ; ?>"><?php echo $d_list->discount_name; ?></option>
                                            <?php
                                        }
                                    ?>
                               </select>
                               
                            </div>
                        </div>                           
                          
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Purchase Price</label>
                               <input type="text" value="<?php echo $prd_value->product_purchase_price;?>" name="product_purchase_price" id="product_purchase_price" class="form-control">
                               <span id="error_purchase_price" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                          <div class="input text">
                                <label>Sale Price</label>
                               <input type="text" name="product_sale_price" id="product_sale_price" value="<?php echo $prd_value->product_sale_price;?>" class="form-control">
                               <span id="error_sale_price" class="text-danger"></span>
                            </div>
                        </div>                   
                    </div>
                     <div class="row">
                      <div class="form-group col-md-4">
                          <div class="input text">
                                <label>Product Quntity</label>
                               <input type="number" name="product_qty" id="product_qty" value="<?php echo $prd_value->product_qty;?>" class="form-control">
                              <span id="error_qty" class="text-danger"></span>
                            </div>
                        </div>          
                      
                        <?php if($session[0]->user_role_id != 2)
                        {
                        ?>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Product Status</label>
                              <select class="form-control" name="product_status" >         
                                  <option <?php if($prd_value->product_status == 1){ echo "selected";} ?> value="1">Active</option>
                                  <option <?php if($prd_value->product_status == 0){ echo "selected";} ?> value="0">Deactive</option>
                              </select>
                               
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>  
                     <div class="row">                        
                          <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Expiry date</label>
                                <input type="text" class="form-control" value="<?php echo $prd_value->expiry_date;?>" id="expiry_date" name="expiry_date" >
                               <span id="error_expiry_date" class="text-danger"></span>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>HSN Code</label>
                               <input type="text" name="hsn_code" id="hsn_code" value="<?php echo $prd_value->hsn_code;?>" class="form-control">
                               <span id="error_hsn_code" class="text-danger"></span>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Formula</label>
                               <input type="text" name="product_formula" id="product_formula" value="<?php echo $prd_value->product_formula;?>" class="form-control">
                               <span id="error_product_formula" class="text-danger"></span>
                            </div>
                        </div>        
                    </div>                
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input text">
                                <label>Product Description</label>
                              <textarea class="form-control" rows="6" name="product_description"><?php echo $prd_value->product_description;?> </textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <?php } ?>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" >Update</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/product">Cancel</a>
                </div>
            </form>
           
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">


function checkProductForm()
{
   

    if($('#product_title').val() == ''){
        
        $('#error_product_title').html('Product Title is required*'); 
        $('#product_title').focus();
        return false;
    }
    else
    {
        $('#error_product_title').html('');         
    }     
    
    if($('#product_purchase_price').val() == ''){
        $('#error_purchase_price').html('Purchase Price is required*');
        $('#product_shipping_id').focus();
       return false;
    }
    else
    {
        if (!$.isNumeric($('#product_purchase_price').val()))
        {            
            $('#error_purchase_price').html('Purchase Price Is Must Be Numeric!');
            $('#product_shipping_id').focus();
            return false;
        }
        else
        {                
           $('#error_purchase_price').html('');                       
        }   
    }

    if($('#product_sale_price').val() == ''){
        $('#error_sale_price').html('Purchase Sale is required*');
        $('#product_sale_price').focus();
        return false;
    }
    else
    {
        if (!$.isNumeric($('#product_sale_price').val()))
        {            
            $('#error_sale_price').html('Sale Price Is Must Be Numeric!');
            $('#product_sale_price').focus();
            return false;
        }
        else
        {                
           $('#error_sale_price').html(''); 
        }   
              
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

  return true;

}
</script>