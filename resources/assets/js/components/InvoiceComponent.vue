<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Make A Invoice</div>

                    <div class="panel-body">
                        <fieldset>
                        <div class="form-group">
                        <label class="col-sm-3 control-label" for="amount">Amount</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control"  min="1.00" max="10000.00" id="amount" placeholder="Amount To Charge" v-model="amount">
                        </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-3 control-label" for="name">Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control"  id="name" placeholder="Name To Charge" v-model="name">
                      </div>
                    </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control"  id="email" placeholder="Email Receipt" v-model="email">
                        </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-3 control-label" for="description">Description</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control"  id="description" placeholder="Credit Card Description"  v-model="description">
                      </div>
                    </div>

                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                          <button type="button" class="btn btn-success" v-on:click="createInvoice">Send Invoice <span class="glyphicon glyphicon-send"></span></button>
                        </div>
                      </div>
                        </fieldset>
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
        name: null,
        amount: null,
        email: null,
        description: null,
        invoices: []
        }
        },
        created(){
          var that = this;
          axios.get('/api/invoice').then(function(data){
            that.invoices = data.data.invoices;
          });
        },
        methods: {
        createInvoice: function(){
        var that = this;
        axios.post('/api/invoice',{name: this.name, amount: this.amount * 100, description: this.description, email: this.email})
        .then(function(data){
          that.invoices.push(data.data.invoice);
        alert('Success!')
        }).catch(function(error){
        alert(error.message);
        });
        }
        }
    }
</script>
