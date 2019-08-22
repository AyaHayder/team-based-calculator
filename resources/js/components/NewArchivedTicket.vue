<template>
  <div>
   	<div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
          <div id="accordion"  v-for="archivedTicket in tickets">
            <div class="card">
              <div class="card-header" id="'ticket'+ archivedTicket.id">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" :data-target="'#collapseticket'+archivedTicket.id" :aria-controls = "'collapseticket'+archivedTicket.id">
                    View ticket: {{archivedTicket.id}}
                  </button>
                </h5>
              </div>
              <div :id="'collapseticket'+archivedTicket.id" class="collapse" :aria-labelledby="'ticket'+archivedTicket.id" data-parent="#accordion">
                <div class="card-body">
                  <div class="row justify-content-center">
                    <p class="lead">current credit: {{archivedTicket.credit}}</p>
                  </div>
                  <div class="row justify-content-center">
                    <h3 class="display-4">Ticket history</h3>
                  </div>
                  <hr>
                <div class="row justify-content-center">
                 <div  v-for="(history,index) in ticketsHistory">
                   <div class="col" v-if="history.ticket_id == archivedTicket.id">
                   <p class="lead">Credit: {{history.credit}} 
                    <img src="svg/arrow-right.svg" alt=""  v-if="index !== (ticketsHistory.length-1)">
                  </p><br>
                  <div v-if="history.user == null">
                    <p class="lead">Initial credit</p>
                  </div>
                  <div v-else>
                    <p class="lead" v-if="history.user.role !== 'supervisor'">
                      Updated by: <br>{{history.user.first_name}} {{history.user.last_name}}</p>
                      <p class="lead" v-else>Archived by: <br>{{history.user.first_name}} {{history.user.last_name}}</p><br>
                      <p class="lead">role: {{history.user.role}}</p>
                  </div>
                  </div>
                 </div>
                </div>
              </div>
            </div><!-- collapse -->
          </div> <!-- card -->  
        </div> <!--accordion -->
      </div>
    </div>
</template>

<script>
    export default {
    props:[],
    data() {
      return {
        tickets:[],
      }
    },
    mounted(){
    	console.log(this.tickets);
      Echo.channel('archived-ticket').listen('ArchivedTicketsEvent', (ticket)=>{
	          this.tickets.push(ticket);
    	});
    }
  }
</script>