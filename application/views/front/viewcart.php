<!-- banner -->
  <!-- <div class="banner banner1">
    <div class="container">
      <h2>Great Offers on <span>Mobiles</span> Flat <i>35% Discount</i></h2> 
    </div>
  </div>  -->
  <!-- breadcrumbs -->

  <div class="breadcrumb_dress">
    <div class="container">
      <ul>
        <li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
        <li>Products</li>
      </ul>
    </div>
  </div>
  <!-- //breadcrumbs --> 
<div class="cartt" style="padding: 35px 15px;">
 <div id="msg_div">
                        <?php echo $this->session->flashdata('confirm');?>
                    </div>
<?php
    if(empty($cart_list)){   ?>
        <h4 style='color:red; text-align:center;'>Your Cart Is Empty!</h4><br>
        <center><a href="<?php echo base_url();?>" style='color:blue;'>More Shopping</a></center>
<?php   }else{ ?>
    <div id="cartempty_msg">
    <form method="POST" onsubmit="return goTocheckout()">
    <table class="table" id="cartempty_msg">
      <thead>
          <th>Image</th>
          <th>Title</th>
          <th>Quntity</th>
          <th>Price</th>
          <th></th>
      </thead>
          <tbody>            
            <?php
               foreach ($cart_list as $crt_res) {
                
              ?>
                <tr id="cart_item<?php echo $crt_res['rowid'];?>" >
                    <td><img src="<?php echo $crt_res['product_image'];?>" width="100"></td>
                    <td><a href="<?php echo base_url();?>singleproduct/viewProductDetail/<?php echo $crt_res['id'];?>"><?php echo $crt_res['name'];?></a></td>
                    <td><input type="number" min="1" onchange="updateCartProductqty(this.value,'<?php echo $crt_res['rowid'];?>','<?php echo $crt_res['price'];?>')" id="cart_qty_value<?php echo $crt_res['rowid'];?>" style="width: 70px;" class="form-control" name="cart_qty" id="cart_qty" value="<?php echo $crt_res['qty'];?>"></td>
                    <td>Rs <?php echo $crt_res['price'];?></td>
                    <td><button onclick="removeCartItem('<?php echo $crt_res['rowid'];?>')" class="btn btn-danger btn xs"><i class="glyphicon glyphicon-remove"></i></button></td>
                    
                </tr> 
                <?php } ?>         
              <tr>                 
                  <th>Subtotal :</th>
                  <th></th>
                  <th></th>
                  <th id="cart_product_total">Rs <?php echo $this->cart->total();?></th>
                  <th><button type="submit" class="btn btn-primary" name="checkout">Checkout</button></th>

              </tr>
             
           </tbody>
       </table>
      </form>
    </div>
<?php }  ?>
  </div>
  
  <script type="text/javascript">
  
  function goTocheckout(product_id,category_id=''){

        <?php
         $session = $this->session->all_userdata(); 
    if(empty($session[0]))
    {  ?>
      $('#myModal88').modal('show');return false;
  <?php }else{
  ?>
  return true;
  <?php
  } ?>
        
    }
  </script>