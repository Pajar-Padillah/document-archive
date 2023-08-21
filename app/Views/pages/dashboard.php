<?= $this->extend('pages/layout/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <?php if ($userdata['role'] == 'admin') : ?>
        <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card bg-warning">
                <div class="card-body text-white">
                    <div class="row">
                        <div class="col-8">
                            <p class="mb-4">Total User</p>
                            <p class="fs-30 mb-2"><?= $total_user ?></p>
                            <a href="/user" class="text-white" style="text-decoration: none;">Lihat Detail</a>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-md-4 mb-4 stretch-card transparent">
        <div class="card bg-info">
            <div class="card-body text-white">
                <div class="row">
                    <div class="col-8">
                        <p class="mb-4">Total Dokumen Lumpsum</p>
                        <p class="fs-30 mb-2"><?= $total_lumpsum ?></p>
                        <a href="/lumpsum" class="text-white" style="text-decoration: none;">Lihat Detail</a>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end">
                            <i class="fa fa-file"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4 stretch-card transparent">
        <div class="card card-dark-blue">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <p class="mb-4">Total Dokumen GUP</p>
                        <p class="fs-30 mb-2"><?= $total_gup ?></p>
                        <a href="/gup" class="text-white" style="text-decoration: none;">Lihat Detail</a>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end">
                            <i class="fa fa-file-archive"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="card-title">Grafik Dokumen Lumpsum Perbulan Tahun <?= $tahun ?></p>
                </div>
                <div id="lumpsum-legend" class="chartjs-legend mb-2"></div>
                <canvas id="lumpsum-chart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="card-title">Grafik Dokumen GUP Perbulan Tahun <?= $tahun ?></p>
                </div>
                <div id="gup-legend" class="chartjs-legend mb-2"></div>
                <canvas id="gup-chart"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets') ?>/vendors/js/vendor.bundle.base.js"></script>
<script src="<?= base_url('assets') ?>/vendors/chart.js/Chart.min.js"></script>
<script>
    var data_bulan_lumpsum = [];
    var data_jumlah_lumpsum = [];
    var data_bulan_gup = [];
    var data_jumlah_gup = [];

    <?php foreach ($data_grafik_lumpsum->getResult() as $key => $value) : ?>
        data_bulan_lumpsum.push('<?= date('M', strtotime($value->tanggal)) ?>');
        data_jumlah_lumpsum.push(<?= $value->jumlah ?>);
    <?php endforeach ?>
    <?php foreach ($data_grafik_gup->getResult() as $key => $value) : ?>
        data_bulan_gup.push('<?= date('M', strtotime($value->tanggal)) ?>');
        data_jumlah_gup.push(<?= $value->jumlah ?>);
    <?php endforeach ?>

        (function($) {
            'use strict';
            $(function() {
                if ($("#lumpsum-chart").length) {
                    var LumpsumChartCanvas = $("#lumpsum-chart").get(0).getContext("2d");
                    var LumpsumChart = new Chart(LumpsumChartCanvas, {
                        type: 'bar',
                        data: {
                            labels: data_bulan_lumpsum,
                            datasets: [{
                                label: 'Jumlah Lumpsum',
                                data: data_jumlah_lumpsum,
                                backgroundColor: '#FFA500'
                            }]
                        },
                        options: {
                            cornerRadius: 5,
                            responsive: true,
                            maintainAspectRatio: true,
                            layout: {
                                padding: {
                                    left: 0,
                                    right: 0,
                                    top: 20,
                                    bottom: 0
                                }
                            },
                            scales: {
                                yAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: true,
                                        drawBorder: false,
                                        color: "#F2F2F2"
                                    },
                                    ticks: {
                                        display: true,
                                        min: 0,
                                        max: Math.ceil(Math.max.apply(null, data_jumlah_lumpsum)),
                                        callback: function(value, index, values) {
                                            return value;
                                        },
                                        autoSkip: true,
                                        maxTicksLimit: 10,
                                        fontColor: "#6C7383"
                                    }
                                }],
                                xAxes: [{
                                    stacked: false,
                                    ticks: {
                                        beginAtZero: true,
                                        fontColor: "#6C7383"
                                    },
                                    gridLines: {
                                        color: "rgba(0, 0, 0, 0)",
                                        display: false
                                    },
                                    barPercentage: 1
                                }]
                            },
                            legend: {
                                display: false
                            },
                            elements: {
                                point: {
                                    radius: 0
                                }
                            }
                        },
                    });
                    document.getElementById('lumpsum-legend').innerHTML = LumpsumChart.generateLegend();
                }
                if ($("#gup-chart").length) {
                    var GupChartCanvas = $("#gup-chart").get(0).getContext("2d");
                    var GupChart = new Chart(GupChartCanvas, {
                        type: 'bar',
                        data: {
                            labels: data_bulan_gup,
                            datasets: [{
                                label: 'Jumlah GUP',
                                data: data_jumlah_gup,
                                backgroundColor: '#4B49AC'
                            }]
                        },
                        options: {
                            cornerRadius: 5,
                            responsive: true,
                            maintainAspectRatio: true,
                            layout: {
                                padding: {
                                    left: 0,
                                    right: 0,
                                    top: 20,
                                    bottom: 0
                                }
                            },
                            scales: {
                                yAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: true,
                                        drawBorder: false,
                                        color: "#F2F2F2"
                                    },
                                    ticks: {
                                        display: true,
                                        min: 0,
                                        max: Math.ceil(Math.max.apply(null, data_jumlah_gup)),
                                        callback: function(value, index, values) {
                                            return value;
                                        },
                                        autoSkip: true,
                                        maxTicksLimit: 10,
                                        fontColor: "#6C7383"
                                    }
                                }],
                                xAxes: [{
                                    stacked: false,
                                    ticks: {
                                        beginAtZero: true,
                                        fontColor: "#6C7383"
                                    },
                                    gridLines: {
                                        color: "rgba(0, 0, 0, 0)",
                                        display: false
                                    },
                                    barPercentage: 1
                                }]
                            },
                            legend: {
                                display: false
                            },
                            elements: {
                                point: {
                                    radius: 0
                                }
                            }
                        },
                    });
                    document.getElementById('gup-legend').innerHTML = GupChart.generateLegend();
                }
            });
        })(jQuery);
</script>
<?= $this->endSection() ?>