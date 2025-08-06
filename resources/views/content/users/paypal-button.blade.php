<style>
#response {
    display:none;
    color: #255625;
    padding: 10 20px;
    background: #c0efc0;
    border: #aadeab 1px solid;
    border-radius: 3px;
    margin-bottom: 20px;
}
</style>
<div id="response"></div>
<div id="paypal-button"></div>
<script src="{{ url('checkout.js') }}"></script>
<script>
	paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: '{{ $client_id }}'
    },
	commit: true,
    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: '{{ $price }}',
            currency: '{{ $currency }}'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
    	  document.getElementById("response").style.display = 'inline-block';
        document.getElementById("response").innerHTML = 'Thank you for making the payment!';
      });
    }
  }, '#paypal-button'); 
document.getElementById("paypal-button").onclick();
</script>
