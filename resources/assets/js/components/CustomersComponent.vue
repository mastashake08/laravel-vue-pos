<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Customers</div>

                    <div class="panel-body">
                      <transition name="fade">
                      <table class="table" v-if="ready">
                        <thead>
                        <tr>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Actions></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="customer in customers.data">
                         <td>{{customer.description}}</td>
                         <td>{{customer.email}}</td>
                         <td>
                           <div class="form-group">
                             <button class="btn btn-sm btn-info" v-on:click="createInvoice(customer)">Create Invoice</button>
                          </div>
                          <div class="form-group" v-if="customer.subscriptions.data.length < 1">
                            <button class="btn btn-sm btn-primary" v-on:click="openModal(customer)">Create Subscription</button>
                         </div>
                          <div class="form-group">
                            <button class="btn btn-sm btn-danger" v-on:click="deleteCustomer(customer.id)">Delete Customer</button>
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
            <select v-model="plan">
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
          var that = this;
          axios.get('/api/customer').then(function(data){
            that.customers = data.data;
            that.ready = true;
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/background.js').then(function(registration) {

                }, function(err) {
                  // registration failed :(
                  console.log('ServiceWorker registration failed: ', err);
                });
            }
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
      deleteCustomer:function(id){
        var that = this;
        axios.delete('/api/customer/'+id).then(function(data){
          alert('success');
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
