<template>
    <div class="mb-3">
      <h3 class="text-center mb-3" v-if="showTickets">Total tickets: {{total}}</h3>
      <h3 class="text-center mb-3" v-else> Total tickets: 0</h3>

      <p class="lead my-3" v-if="showPending">Pending tickets: {{pending}}</p>
      <p class="lead my-3" v-else>Pending tickets: 0</p>
      <b-progress class="my-3" :value="pending" :max="total" variant="primary" show-progress animated></b-progress>

       <p class="lead my-3" v-if="showArchived">Archived tickets: {{archived}}</p>
       <p class="lead my-3" v-else>Archived tickets: 0</p>
      <b-progress :value="archived" :max="total" variant="primary" show-progress animated></b-progress>

      <b-toast id="my-toast" variant="primary" solid>
      <div slot="toast-title" class="d-flex flex-grow-1 align-items-baseline">
        <img src="svg/two-tickets-svgrepo-com.svg" style="width:20px" class="mr-3">
        <strong class="mr-auto">Notice!</strong>
      </div>
      A new ticket was submitted
    </b-toast>
  </div>
</template>
<script>
    export default {
    props:[ 'tickets_no', 'pending_no', 'archived_no'],
    data() {
      return {
        pending:Number(this.pending_no),
        archived:Number(this.archived_no),
        total:Number(this.tickets_no),
        showTickets:false,
        showPending:false,
        showArchived:false
      }
    },
    mounted(){
        if(this.total >0){
          this.showTickets = true;
          if(this.pending >0){
            this.showPending = true;
          }
          if(this.archived >0){
            this.showArchived = true;
          }
        }
        Echo.channel('ticket-processing').listen('TicketStatusEvent', (tickets)=>
        {
          this.$bvToast.show('my-toast')
          this.pending = Number(tickets.pending);
          this.archived = Number(tickets.archived);
          this.total = Number(tickets.total);
        });

    }
  }
</script> 