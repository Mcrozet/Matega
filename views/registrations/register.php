<?php ob_start(); ?>

  <script src="https://www.paypal.com/sdk/js?client-id=AagOkhBluNat-GN1w0uSabPzz2MQYOwK0uUGfMCZoaFtdTDhx4OlqwaZfM7gq05UKv6e3ED0uYstdR0Y"></script>
<script>paypal.Buttons().render('body');</script>

<div id="paypal-button-container"></div>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR" data-sdk-integration-source="button-factory"></script>
<script>
  paypal.Buttons({
      style: {
          shape: 'pill',
          color: 'silver',
          layout: 'vertical',
          label: 'pay',
          
      },
      createOrder: function(data, actions) {
          return actions.order.create({
              purchase_units: [{
                  amount: {
                      value: '0.01'
                  }
              }]
          });
      },
      onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
              alert('Transaction completed by ' + details.payer.name.given_name + '!');
          });
      }
  }).render('#paypal-button-container');
</script>
<?php $contentIndex = ob_get_clean(); ?>

<?php require 'views/templates/index.php'; ?>