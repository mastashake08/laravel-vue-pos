<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage Subscriptions</div>

                    <div class="panel-body">
                        <fieldset>
                        <div class="form-group">
                        <label class="col-sm-3 control-label" for="amount">Amount</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control"  min="1.00" max="10000.00" id="amount" placeholder="Amount To Charge" v-model="plan.amount">
                        </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-3 control-label" for="name">Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control"  id="name" placeholder="Name To Plan" v-model="plan.name">
                      </div>
                    </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">Interval</label>
                        <div class="col-sm-9">
                          <select v-model="plan.interval" class="form-control">
                            <option value="day">Day</option>
                            <option value="week">Week</option>
                            <option value="month" selected>Month</option>
                            <option value="year">Year</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                          <button type="button" class="btn btn-success" v-on:click="createPlan">Create Plan <span class="glyphicon glyphicon-calendar"></span></button>
                        </div>
                      </div>
                        </fieldset>
                    </div>
                    <hr>
                    <transition name="fade">
                    <ul if="ready">
                      <li v-for="plan in plans.data">{{plan.id}} - ${{plan.amount/100}}</li>
                    </ul>
                  </transition>
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
        plan: {
          amount: 0,
          interval: 'month',
          name: ''
        },
        ready: false,
        plans: []
        }
        },
        created(){
          var that = this;
          axios.get('/api/plan').then(function(data){
            that.plans = data.data;
            that.ready = true;
          });
        },
        methods: {
        createPlan: function(){
        var that = this;
        axios.post('/api/plan',{plan: this.plan})
        .then(function(data){
          that.plans.data.push(data.data);
        alert('Success!')
        }).catch(function(error){
        alert(error.message);
        });
        }
        }
    }
</script>
