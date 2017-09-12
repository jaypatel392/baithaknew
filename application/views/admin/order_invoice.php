<!DOCTYPE html>
<html>
<head>
  <title>Bacs Pro V</title>
 <!--  <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"> -->
  <style type="text/css">
    body{
      width: 21cm;
      height: 29.7cm;
      margin: 0px auto;
    }
    h1,h2,h3,h4,h5,h6,p{
      margin: 5px 0px;
    }
    .logo h1{
      font-size: 48px;
      color: #2b59a5;
    }
    .header{
      text-align: center;
    }
    .header .bg_image{
      padding: 0px;
    }
    .header img{
      float: right;
    }
    table{
      width: 100%;
      border-collapse: collapse;
      background: #f2f2f3;
    }
    .text-left{
      text-align: left;
    }
    .text-center{
      text-align: center;
    }
    .text-left{
      text-align: left;
    }
    .text-right{
      text-align: right;
    }
    .person_name{
      color: #1ec4f4;
    }

    .left_border{
      border-left: 3px solid #4ed0f6;
    }
    .grey_bg td{
      background-color: #f2f2f3;
      padding: 10px 10px;
    }
    .black_bg{
      background-color: #30343a;
      padding: 5px;
    }
    .black_bg td{
      background-color: transparent;
      padding: 10px 10px;
      color: #fff;
    }
    .small{
      font-size: 11px;
        color: grey;
    }
    .tr_rows td{
      border-bottom: 1px solid #2a92b1;
    }
    .tr_rows .border_none{
      border: 0px solid transparent;
    }
    .table_bg{
      min-height: 371px;
      background: #f2f2f3;
      /*border-bottom: 1px solid #2a92b1;*/
    }
    .left_div{
      width: 57%;
      float: left;
      padding-top: 15px;
    }
    .right_div{
      width: 66%;
      float: right;
    }
    .right_div table td{
      font-size: 15px;
      background: #f2f2f3;
      padding: 10px;
    }
    .right_div table td:nth-child(1){
      text-align: right;
    }
    .right_div table tr:nth-child(1) td{
      background: #e2e2e2;
      font-size: 16px;
    }
    .right_div table tr text-decoration: {
      font-size: 16px;
    }
    .blue_text{
      color: #00aeef;
    }
    .blue_bg,.blue_bg td{
      background: #00aeef !important;
      color: #fff;
      padding: 10px 15px;
    }
    .sign_div .div_para{
      text-align: center;
      
      width: 70%;
      float: right;
      margin-top: 40px;
      margin-right: 20px;
    }
    .sign_div .div_para span{
      border-bottom: 1px solid #000;
          width: 100%;
    display: block;
    margin-bottom: 5px;
    }
    .address{
      margin-top: 45px;
    }
    .address tr td:nth-child(1){
      width: 35px;
      padding-left: 0px;
    }
    .terms_div{
          text-align: right;
          margin-top: 50px;
          border-top: 1px solid #2a92b1;
          display: inline-block;
          float: right;
          width: 100%;
          padding-top: 20px;
    }
    .address-table tbody tr td {line-height: 21px;}
    .align_center td{text-align: center;}
  </style>
</head>
<body>
  <table class="header">
    <tbody>
      <tr>
        <td style="text-align: left;" class="logo" width="50%"><h1>Atom</h1></td>
        <td style="text-align: right; padding-right: 8px;" class="logo"><h1>Invoice</h1></td>
     </tr>
     
    </tbody>
  </table>
  <table class="address-table">
    <tbody>
    <tr>
      <td style="padding-left: 10px;">Email Address : atominfo@gmail.com<br>
      Contact Number : 1234567890<br>
      Address : Indore mp.<br>
      GST Number : 4234234 <br>
      Drug Licence : abcd12333
      </td>
      <td style="text-align: right; vertical-align: top;padding-right: 20px;">Date: <?php echo date('Y-m-d'); ?><br>
       Invoice Number : <?php echo $order_details->unic_order_id; ?>
      </td>
    </tr>
    <tr>
        <td colspan="4">&nbsp;</td>
      </tr>

    </tbody>
  </table>

  <table class="address-table">
    <tbody>  
     <tr>
        <td class="text-left" style="padding-bottom: 10px; padding-right: 10px;" width="50%">
          <div style="background: #00aeef;color: #fff;padding: 5px 10px;">
            <h4>Delivery Address</h4>          
          </div>
        </td>
        <td class="text-left" style="padding-bottom: 10px; padding-left: 10px;">
          <div style="background: #00aeef;color: #fff;padding: 5px 10px;">
            <h4>Billing Address</h4>          
          </div>
        </td>
    </tr>
    <tr>
      <td style="padding-left: 10px;">
        <?php echo 'Name: '.$delivery_address->user_address_name.'<br> Address: '.$delivery_address->user_address_1.','; if($delivery_address->user_address_2 != ''){ echo $delivery_address->user_address_2.','; } 
      echo $delivery_address->user_address_city.',<br>'.$delivery_address->state_name.','.$delivery_address->user_address_postalcode.'<br>' ; ?>
        Phone : <?php echo $delivery_address->user_address_mobile; ?><br>
        GST Number : <?php echo $order_details->gstn; ?><br>
        Drug Licence : <?php echo $order_details->drug_licence; ?><br>
        Shop Establishment Id : <?php echo $order_details->shop_establishment_id; ?>
      </td>
      <td style="padding-left: 16px; vertical-align: top;">
        <?php echo 'Name: '.$billing_address->user_address_name.'<br> Address: '.$billing_address->user_address_1.','; if($billing_address->user_address_2 != ''){ echo $billing_address->user_address_2.','; } 
      echo $billing_address->user_address_city.',<br>'.$billing_address->state_name.','.$billing_address->user_address_postalcode.'<br>' ; ?>
        Phone : <?php echo $billing_address->user_address_mobile; ?><br>
          GST Number : <?php echo $order_details->gstn; ?><br>
        Drug Licence : <?php echo $order_details->drug_licence; ?><br>
        Shop Establishment Id : <?php echo $order_details->shop_establishment_id; ?>
      </td>
    </tr>
    <tr>
        <td colspan="4">&nbsp;</td>
    </tr>
    </tbody>
  </table>
  <div class="table_bg">
    <table class="grey_bg">
      <tbody>
        <tr class="black_bg ">
          <td>Product Name</td>
          <td class="left_border">Qty.</td>
          <td class="left_border">Price (Exc. tax)</td>
          <td class="left_border">Price (Inc. tax)</td>
          <td class="left_border">Total Price (Exc. tax)</td>         
        </tr>
        <?php 
        $total_p_price= 0;
        $sub_total = 0;
        $tax_per_array = array();
        $i = 0;
        foreach ($order_products as $op_res) 
        {
          $base_price = $op_res->main_price;
          if($op_res->discount_value != 0)
          {
            if($op_res->discount_type == 'Fix')
            {
              $base_price = $op_res->main_price-$op_res->discount_value;
            }
            else
            {
              $base_price =  $op_res->main_price-($op_res->main_price * $op_res->discount_value)/100;
            }
          }
          $total_p_price = $base_price*$op_res->cart_product_qty;
          $tax_per_array[] = $op_res->tax_value; 
          $product_price[] = $base_price; 
          $tax_price[] = $total_p_price+($total_p_price * $op_res->tax_value)/100-$total_p_price;  
          $sub_total = $sub_total+$total_p_price;          
         ?>
          <tr class="tr_rows ">
            <td><?php echo $op_res->product_title;
            if($op_res->discount_value != 0)
              {
                ?>
                <div style="margin-top: 5px; padding: 3px;">
                (<?php
                if($op_res->discount_type == 'Fix')
                {
                  echo 'Rs. '.$op_res->discount_value;
                }
                else
                {
                  echo $op_res->discount_value.'%';
                }
                ?> Discount)</div>
                <?php
              }
             ?>
             </td>
            <td><?php echo $op_res->cart_product_qty; ?>
            </td>
            <td><?php echo 'Rs. '.number_format((float)$base_price, 2, '.', ''); ?></td>
            <td><?php echo 'Rs. '.number_format((float)$op_res->cart_total_price, 2, '.', ''); ?></td>
            <td><?php echo 'Rs. '.number_format((float)$total_p_price, 2, '.', ''); ?></td>
          </tr>
        <?php
        $i++;
        }
        $tax_unic_array = array_unique($tax_per_array); 
        foreach($tax_unic_array as $tu_val)
        {
          $t_price = 0;
          $count_arr = array_keys($tax_per_array,$tu_val);      
          // $tax_group_array[] = $tu_val * sizeof($count_arr);
          foreach ($count_arr as $ak_val) 
          {
            $t_price = $t_price+$tax_price[$ak_val];
          }
          $main_array[] = array('Price'=>$t_price,'Tax_value'=>$tu_val); 
        }
        ?>
      </tbody>
    </table>
     <div class="right_div">
    <table>
      <tbody>
        <tr>
          <td>Subtotal (Exc. tax) :</td>
          <td style="padding-left: 90px;"><?php echo 'Rs. '.number_format((float)$sub_total, 2, '.', '');?></td>
        </tr>
        <?php
        $total_tax_price=0;
        foreach ($main_array as $mtp_res) 
        {        
          $total_tax_price = $total_tax_price+$mtp_res['Price'];
          if(1492 == $delivery_address->user_address_state_id)
          {
            for ($i=0; $i < 2; $i++) 
            { 
              if($i == 0)
              {
              ?>
                <tr>
                  <td>CGST <?php echo '@'.$mtp_res['Tax_value']/2; ?>% :</td>
                  <td style="padding-left: 90px;"><?php echo 'Rs. '.number_format((float)$mtp_res['Price']/2, 2, '.', ''); ?></td>
                </tr>                
              <?php
              }
              else
              {
                ?>
                <tr>
                  <td>SGST <?php echo '@'.$mtp_res['Tax_value']/2; ?>% :</td>
                  <td style="padding-left: 90px;"><?php echo 'Rs. '.number_format((float)$mtp_res['Price']/2, 2, '.', ''); ?></td>
                </tr>  
                <?php
              }
            }
          }
          else
          {
            ?>
             <tr>
                  <td>IGST <?php echo '@'.$mtp_res['Tax_value']; ?>% :</td>
                  <td style="padding-left: 90px;"><?php echo 'Rs. '.$mtp_res['Price']; ?></td>
            </tr>  
            <?php
          }      
        }
        $grand_total = $sub_total+$total_tax_price;
        ?>       
        <tr class="blue_bg">
          <td style="font-size: 17px; font-weight: 600;">Total (Inc. tax):</td>
          <td style="font-size: 17px; font-weight: 600; padding-left: 90px;"><?php echo 'Rs. '.number_format((float)$grand_total, 2, '.', ''); ?> /-</td>
        </tr>
      </tbody>
    </table>
 </div>
  </div>
 
</body>
</html>