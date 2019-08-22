<template>
    <div class="row">
      <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab-tab">
          <div id="accordion" v-for="pendingTicket in pendingTickets">
            <div class="card">
              <div class="card-header" :id="'PTicket'+ pendingTicket.id">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" :data-target="'#collapsePTicket'+pendingTicket.id" aria-expanded="false" :aria-controls="'collapsePTicket'+pendingTicket.id">
                    Ticket:  {{pendingTicket.id}}
                  </button>
                </h5>
              </div>
              <div :id="'collapsePTicket'+pendingTicket.id" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <h4 class="lead">Credit: {{pendingTicket.credit}}</h4>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-md-2">
                        <p class="lead">Ticket processing</p>
                      </div>
                      <div class="col-md-10" v-for="(s,index) in pendingTicket.station">
                        <div v-if="index == (pendingTicket.station.length- 1)">
                          <b-progress :value="s.value" :max="max" variant="success" show-progress animated></b-progress>
                        </div>
                      </div>  
                    </div>
                    <div class="row">
                      <div class="col" v-for="(station,index) in pendingTicket.station">
                        Station: {{station.name}}
                        <img src="svg/arrow-right.svg" alt="" v-if="index !== (pendingTicket.station.length -1)">
                      </div>
                    </div>
                  </div>
                </div> <!--end of collapse div-->
              </div> <!--end of card div-->
            </div> <!--end of accordion div -->
          </div>
        <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
          <div id="accordion"  v-for="archivedTicket in archivedTickets">
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
  </div>
    <!-- <b-progress :value="percentNew" :max="max" variant="success" show-progress animated></b-progress> -->
</template>

<script>
    export default {
    props:['pending', 'archived', 'history'],
    data() {
      return {
        pendingTickets:JSON.parse(this.pending),
         archivedTickets:JSON.parse(this.archived),
         ticketsHistory:JSON.parse(this.history),
         max:100,
         pendingTicketCredit:0,
         progressValue:0,
         stationName:''
        // percentNew: Number(this.percent),
        // max:100
      }
    },

    methods:{
      convert_to_object: function(){
        var newJson = this.pendingTickets.replace("/([a-zA-Z0-9]+?):/g", '"$1":');
        newJson = newJson.replace("/'/g", '"');
        var data = JSON.parse(newJson);
        this.pendingTickets = data;

        newJson = this.archivedTickets.replace("/([a-zA-Z0-9]+?):/g", '"$1":');
        newJson = newJson.replace("/'/g", '"');
        data = JSON.parse(newJson); 

      }
    },

    mounted(){
      console.log(this.ticketsHistory)

      Echo.channel('pending-ticket').listen('PendingTicketEvent', (ticket)=>
        {
            this.pendingTicketCredit = Number(ticket.credit);
            this.progressValue = Number(ticket.station_value);
            this.stationName = ticket.station_name;
        });
    }
  }
</script> 

