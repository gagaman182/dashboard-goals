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

      <div class="col-lg-4 col-12">
        <goal1_1></goal1_1>
      </div>
      <div class="col-lg-4 col-12">
        <goal1_2></goal1_2>
      </div>
      <div class="col-lg-4 col-12">
        <goal1_3></goal1_3>
      </div>
      <div class="col-lg-4 col-12">
        <goal1_4></goal1_4>
      </div>
      <div class="col-lg-4 col-12">
        <goal1_5></goal1_5>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import goal1_1 from '@/components/goal1_1'
import goal1_2 from '@/components/goal1_2'
import goal1_3 from '@/components/goal1_3'
import goal1_4 from '@/components/goal1_4'
import goal1_5 from '@/components/goal1_5'
export default {
  name: 'goal1',
  components: { goal1_1, goal1_2, goal1_3, goal1_4, goal1_5 },
  data: () => ({
    goals: '',
    goaltype: 'g1',
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
            id: 'g1',
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
