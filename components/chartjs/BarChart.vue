<script>
import { Bar } from 'vue-chartjs'
import axios from 'axios'
import Chart from 'chart.js'
//เรียกใช้ plugin labels
import ChartJSPluginDatalabels from 'chartjs-plugin-datalabels'

export default {
  extends: Bar,
  props: {
    borderColor: null,
    ipddetail: null,
    ipdall_chart_bar_name: null,
    ipdall_chart_bar_sum: null,
  },
  data() {
    return {
      chartcolor: null,
      chartbodercolor: null,
      chartData: {
        labels: [],
        datasets: [
          {
            label: 'จำนวนผู้ป่วย',

            borderWidth: 3,
            backgroundColor: [],
            borderColor: [],
            pointBorderColor: '',
            data: [],
            rough: {
              roughness: 2,

              bowing: 2,
            },
          },
        ],
      },

      options: {
        title: {
          display: true,
          text: 'หอผู้ป่วย',
          fontSize: '20',
          fontFamily: 'Kanit, sans-serif',
        },

        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                fontSize: 18,
                fontFamily: 'Kanit, sans-serif',
                fontStyle: 'italic',
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
                fontSize: 18,
                fontFamily: 'Kanit, sans-serif',
                fontStyle: 'italic',
              },
            },
          ],
        },

        legend: {
          display: true,
        },
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
          datalabels: {
            color: '#ffffff',

            font: {
              weight: 'bold',
              size: 16,
            },
            // align: function(context) {
            //   var index = context.dataIndex;
            //   var value = context.dataset.data[index];
            //   var invert = Math.abs(value) <= 1;
            //   return value < 1 ? "end" : "start";
            // },

            align: 'end',
            anchor: 'end',
            Clamping: 'end',
            backgroundColor: '#92817a',
            // borderColor: "#B0C4DE",
            borderRadius: 4,
            borderWidth: 1,
          },
        },
      },
    }
  },
  mounted() {
    // console.log(this.chartData);
    this.changetitlecolor()
    //เรียกใช้ plugin labels
    this.addPlugin(ChartJSPluginDatalabels)

    //renderchart
    this.renderChart(this.chartData, this.options)
  },
  methods: {
    changetitlecolor() {
      this.chartbodercolor = '#B0C4DE'
      if (this.ipddetail == 'ipdall') {
        this.chartcolor = '#FF6E40'
      } else if (this.$route.params.ipddetail == 'ipdnew') {
        this.chartcolor = '#FFCC80'
      } else if (this.$route.params.ipddetail == 'ipdold') {
        this.chartcolor = '#F06292'
      } else if (this.$route.params.ipddetail == 'ipdout') {
        this.chartcolor = '#880E4F'
      }
      //สี chart
      // this.chartData.datasets[0].backgroundColor = this.chartcolor;
      this.chartData.datasets[0].backgroundColor = '#4ea0ae'

      this.chartData.datasets[0].borderColor = this.chartbodercolor
      //ค่า+label
      this.chartData.labels = this.ipdall_chart_bar_name
      this.chartData.datasets[0].data = this.ipdall_chart_bar_sum
      //สี label
      // this.options.plugins.datalabels.backgroundColor = "#fcbf49";
      this.options.plugins.datalabels.borderColor = this.chartbodercolor

      // console.log(this.ipdall_chart_bar_name);
    },
  },
}
</script>
