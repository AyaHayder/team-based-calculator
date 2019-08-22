<template>
  <div>
   	<div id="accordion" v-for="t in tickets">
       	<div class="card">
            <div class="card-header" :id="'PTicket'+ t.id">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" :data-target="'#collapsePTicket'+t.id" aria-expanded="false" :aria-controls="'collapsePTicket'+t.id">
                    Ticket:  {{t.id}}
                  </button>
                </h5>
            </div>
      		<div :id="'collapsePTicket'+t.id" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
    			<div class="card-body">
  					<div class="row">
                      <div class="col-md-6">
                        <h4 class="lead">Credit: {{t.credit}}</h4>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-md-2">
                        <p class="lead">Ticket processing</p>
                      </div>
                      <div class="col-md-10">
                        <b-progress :value="t.station_value" :max="max" variant="success" show-progress animated></b-progress>
                      </div>  
                    </div>
                    <div class="row">
                      <div class="col">
                        Station: {{t.station_name}}
                      </div>
                    </div>
                </div>
            </div> <!--end of collapse div-->
        </div> <!--end of card div-->
    </div> <!--end of accordion div -->
  </div> 
</template>

<script>
    export default {
    props:[],
    data() {
      return {
        tickets:[],
        max:100
      }
    },
    mounted(){
    	console.log(this.tickets);
      Echo.channel('pending-ticket').listen('PendingTicketsEvent', (ticket)=>{
	          this.tickets.push(ticket);
    	});
    }
  }
</script> 









                
                  
                  
              
          