<template>
  <!-- Card stats -->
  <div class="card-color">
    <div class="row align-items-center p-4">
      <div class="toolbargb col-lg-12 texthead card-body">
        <div class="col-lg-6">
          <h6 v-if="checkdata" class="h4 d-inline-block mb-0">
            {{ goaltype[0].typename }}
          </h6>
          <p v-if="checkdata" class="card-category">{{ goaltype[0].other }}</p>
          <PuSkeleton v-else />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'goal2',
  components: {},
  data: () => ({
    goals: '',
    goaltype: 'g2',
    datastandard: '',
    data: '',
    success: false,
    danger: false,

    classtext: '',
    checkdata: false,
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
            id: 'g2',
          },
        })
        .then((response) => {
          this.goaltype = response.data
          this.checkdata = true
        })
    },
  },
}
</script>
<style scoped>
.toolbargb {
  background-color: #374045;
}

.card-color {
  background-color: #f4f9f9;
}
.texthead {
  color: #a6f0c6;
}
</style>
