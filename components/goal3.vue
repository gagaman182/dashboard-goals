<template>
  <!-- Card stats -->

  <div class="row align-items-center p-4">
    <div class="col-lg-12 text-white card-body">
      <h6 class="h4 d-inline-block mb-0">{{ goaltype[0].typename }}</h6>
      <p class="card-category">{{ goaltype[0].other }}</p>
    </div>
    <div class="col-md-4 col-12">
      <goal3_1></goal3_1>
    </div>
    <!-- <div class="col-md-4 col-12">
      <goal1_2></goal1_2>
    </div>
    <div class="col-md-4 col-12">
      <goal1_3></goal1_3>
    </div>
    <div class="col-md-4 col-12">
      <goal1_4></goal1_4>
    </div>
    <div class="col-md-4 col-12">
      <goal1_5></goal1_5>
    </div> -->
  </div>
</template>

<script>
import axios from 'axios'
import goal3_1 from '@/components/goal3_1'

export default {
  name: 'goal3',
  components: { goal3_1 },
  data: () => ({
    goals: '',
    goaltype: 'g3',
    datastandard: '',
    data: '',
    success: false,
    danger: false,

    classtext: '',
  }),

  mounted() {
    this.fetch_goaltype()
  },
  methods: {
    //goaltype
    async fetch_goaltype() {
      await axios
        .get(`${this.$axios.defaults.baseURL}goaltype.php`, {
          params: {
            id: 'g3',
          },
        })
        .then((response) => {
          this.goaltype = response.data
        })
    },
  },
}
</script>
<style>
.col-lg-12 {
  background-color: #374045;
}
</style>
