<template>
  <div>
    <h4 class="lead" v-for="station in stations"><img src="svg/arrow-right.svg" alt=""> Station: {{station}}</h4>
  </div> 
</template>

<script>
    export default {
    props:['id'],
    data() {
      return {
        stationName:'',
        stations:[]
      }
    },
    mounted(){
      Echo.channel('pending-ticket').listen('PendingTicketsEvent', (ticket)=>
        {
            if(this.id == ticket.id){
            this.stationName = ticket.station_name;
            this.stations.push(this.stationName);
            console.log(this.stations)
          }
        });

    }
  }
</script> 