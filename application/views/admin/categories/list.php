<div id="wrapper">

    <!-- Sidebar -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h2>
                                <?php echo ucfirst($this->uri->segment(2));?>
                                <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success float-right">Add a new</a>
                            </h2>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="header">#</th>
                                    <th class="red header">Name</th>
                                    <th class="red header">Manufacture</th>
                                    <th class="red header">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($categories as $row)
                                {
                                    echo '<tr>';
                                    echo '<td>'.$row['id'].'</td>';
                                    echo '<td>'.$row['name'].'</td>';
                                    echo '<td>'.$row['manufacture_id'].'</td>';
                                    echo '<td class="crud-actions">
                                        <a href="'.site_url("admin").'/categories/update/'.$row['id'].'" class="btn btn-info">view & edit</a>
                                        <a href="'.site_url("admin").'/categories/delete/'.$row['id'].'" class="btn btn-danger">delete</a>
                                        </td>';
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>


