<template>
  <div class="container-fluid">
    <div class="row p-3">
      <div class="toolbargb col-lg-6 text-white card-body">
        <h6 class="h4 d-inline-block mb-0">อัตราการเสียชีวิตรวมทุกประเภท</h6>
        <p class="card-category">G10100</p>
      </div>
      <div class="toolbargb text-white col-lg-6 text-right">
        <fa icon="procedures" :class="textcolor" class="fa-4x" />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 p-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-muted">
              <fa icon="chart-bar" class="fa-1x" />
              กราฟแสดงอัตราการเสียชีวิตแสดงตามปีงบประมาณ
            </h5>

            <div class="table-wrap" v-show="checkchart">
              <canvas id="my-chart2" height="70vh"></canvas>
            </div>
            <div class="table-wrap" v-show="!checkchart">
              <PuSkeleton count="2" height="200px" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 p-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-muted">
              <fa icon="chart-bar" class="fa-1x" />
              กราฟแสดงอัตราการเสียชีวิตแยกตามหอผู้ป่วย ปีงบ {{ years[0] }}
            </h5>

            <div class="table-wrap" v-show="checkchart">
              <canvas id="my-chart" height="80vh"></canvas>
            </div>
            <div class="table-wrap" v-show="!checkchart">
              <PuSkeleton count="2" height="200px" />
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 p-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-muted">
              <fa icon="desktop" class="fa-1x" />
              ตารางแสดงอัตราการเสียชีวิตแยกตามหอผู้ป่วย ปีงบ {{ years[0] }}
            </h5>
            <div class="table-wrap table-condensed">
              <table class="table table-bordered">
                <thead>
                  <tr class="tr-color text-center">
                    <th scope="col ">รหัสหอผู้ป่วย</th>
                    <th scope="col">หอผู้ป่วย</th>
                    <th scope="col ">อัตราการเสียชีวิต</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="!checkdata">
                    <td><PuSkeleton /></td>
                    <td><PuSkeleton /></td>
                    <td><PuSkeleton /></td>
                  </tr>
                  <tr v-if="!checkdata">
                    <td><PuSkeleton /></td>
                    <td><PuSkeleton /></td>
                    <td><PuSkeleton /></td>
                  </tr>
                  <tr
                    v-else
                    class="text-center"
                    v-for="(ipddead, PLA_PLACECODE) in ipddeads"
                    :key="PLA_PLACECODE"
                  >
                    <td>{{ ipddead.PLA_PLACECODE }}</td>

                    <td>{{ ipddead.HALFPLACE }}</td>

                    <td>
                      {{ ipddead.IPDDEADCOUNT }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Chart from 'chart.js'
import barchartward from '@/components/chartjs/barchartward.vue'

export default {
  name: 'goal1_1_detail',
  components: { barchartward },
  data: () => ({
    ipddeads: '',
    ipddeads_chart: '1',
    checkdata: false,
    checkchart: false,
    ward: '',
    dead: '',
    years: '',

    myChart: '',
    myChart2: '',

    year_chart: '',
    yearline: '',
    dataline: '',
  }),
  mounted() {
    this.fetch_dead_table()
    this.fetch_dead_chart()
    this.fetch_line_year_chart()
  },
  methods: {
    //ตาราง เสียชีวิตราย ward

    async fetch_dead_table() {
      await axios
        .get(`${this.$axios.defaults.baseURL}goal1_1_detail.php`)
        .then((response) => {
          this.ipddeads = response.data
          this.checkdata = true
        })
    },

    async fetch_dead_chart() {
      // chart option
      const ctx = document.getElementById('my-chart')
      this.myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [],
          datasets: [
            {
              label: 'อัตราการเสียชีวิต',
              data: [],
              borderColor: '#663f3f',
              backgroundColor: '#51c2d5',
              borderWidth: 3,
            },
          ],
        },
        options: {
          responsive: true,
          title: {
            display: true,
            text: 'หอผู้ป่วย',
            fontSize: '16',
          },
          legend: {
            display: true,
          },
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                  fontSize: 16,
                  // fontFamily: 'Kanit, sans-serif',
                  // fontStyle: 'italic',
                },
                gridLines: {
                  display: true,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  display: false,
                },
                ticks: {
                  beginAtZero: true,
                  fontSize: 16,
                  // fontFamily: 'Kanit, sans-serif',
                  // fontStyle: 'italic',
                },
              },
            ],
          },
          plugins: {
            datalabels: {
              color: '#ec4646',
              font: {
                weight: 'bold',
                size: 16,
              },
              align: 'top',
              anchor: 'end',
              Clamping: 'top',
              // backgroundColor: '#92817a',
              // borderColor: "#B0C4DE",
              borderRadius: 4,
              borderWidth: 1,
            },
          },
        },
      })
      await axios
        .get(`${this.$axios.defaults.baseURL}chartjs/goal1_1_detail_chart.php`)
        .then((response) => {
          this.ipddeads_chart = response.data

          this.ward = this.ipddeads_chart.map((item) => item.PLA_PLACECODE)
          this.dead = this.ipddeads_chart.map((item) => item.IPDDEADCOUNT)
          this.years = this.ipddeads_chart.map((item) => item.YEARS)

          // labels and data
          this.myChart.config.data.labels = this.ward
          this.myChart.config.data.datasets[0].data = this.dead
          //update chart

          this.myChart.chart.update()
          this.checkchart = true
        })
    },
    async fetch_line_year_chart() {
      // chart option
      const ctx2 = document.getElementById('my-chart2')
      this.myChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
          labels: [],
          datasets: [
            {
              label: 'เปอร์เซ็นต์',
              data: [],
              borderColor: '#51c2d5',
              // backgroundColor: '#51c2d5',
              borderWidth: 3,
              fill: false, //ไม่เอาพื้นหลัง
            },
          ],
        },
        options: {
          responsive: true,
          title: {
            display: true,
            text: 'ปีงบประมาณ',
            fontSize: '16',
          },
          legend: {
            display: true,
          },
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                  fontSize: 16,
                  // fontFamily: 'Kanit, sans-serif',
                  // fontStyle: 'italic',
                },
                gridLines: {
                  display: true,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  display: false,
                },
                ticks: {
                  beginAtZero: true,
                  fontSize: 16,
                  // fontFamily: 'Kanit, sans-serif',
                  // fontStyle: 'italic',
                },
              },
            ],
          },
          plugins: {
            datalabels: {
              color: '#b83b5e',
              font: {
                weight: 'bold',
                size: 16,
              },
              align: 'top',
              anchor: 'start',
              Clamping: 'end',
              // backgroundColor: '#92817a',
              // borderColor: "#B0C4DE",
              borderRadius: 4,
              borderWidth: 1,
            },
          },
        },
      })
      await axios
        .get(`${this.$axios.defaults.baseURL}chartjs/goal1_1_year_chart.php`)
        .then((response) => {
          this.year_chart = response.data

          this.yearline = this.year_chart.map((item) => item.YEARS)
          this.dataline = this.year_chart.map((item) => item.DATA)

          // labels and data
          this.myChart2.config.data.labels = this.yearline
          this.myChart2.config.data.datasets[0].data = this.dataline
          //update chart

          this.myChart2.chart.update()
          this.checkchart = true
        })
    },
  },
}
</script>
<style>
.toolbargb {
  background-color: #374045;
}
.table-wrap {
  height: 500px;
  overflow-y: auto;
}
.tr-color {
  background-color: #30475e;
  color: #dddddd;
}
.table-condensed {
  font-size: 18px;
}
</style>
