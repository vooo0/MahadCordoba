@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Dashboard</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
      <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
      <input type="text" class="form-control">
    </div>
    <button type="button" class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
      <i class="btn-icon-prepend" data-feather="download"></i>
      Import
    </button>
    <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Download Report
    </button>
  </div>
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Pemasukkan</h6>
            </div>
            <div class="row">
              <div class="col-12 col-md-12 col-xl-12">
                <h3 class="mb-2">Rp. {{number_format($getPemasukkan->sum('jumlahHarga'))}}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Pengeluaran</h6>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-xl-12">
                  <h3 class="mb-2">Rp. {{number_format($getPengeluaran->sum('jumlahHarga'))}}</h3>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Laba / Rugi</h6>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-xl-12">
                  <h3 class="mb-2">Rp. {{number_format($labaRugi->sum('total'))}}</h3>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->

<div class="row">
  <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Laba / Rugi</h6>
        </div>
        <p class="text-muted mb-4">Menghitung Laba / Rugi Pada Setiap BUlan Dalam Satu Tahun Terakhir.</p>
        <div class="monthly-sales-chart-wrapper">
          <canvas id="labaRugi"></canvas>
        </div>
      </div> 
    </div>
  </div>
</div> <!-- row -->

@endsection

@push('plugin-scripts')

  <script> 
    $(function(){
    
      var gridLineColor = 'rgba(77, 138, 240, .1)';
    
      var colors = {
        primary:         "#727cf5",
        secondary:       "#7987a1",
        success:         "#42b72a",
        info:            "#68afff",
        warning:         "#fbbc06",
        danger:          "#ff3366",
        light:           "#ececec",
        dark:            "#282f3a",
        muted:           "#686868"
      }
        
      // Monthly sales chart start
      if($('#labaRugi').length) {
        var labaRugiChart = document.getElementById('labaRugi').getContext('2d')
        var cData = JSON.parse(`<?php echo $data['chart_data']; ?>`);
          
          new Chart(labaRugiChart, {
            type: 'bar',
            data: {
              labels: cData.bulan,
              datasets: [{
                label: 'Laba / Rugi',
                data: cData.labaRugi,
                backgroundColor: colors.primary
              }]
            },
            options: {
              maintainAspectRatio: false,
              legend: {
                display: true,
                  labels: {
                    display: false
                  }
              },
              scales: {
                xAxes: [{
                  display: true,
                  barPercentage: .3,
                  categoryPercentage: .6,
                  gridLines: {
                    display: false
                  },
                  ticks: {
                    fontColor: '#8392a5',
                    fontSize: 10
                  }
                }],
                yAxes: [{
                  gridLines: {
                    color: gridLineColor
                  },
                  ticks: {
                    fontColor: '#8392a5',
                    fontSize: 10,
                    min: -5000000,
                    max: 5000000
                  }
                }]
              }
            }
          }
        );
      }
      // Monthly sales chart end
    
    });
  </script>
  <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush