<x-layout>
    <x-slot:styles>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}">
    </x-slot:styles>
    <x-slot:title>
        Grafico semanal 
    </x-slot:title>
    <x-slot:scripts>
        <script type="module">
            var options = {
          series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'Product Trends by Month',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        }
        };

        var chart = new ApexCharts(document.querySelector("#lineChart"), options);
        chart.render();
        </script>

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between">
                    <div>
                      <h5 class="mb-0 card-title">Balance</h5>
                      <small class="text-muted">Commercial networks & enterprises</small>
                    </div>
                    <div class="d-sm-flex d-none align-items-center">
                      <h5 class="mb-0 me-3">$ 100,000</h5>
                      <span class="badge bg-label-secondary">
                        <i class="bx bx-down-arrow-alt bx-xs text-danger"></i>
                        <span class="align-middle">20%</span>
                      </span>
                    </div>
                  </div>
                  <div class="card-body">
                    <div id="lineChart"></div>
                  </div>
                </div>
              </div>

        </div>



</x-layout>
