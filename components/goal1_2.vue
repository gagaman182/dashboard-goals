<template>
  <div class="row align-items-center p-4">
    <div class="col-md-12 p-12">
      <div class="card mb-3" :class="bordercolor">
        <div class="card-header" :class="bgcolor">
          <h5
            v-if="checkdata"
            class="card-title text-uppercase text-white mb-0 font-weight-bold"
          >
            {{ title }}
          </h5>

          <PuSkeleton v-else />
        </div>
        <div class="card-body text-success">
          <div class="row">
            <div class="col">
              <span
                v-if="checkdata"
                class="h1 font-weight-bold"
                :class="textcolor"
              >
                {{ dataperson }}%</span
              >

              <PuSkeleton v-else />
            </div>
            <div class="col-auto">
              <fa
                v-if="checkdata"
                icon="heartbeat"
                :class="textcolor"
                class="fa-5x"
              />
              <PuSkeleton :count="2" circle v-else />
            </div>
          </div>
          <p v-if="checkdata" class="mt-3 mb-0 text-sm font-weight-bold">
            <span class="mr-2 h4" :class="updowncolor">
              <fa icon="calendar-minus" /> {{ datapersonold }}%</span
            >

            <span class="h5 text-nowrap detail-color">ปีที่ผ่านมา</span>
          </p>
          <PuSkeleton v-else />
        </div>
        <div class="card-footer bg-transparent text-right" :class="bordercolor">
          <NuxtLink
            to="/goal_1_2_detail"
            class="nuxt-link-active nuxt-link-exact-active font-weight-bold"
            target="_blank"
          >
            <h5 class="detail-color">
              รายละเอียด <fa icon="chevron-circle-right" />
            </h5>
          </NuxtLink>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'goal1_2',
  data: () => ({
    goals: '',
    title: '',
    icon: '',
    other: '',
    datatotal: '',
    dataperson: '',
    textcolor: '',
    bordercolor: '',
    bgcolor: '',
    datapersonold: '',
    updowncolor: '',
    updownicon: '',

    checkdata: false,
  }),

  mounted() {
    this.fetch_goals()
    this.fetch_ipd()
  },
  methods: {
    //ชื่อหัวข้อ icon อื่นๆ mysql
    async fetch_goals() {
      await axios
        .get(`${this.$axios.defaults.baseURL}goals.php`, {
          params: {
            id: 'g10200',
          },
        })
        .then((response) => {
          this.goals = response.data
          this.title = this.goals[0].name
          this.icon = this.goals[0].icon
          this.other = this.goals[0].other
        })
    },

    //pmk data, สี, border, card, icon, text
    async fetch_ipd() {
      await axios
        .get(`${this.$axios.defaults.baseURL}goal1_2.php`)
        .then((response) => {
          this.datatotal = response.data
          this.dataperson = this.datatotal[0].dataperson

          this.textcolor = this.datatotal[0].textcolor
          this.bordercolor = this.datatotal[0].bordercolor
          this.bgcolor = this.datatotal[0].bgcolor
          this.datapersonold = this.datatotal[0].datapersonold
          this.updowncolor = this.datatotal[0].updowncolor
          this.updownicon = this.datatotal[0].updownicon

          this.checkdata = true
        })
    },
  },
}
</script>
<style scoped>
.nuxt-link-active {
  color: red;
}
.nuxt-link-exact-active {
  color: #374045;
}
.detail-color {
  color: #726a95;
}
</style>
