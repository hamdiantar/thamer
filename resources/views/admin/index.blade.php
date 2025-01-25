@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> {{__('Dashboard')}}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">{{__('Dashboard')}}</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>الموظفيين</h4>
                        <p><b>{{ 9 }}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>مهام السياسات</h4>
                        <p><b>{{ 9 }}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-calendar fa-3x"></i>
                    <div class="info">
                        <h4>مهام المعايير</h4>
                        <p><b>{{ 9 }}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-star fa-3x"></i>
                    <div class="info">
                        <h4>الإدارات</h4>
                        <p><b>{{ 9 }}</b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">{{ __('السياسات') }}</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="departmentEmployeeChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">{{ __('المعايير') }}</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="departmentEmployeeChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('chart')
{{--    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}

{{--    <script>--}}
{{--        var departmentData = @json($departmentChartData);--}}
{{--        var ctxl = document.getElementById("departmentEmployeeChart").getContext("2d");--}}

{{--        var chartLabels = Object.keys(departmentData); // Department names--}}
{{--        var chartValues = Object.values(departmentData); // Employee count for each department--}}
{{--        var lineChart = new Chart(ctxl, {--}}
{{--            type: 'doughnut', // Define the type of chart--}}
{{--            data: {--}}
{{--                labels: chartLabels, // X-axis labels (Department names)--}}
{{--                datasets: [{--}}
{{--                    label: 'السياسات', // Chart label--}}
{{--                    data: chartValues, // Y-axis data (Employee counts)--}}
{{--                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Line fill color--}}
{{--                    borderColor: 'rgba(75, 192, 192, 1)', // Line border color--}}
{{--                    borderWidth: 2, // Line width--}}
{{--                    fill: true // Fill the area under the line--}}
{{--                }]--}}
{{--            },--}}
{{--            options: {--}}
{{--                responsive: true,--}}
{{--                scales: {--}}
{{--                    y: {--}}
{{--                        beginAtZero: true // Start y-axis at zero--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}



{{--        var ctxl2 = document.getElementById("departmentEmployeeChart2").getContext("2d");--}}

{{--        var chartLabels2 = Object.keys(departmentData); // Department names--}}
{{--        var chartValues2 = Object.values(departmentData); // Employee count for each department--}}
{{--        var lineChart2 = new Chart(ctxl2, {--}}
{{--            type: 'doughnut', // Define the type of chart--}}
{{--            data: {--}}
{{--                labels: chartLabels2, // X-axis labels (Department names)--}}
{{--                datasets: [{--}}
{{--                    label: 'السياسات', // Chart label--}}
{{--                    data: chartValues, // Y-axis data (Employee counts)--}}
{{--                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Line fill color--}}
{{--                    borderColor: 'rgba(75, 192, 192, 1)', // Line border color--}}
{{--                    borderWidth: 2, // Line width--}}
{{--                    fill: true // Fill the area under the line--}}
{{--                }]--}}
{{--            },--}}
{{--            options: {--}}
{{--                responsive: true,--}}
{{--                scales: {--}}
{{--                    y: {--}}
{{--                        beginAtZero: true // Start y-axis at zero--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endpush
