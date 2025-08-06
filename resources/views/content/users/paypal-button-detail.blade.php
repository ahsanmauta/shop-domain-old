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
    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: '18.00',
            currency: 'USD',
            details: {
              subtotal: '18.00',
              //tax: '0.01',
              //shipping: '0.01',
              //handling_fee: '0.01',
              //shipping_discount: '-1.00',
              //insurance: '0.01'
            }
          },
          description: 'Transaction Description',
          custom: '90048630024435',
          invoice_number: 'D123231',
          payment_options: {
            allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
          },
          soft_descriptor: 'ECHI5786786',
          item_list: {
            items: [
            {
              name: 'ToyCar',
              description: 'MetalCar',
              quantity: '1',
              price: '3',
              //tax: '0.01',
              sku: '1',
              currency: 'USD'
            },
            {
              name: 'FidgetSpinner',
              description: 'Metal',
              quantity: '1',
              price: '15',
              //tax: '0.02',
              sku: '2',
              currency: 'USD'
            }],
            shipping_address: {
              recipient_name: 'Martha Jelinson',
              line1: '5th Floor',
              line2: '#6',
              city: 'San Jose',
              country_code: 'US',
              postal_code: '32323',
              phone: '0123456789',
              state: 'CA'
            }
          }
        }],
        note_to_payer: 'Feel free to Contact admin to know your order status.'
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

</script>
