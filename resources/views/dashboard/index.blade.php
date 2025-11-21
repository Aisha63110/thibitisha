
@extends('layouts.admin')

{{-- Page Title in Browser Tab --}}
@section('title', 'Dashboard')

{{-- Page Heading --}}
@section('page-title', 'Dashboard')

{{-- Breadcrumb --}}
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
@endsection

{{-- Main Content --}}
@section('content')
    {{-- counts --}}
    <div class="row">
        {{-- General Practitioners --}}
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ number_format($generalPractitioners) }}</h3>
                    <p>General Practitioners</p>
                </div>
                <i class="small-box-icon bi bi-person-badge"></i>
                <a href="{{ route('practitioners.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        {{-- Specialists Practitioners --}}
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ number_format($specialistPractitioners) }}</h3>
                    <p>Specialists</p>
                </div>
                <i class="small-box-icon bi bi-mortarboard"></i>
                <a href="{{ route('practitioners.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        {{-- Successful Verifications --}}
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>3</h3>
                    <p>Successful Verification(s)</p>
                </div>
                <i class="small-box-icon bi bi-check-circle"></i>
                <a href="{{ route('verifications.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        {{-- Failed Verifications --}}
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>4</h3>
                    <p>Failed Verification(s)</p>
                </div>
                <i class="small-box-icon bi bi-x-circle"></i>
                <a href="{{ route('verifications.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
    </div>
    <div class="row">
        {{-- chart example1 (practitioner distribution summary) --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="practitioner-chart"></div>
                </div>
            </div>
        </div>
        {{-- chart example2 (verification summary) --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="verification-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        {{-- chart example3 (specialist distribution) --}}
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="specialist-chart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Page-specific Scripts --}}
@push('scripts')
      <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


//practitioner distribution by status (pie chart)
@push('scripts')
    <script>
 var practitionerDistribution = {
            series: {!! json_encode(array_values($practitionerDistributionByStatus)) !!},
            chart: {
                type: 'pie',
                // Enable the toolbar with download options
                toolbar: {
                    show: true,
                    tools: {
                        download: {
                            // Allows download as PNG, SVG, or CSV
                            icon: "&#x1F4E5;", // Optional: Use a custom icon, or let ApexCharts use the default hamburger menu
                            enabled: true
                        }
                    }
                }
            },
            labels: {!! json_encode(array_keys($practitionerDistributionByStatus)) !!},
            // Enable and configure data labels on the slices
            dataLabels: {
                enabled: true,
                formatter: function(val, opts) {
                    return val.toFixed(1) + "%"
                },
                style: {
                    fontSize: '14px',
                    fontFamily: 'Helvetica, Arial, sans-serif',
                    fontWeight: 'bold'
                }
            },
            // Configure the legend
            legend: {
                position: 'bottom', // Position the legend at the bottom
                fontSize: '14px'
            },
            // Make the chart responsive
            responsive: [{
                breakpoint: 480, // At 480px screen width or less
                options: {
                    chart: {
                        width: 200 // Reduce chart width
                    },
                    legend: {
                        position: 'bottom' // Ensure legend stays at the bottom
                    }
                }
            }]
        };

        var practitionerDistChart = new ApexCharts(document.querySelector("#practitioner-chart"), practitionerDistribution);

        practitionerDistChart.render();

// verification summary (bar) - verification-chart

        var verificationSummary = {
            chart: {
                type: "bar",
                height: 468,
                toolbar: {
                    show: true
                },

            },
            title: {
                text: "Verification Summary (last 12 Months)",
                align: "center"

            },
            dataLabels: {
                enabled: true
            },
            series: [{
                data: {!! json_encode(array_values($verificationSummary)) !!}
            }],
            xaxis: {
                categories: {!! json_encode(array_keys($verificationSummary)) !!}
            },
            // Make the chart responsive
            responsive: [{
                breakpoint: 480, // At 480px screen width or less
                options: {
                    chart: {
                        width: 200 // Reduce chart width
                    },
                    legend: {
                        position: 'bottom' // Ensure legend stays at the bottom
                    }
                }
            }]
        };
        var verificationSummaryChart = new ApexCharts(document.querySelector("#verification-chart"), verificationSummary);
        verificationSummaryChart.render();
      