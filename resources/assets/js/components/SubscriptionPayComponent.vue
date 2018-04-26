<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Activate Subscription</div>

                    <div class="panel-body">
                        
                        <button v-on:click="activateSubscription()" class="btn btn-primary">Pay</button>
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
          paymentRequest: null
        }
        },
        created(){
        },
        methods: {
        activateSubscription: function(){
          const supportedPaymentMethods = [
            {
              supportedMethods: 'basic-card',
            }
          ];
          const paymentDetails = {
            total: {
              label: 'New Subscription',
              amount:{
                currency: 'USD',
                value: this.amount/100
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
          var that = this;
          this.paymentRequest.show().then(pay => {
          var paydata = pay
            axios.post('/api/subscription',{pay,customer:that.customer,plan:that.plan}).then(data => {
              alert('Success');
              console.log(paydata);
              return pay.complete();
            })
          }).catch(pay =>{
            return pay.complete();
          });

        },
      },
      props: ['customer','plan','amount']
        }

</script>
