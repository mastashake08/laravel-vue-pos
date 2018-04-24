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
                        <tr v-for="customer in customers">
                         <td>{{customer.name}}</td>
                         <td>{{customer.email}}</td>
                         <td>
                           <div class="form-group">
                             <button class="btn btn-sm btn-info">Create Invoice</button>
                          </div>
                          <div class="form-group">
                            <button class="btn btn-sm btn-danger">Delete Customer</button>
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
          ready: false
          }
          },
        created(){
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
          that.invoices.push(data.data);
        }).catch(function(error){
        alert(error.message);
        });
      },

        }
    }
</script>
