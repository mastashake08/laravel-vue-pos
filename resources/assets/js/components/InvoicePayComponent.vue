<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Make A Invoice</div>

                    <div class="panel-body">
                        Your total amount due is {{invoice.amount / 100}}
                        <br>
                        {{invoice.description}}
                        <br>
                        <button :click="payInvoice()" class="btn btn-primary">Pay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
        return{
          invoice: null,
          paymentRequest: null
        }
        },
        created(){
          this.invoice = JSON.parse(this.invoiceObject);
        },
        methods: {
        payInvoice: function(){
          const supportedPaymentMethods = [
            {
              supportedMethods: 'basic-card',
            }
          ];
          const paymentDetails = {
            total: {
              label: 'Total',
              amount:{
                currency: 'USD',
                value: this.invoice.amount/100
              }
            }
          };
          // Options isn't required.
          const options = {};

          this.paymentRequest = new PaymentRequest(
            supportedPaymentMethods,
            paymentDetails,
            options
          );
          this.paymentRequest.show().then(function(data){
            console.log(data);
          }).catch(function(err){
            console.log(err);
          });

        },
      },
      props: ['invoiceObject']
        }

</script>
