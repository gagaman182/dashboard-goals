<template>
  <div class="container-fluid">
    <div class="row p-3">
      <div class="toolbargb col-lg-6 text-white card-body">
        <h6 class="h4 d-inline-block mb-0">อัตราตายผู้ป่วยโรคหลอดเลือดหัวใจ</h6>
        <p class="card-category">G10200</p>
      </div>
      <div class="toolbargb text-white col-lg-6 text-right">
        <fa icon="heartbeat" :class="textcolor" class="fa-4x" />
      </div>
    </div>

    <div class="row">
      <div class="col-md-5 p-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-muted">
              <fa icon="desktop" class="fa-1x" />
              ตารางแสดงอัตราตายผู้ป่วยโรคหลอดเลือดหัวใจแยกตามหอผู้ป่วย ปีงบ
              {{ years[0] }}
            </h5>
            <div class="table-wrap">
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
      <div class="col-lg-7 p-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-muted">
              <fa icon="chart-bar" class="fa-1x" />
              กราฟแสดงอัตราตายผู้ป่วยโรคหลอดเลือดหัวใจแยกตามหอผู้ป่วย ปีงบ
              {{ years[0] }}
            </h5>

            <div class="table-wrap" v-show="checkchart">
              <canvas id="my-chart" height="120vh"></canvas>
            </div>
            <div class="table-wrap" v-show="!checkchart">
              <PuSkeleton count="2" height="200px" />
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
//เรียกใช้ plugin labels
import ChartJSPluginDatalabels from 'chartjs-plugin-datalabels'

export default {
  name: 'goal1_2_detail',
  components: {},
  data: () => ({
    ipddeads: '',
    ipddeads_chart: '2',
    checkdata: false,
    checkchart: false,
    ward: '',
    dead: '',
    years: '',

    myChart: '',
  }),
  mounted() {
    this.fetch_dead_table()
    this.fetch_dead_chart()

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
            // borderColor: '#f6c065',
            backgroundColor: '#51adcf',
            // borderWidth: 2,
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
                fontSize: 14,
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
                fontSize: 14,
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
            align: 'buttom',
            anchor: 'center',
            Clamping: 'end',
            // backgroundColor: '#92817a',
            // borderColor: "#B0C4DE",
            borderRadius: 4,
            borderWidth: 1,
          },
        },
      },
    })
  },
  methods: {
    //ตาราง เสียชีวิตราย ward

    async fetch_dead_table() {
      await axios
        .get(`${this.$axios.defaults.baseURL}goal1_2_detail.php`)
        .then((response) => {
          this.ipddeads = response.data
          this.checkdata = true
        })
    },

    async fetch_dead_chart() {
      await axios
        .get(`${this.$axios.defaults.baseURL}chartjs/goal1_2_detail_chart.php`)
        .then((response) => {
          this.ipddeads_chart = response.data

          this.ward = this.ipddeads_chart.map((item) => item.PLA_PLACECODE)
          this.dead = this.ipddeads_chart.map((item) => item.IPDDEADCOUNT)
          this.years = this.ipddeads_chart.map((item) => item.YEARS)
          console.log(this.years)
          // labels and data
          this.myChart.config.data.labels = this.ward
          this.myChart.config.data.datasets[0].data = this.dead
          //update chart

          this.myChart.chart.update()
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
  background-color: #51adcf;
  color: #b83b5e;
}
</style>
