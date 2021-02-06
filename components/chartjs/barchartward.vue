<template>
  <div>
    <canvas id="my-chart" height="80vh"></canvas>
  </div>
</template>

<script>
import Chart from 'chart.js'
import axios from 'axios'
//เรียกใช้ plugin labels
import ChartJSPluginDatalabels from 'chartjs-plugin-datalabels'

export default {
  name: 'barchart',
  props: {
    goals: null,
  },
  data: () => ({
    myChart: '',
    ward: '',
    dead: '',
    years: '',
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

    async fetch_dead_chart() {
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
  },
}
</script>
