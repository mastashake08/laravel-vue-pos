<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Customers</div>

                    <div class="panel-body table-responsive">
                      <transition name="fade">
                      <table class="table" v-if="ready">
                        <thead>
                        <tr>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(customer,index) in customers.data">
                         <td>{{customer.description}}</td>
                         <td>{{customer.email}}</td>
                         <td>
                           <div class="form-group">
                             <button class="btn btn-sm btn-info" v-on:click="createInvoice(customer)">  <span class="glyphicon glyphicon-envelope" data-toggle="tooltip" title="Send Invoice"></span></button>
                            <button v-if="customer.subscriptions.data.length < 1" class="btn btn-sm btn-primary" v-on:click="openModal(customer)"> <span class="glyphicon glyphicon-retweet" data-toggle="tooltip" title="Create Subscription"></span></button>
                            <button class="btn btn-sm btn-danger" v-on:click="deleteCustomer(index)"> <span class="glyphicon glyphicon-remove-circle" data-toggle="tooltip" title="Delete Customer"></span></button>
                         </div>
                         </td>
                        </tr>
                        </tbody>
                        </table>
                      </transition>
                        <fieldset>
                        <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control"   id="email" placeholder="Email Address Of Customer" v-model="customer.email">
                        </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-3 control-label" for="name">Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control"  id="name" placeholder="Name Of Customer" v-model="customer.name">
                      </div>
                    </div>

                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                          <button type="button" class="btn btn-success" v-on:click="createCustomer">Create New Customer</button>
                        </div>
                      </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
<div id="subscriptionModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Plan</h4>
      </div>
      <div class="modal-body">
        <transition name="fade">
          <div class="form-group" v-if="ready">
            <select  class="form-control" v-model="plan">
              <option selected>Select A Plan</option>
              <option  v-for="sub in plans.data" :value="sub"> {{sub.name}} - ${{sub.amount / 100}} </option>
            </select>
          </div>
        </transition>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" v-on:click="createSubscription(selectedCustomer,plan)">Send Activation Link</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
          customer:{
            'email':'',
            'name':''
          },
          customers: [],
          ready: false,
          selectedCustomer: {},
          plan:{},
          plans:[]
          }
          },
        created(){
           $('[data-toggle="tooltip"]').tooltip();
          var that = this;
          axios.get('/api/customer').then(function(data){
            that.customers = data.data;
            that.ready = true;
          });
        },
        methods: {
        createCustomer: function(){
        var that = this;
        axios.post('/api/customer',{customer: this.customer})
        .then(function(data){
          that.customers.data.push(data.data);
        }).catch(function(error){
        alert(error.message);
        });
      },
      deleteCustomer:function(index){
        var that = this;
        axios.delete('/api/customer/'+this.customers.data[index].id).then(function(data){
          that.customers.data.splice(index,1);
        });
      },
      createInvoice:function(customer){
        var that = this;
        var amount = prompt('How Much Is Invoice?');
        if(amount > 0){
          var desc = prompt('Enter Description.');
          axios.post('/api/invoice',{name: customer.description, amount: amount* 100, description: desc, email: customer.email}).then(function(data){
            alert('Invoice Sent!');
          });
        }

      },
      openModal:function(customer){
        this.selectedCustomer = customer;
        var that = this;
        $('#subscriptionModal').modal('show');
        axios.get('/api/plan').then(data => {
          that.plans = data.data;
          that.ready = true;
        });
      },
      createSubscription:function(customer,plan){
        axios.post('/api/subscription-activation',{customer:customer,plan:plan}).then(data => {
          alert('Email Activation Sent');
        });
      }

        }
    }
</script>
