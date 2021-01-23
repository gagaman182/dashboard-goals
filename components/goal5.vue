<template>
  <!-- Card stats -->

  <div class="row align-items-center p-4">
    <div class="col-lg-12 text-white card-body">
      <h6 class="h4 d-inline-block mb-0">{{ goaltype[0].typename }}</h6>
      <p class="card-category">{{ goaltype[0].other }}</p>
    </div>
    <div class="col-md-3" v-for="goal in goals" :key="goal.id">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">
                {{ goal.name }}
              </h5>

              <span class="h2 font-weight-bold mb-0">350,897</span>
            </div>
            <div class="col-auto">
              <div style="font-size: 3em; color: green">
                <i class="fas fa-procedures"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"
              ><i class="fa fa-arrow-up"></i> 3.48%</span
            >
            <span class="text-nowrap">{{ goal.other }}</span>
          </p>
          <hr />
          <div class="float-right">
            <footer>
              <p class="card-category">
                รายละเอียด <i class="fas fa-chevron-circle-right"></i>
              </p>
            </footer>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'goal5',
  data: () => ({
    goals: '',
    goaltype: 'g5',
  }),

  mounted() {
    this.fetch_goals()
    this.fetch_goaltype()
  },
  methods: {
    //goals
    async fetch_goals() {
      await axios
        .get(`${this.$axios.defaults.baseURL}goals.php`, {
          params: {
            id: 'g5',
          },
        })
        .then((response) => {
          this.goals = response.data

          // this.aa = this.tambon_list.map((item) => item.tambon)
        })
    },
    //goaltype
    async fetch_goaltype() {
      await axios
        .get(`${this.$axios.defaults.baseURL}goaltype.php`, {
          params: {
            id: 'g5',
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
