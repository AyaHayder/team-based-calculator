<template>
	<div>
		<h4 class="lead">Credit: {{ ticketCredit }}</h4>
		<b-toast :id="'my-toast'+id" variant="primary" solid>
      <div slot="toast-title" class="d-flex flex-grow-1 align-items-baseline">
        <img src="svg/two-tickets-svgrepo-com.svg" style="width:20px" class="mr-3">
        <strong class="mr-auto">Notice!</strong>
      </div>
      Ticket: {{id}} was updated!
    </b-toast>
	</div>

</template>

<script>
    export default {
    props:['credit', 'id'],
    data() {
      return {
      	ticketCredit:this.credit,
      }
    },

    mounted(){

      Echo.channel('pending-ticket').listen('PendingTicketsEvent', (ticket)=>
        {
        	if(this.id == ticket.id){
        		this.ticketCredit = ticket.credit;
        		this.$bvToast.show('my-toast'+this.id)
        	}
        });
    }
  }
</script> 
