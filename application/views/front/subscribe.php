    <style type="text/css">
        .razorpay-payment-button{
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 10px;
            width: 10%;
            box-sizing: border-box;           
            color: #2C3E50;
            font-size: 15px;
            margin-top: 22px;
            text-align: center;
            margin-left: 45%;

        }
    </style>
    <br><br>
    <p style="text-align: center; font-size: 16px;"><b>Total amount : <?php echo 'Rs.'.$data['amount']; ?></b></p>
    <br>
    <form action="<?php echo base_url()?>userlogin/verifySubscribe" id="subscribe_form" method="POST">

    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?php echo $data['key'];?>"
        data-amount="<?php echo $data['amount'];?>"
        data-currency="INR"
        data-name="<?php echo $data['name'];?>"
        data-image="<?php echo $data['image'];?>"                    
        data-prefill.name="<?php echo $data['prefill']['name'];?>"
        data-prefill.email="<?php echo $data['prefill']['email'];?>"
        data-prefill.contact="<?php echo $data['prefill']['contact'];?>"

        data-order_id="<?php echo $data['order_id']?>"
    <?php if ($data['display_currency'] !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($data['display_currency'] !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
    >
    </script>
    <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
    <input type="hidden" name="shopping_order_id" value="<?php echo time();?>">
    </form>    
    <script type="text/javascript">
      
    $( document ).ready(function() {
        $( ".razorpay-payment-button" ).trigger( "click" );
          $( "#modal-close" ).click(function() {
        alert( "Handler for .click() called." );
        });
    });
     
    </script>
  