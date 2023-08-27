<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Content Row -->
    <!-- <div class="row">

        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Pegawai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_user; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Data Jabatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_jabatan; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Pelatihan
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Data Absensi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Charts</h1> -->
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengeluaran Gaji</h6>
                    <select name="" id="">
                        <option value="all">All</option>
                        <option value="sdm">SDM</option>
                        <option value="humas">Humas</option>
                        <option value="teknik">Teknik</option>
                    </select>
                </div>
                <div class="card-body">
                    <div class="form-group">
                    </div>
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <hr>
                </div>
            </div>
        </div>


        <!-- <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
        
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Staf Pria dan Perempuan</h6>
                </div>
        
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <hr>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Pria
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Perempuan
                        </span>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-xl-8 col-lg-7">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Jenis Pegawai</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="jenisPegawai"></canvas>
                    </div>
                    <hr>
                </div>
            </div>
        </div> -->
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pinjaman Karyawan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jumlah Pinjaman (Rp)</th>
                                    <th>Tanggal Pinjaman</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>422290888</td>
                                    <td>Nugraha</td>
                                    <td class="text-right">2,000,000.00</td>
                                    <td>30 Mei 2023</td>
                                    <td>Belum Lunas</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>424598768</td>
                                    <td>Aldiansyah</td>
                                    <td class="text-right">1.000,000.00</td>
                                    <td>10 Juni 2023</td>
                                    <td>Belum Lunas</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->