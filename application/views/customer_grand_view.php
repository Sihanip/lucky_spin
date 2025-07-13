<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Customer Grand</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Customer Grand</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered display table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        <th>No Receipt</th>
                        <th>Nominal Beli</th>
                        <th>Toko</th>
                        <th>Tgl</th>
                        <th>Status_ Voucher</th>
                    </tr>
                </thead>
                                    <tbody>
                                        
                                    <?php 
                                        if(!empty($list_cust))
                                        { $i=1;
                                            foreach($list_cust as $lst)
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?>.</td>
                                            <td><?php echo $lst->nama; ?></td>
                                            <td><?php echo $lst->no_telp; ?></td>
                                            <td><?php echo $lst->email; ?></td>
                                            <td><?php echo $lst->no_receipt; ?></td>
                                            <td><?php echo $lst->nominal_beli; ?></td>
                                            <td><?php echo $lst->nama_toko; ?></td>
                                            <td><?php echo $lst->created_at; ?></td>
                                            <td><?php echo $lst->status_voucher; ?></td>
                                        </tr>
                                    <?php
                                            $i++; }
                                        }
                                        ?>
                                    </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    });
</script>