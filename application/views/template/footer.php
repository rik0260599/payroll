</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white mt-3">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Undira 2022</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script>
<script src="<?= base_url('assets/'); ?>js/demo/chart-bar-demo.js"></script>
<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>

<!-- pie chart js -->
<script>
// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Pria", "Perempuan"],
        datasets: [{
            data: [<?= $total_pria;?>, <?= $total_perempuan;?>],
            backgroundColor: ['#4e73df', '#c0504d'],
            hoverBackgroundColor: ['#2e59d9', '#ff2f15'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
    },
});
</script>
<!-- bar chart js -->
<script>
// Bar Chart Example
var ctx = document.getElementById("jenisPegawai");
var jenisPegawai = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Tendik", "Dosen Tetap", "Dosen Tidak Tetep", "pegawai tetap", "Kontrak"],
        datasets: [{
            label: "Jumlah Staf",
            backgroundColor: "#4e73df",
            hoverBackgroundColor: "#2e59d9",
            borderColor: "#4e73df",
            data: [<?= $total_pegawai_tendik;?>, <?= $total_pegawai_dosenTetap;?>,
                <?= $total_pegawai_dosenTidakTetap;?>, <?= $total_pegawai_tetap;?>,
                <?= $total_pegawai_kontrak;?>
            ],
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                time: {
                    unit: 'Staf'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 6
                },
                maxBarThickness: 25,
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 10,
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return number_format(value);
                    }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        legend: {
            display: false
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ' : ' + number_format(tooltipItem.yLabel);
                }
            }
        },
    }
});
</script>

<!-- bar chart js -->
<script>
// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Desember"
        ],
        datasets: [{
            label: "Gaji",
            backgroundColor: "#4e73df",
            hoverBackgroundColor: "#2e59d9",
            borderColor: "#4e73df",
            data: [30000000, 35000000, 34000000, 30000000, 30000000, 30000000, 30000000,
                30000000, 30000000, 30000000, 30000000, 30000000, 30000000
            ],
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                time: {
                    unit: 'Staf'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 12
                },
                maxBarThickness: 25,
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 100000000,
                    maxTicksLimit: 2500000,
                    padding: 10,
                    stepSize: 10000000,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return number_format(value);
                    }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        legend: {
            display: false
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: true,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ' : ' + number_format(tooltipItem.yLabel);
                }
            }
        },
    }
});
</script>

<!-- custom ajax checkbox role access-->
<script>
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});


$('.form-check-input').on('click', function() {
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');

    $.ajax({
        url: "<?= base_url('admin/changeaccess'); ?>",
        type: 'post',
        data: {
            menuId: menuId,
            roleId: roleId
        },
        success: function() {
            document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
        }
    })
})
</script>
<!-- Page level plugins -->

<!-- custom ajax checkbox role access jabatan-->
<script>
$('.check-access').on('click', function() {
    const type = $(this).data('type');
    const submenu = $(this).data('submenu');
    const idjabatan = $(this).data('idjabatan');
    const checked = $(this).is(':checked') == true ? 1 : 0;

    $.ajax({
        url: "<?= base_url('access/changeaccess'); ?>",
        type: 'post',
        data: {
            type: type,
            submenu: submenu,
            idjabatan: idjabatan,
            checked: checked,
        },
        success: function() {
            // alert('access berhasil dirubah')
        }
    });

    $('#dataTable').dataTable({
        "ordering": false
    });

})
</script>
<!-- Page level plugins -->



</body>

</html>