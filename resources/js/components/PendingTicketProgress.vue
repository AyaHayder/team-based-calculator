<template>
    <b-progress :value="percentNew" :max="max" variant="success" show-progress animated></b-progress>
</template>

<script>
    export default {
    props:['percent', 'id'],
    data() {
      return {
        percentNew: Number(this.percent),
        max:100
      }
    },
    mounted(){
      Echo.channel('pending-ticket').listen('PendingTicketsEvent', (ticket)=>
        {
            if(this.id == ticket.id){
            this.percentNew = ticket.station_value;
          }
        });

    }
  }
</script> 

