// Render the PayPal button

paypal.Button.render({

    // Set your environment

    env: 'production', // sandbox | production

    // Specify the style of the button

    style: {
        locale: 'en_UK',
        label: 'paypal',
        size:  'medium',    // small | medium | large | responsive
        shape: 'rect',     // pill | rect
        color: 'blue',     // gold | blue | silver | black
        tagline: false
    },

    // Show the buyer a 'Pay Now' button in the checkout flow
    commit: true,

    // Set perams -
    client: {
        sandbox:    'AQLmVmEXHmQSx9sb0hgg0kkIHJmBaM1bbFflMbOVUgxTLCLSdZnrxrx-eDzlNe_vyv5u-GLqmtUX_BtW',
        production: 'AXnkV6zbtFhuuWHQZtjjr8cFXOSS2ayLNPea2007ETV2j4iWHdQUQ-I2ReFVUMDRWxKNfSd2mE4cFnpM'
    },

    payment: function(data, actions) {

        const cart_total = parseFloat($("#cart_total").val());
        const total_amount = parseFloat($("#total_amount").val());
        const shop_id = $("#shop_id").val();


        return actions.payment.create({
            payment: {
                transactions: [{

                    amount: {
                        total: total_amount,
                        currency: 'GBP',

                        details: {
                            subtotal: cart_total,
                        }
                    },

                    description: 'East Knoyle Flower and Vegetable Show',
                    custom: shop_id,
                }],
            }
        });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            // Redirect to the payment process page
            window.location = "paid.php?paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+shop_id;
        });
    },
}, '#paypal-button-container');

