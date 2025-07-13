
                    <!-- Page Heading -->
                                      <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-2 text-gray-800">Master Toko</h1>
                        <a href="<?php echo base_url() ?>mst_toko/print_mst_toko" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Master Toko</h6>
                        </div>
                        <div class="card-body">
                            
                            <a href="#" class="btn btn-primary btn-icon-split mb-4" data-toggle="modal" data-target="#modal_addtoko">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Tambah Toko</span>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <!--<th>Username Akses</th>-->
                                            <th>Kode Akses</th>
                                            <th>Alamat Toko</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php 
                                        if(!empty($list_toko))
                                        { $i=1;
                                            foreach($list_toko as $lst)
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?>.</td>
                                            <td><?php echo $lst->nama_toko; ?></td>
                                            <!--<td><?php echo $lst->username_akses; ?></td>-->
                                            <td><?php echo $lst->kode_akses; ?></td>
                                            <td><?php echo $lst->alamat_toko; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-info edit_toko" href="#" data-user-id="<?php echo $lst->id; ?>" title="Edit"><i class="fa fa-pencil-alt"></i></a>&nbsp;
                                                <a class="btn btn-sm btn-danger deleteUser" href="#" data-user-id="<?php echo $lst->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
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

<!-- Modal -->
<div class="modal fade" id="modal_addtoko" tabindex="-1" role="dialog" aria-labelledby="modal_addtokoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_addtokoLabel">Tambah Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form  role="form" id="save_newtoko" action="<?php echo base_url() ?>mst_toko/save_newtoko" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_toko">Nama Toko</label>
                    <input type="text" class="form-control" id="nama_toko" name="nama_toko" >
                </div>
                <!--<div class="form-group">-->
                <!--    <label for="username_akses">Username Akses(Email)</label>-->
                <!--    <input type="email" class="form-control" id="username_akses" name="username_akses" >-->
                <!--</div>-->
                <div class="form-group">
                    <label for="kode_akses">Kode Akses</label>
                    <input type="text" class="form-control" id="kode_akses" name="kode_akses" >
                </div>
                <div class="form-group">
                    <label for="alamat_toko">Alamat</label>
                    <textarea class="form-control" id="alamat_toko" name="alamat_toko" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit"  value="Submit" id="submitBtn"  class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_edittoko" tabindex="-1" role="dialog" aria-labelledby="modal_edittokoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_edittokoLabel">Tambah Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form  role="form" id="edittoko" action="<?php echo base_url() ?>mst_toko/edittoko" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_toko_edit">Nama Toko</label>
                    <input type="text" class="form-control" id="nama_toko_edit" name="nama_toko_edit" >
                    <input type="hidden" class="form-control" id="id_toko_edit" name="id_toko_edit" >
                </div>
                <div class="form-group">
                    <label for="username_akses_edit">Username Akses</label>
                    <input type="text" class="form-control" id="username_akses_edit" name="username_akses_edit" >
                </div>
                <div class="form-group">
                    <label for="kode_akses_edit">Kode Akses</label>
                    <input type="text" class="form-control" id="kode_akses_edit" name="kode_akses_edit" >
                </div>
                <div class="form-group">
                    <label for="alamat_toko_edit">Example textarea</label>
                    <textarea class="form-control" id="alamat_toko_edit" name="alamat_toko_edit" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit"  value="Submit" id="submitBtn_edit"  class="btn btn-primary">Edit changes</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $(".edit_toko").click(function(){   
        var toko_id = $(this).data("user-id");
		jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : "<?= base_url() ?>mst_toko/get_toko",
			data : { toko_id : toko_id } 
			}).done(function(data){
				console.log(data[0].nama_toko);
                $('#nama_toko_edit').val(data[0].nama_toko);
                $('#id_toko_edit').val(data[0].id);
                $('#kode_akses_edit').val(data[0].kode_akses);
                $('#username_akses_edit').val(data[0].username_akses);
                $('#alamat_toko_edit').val(data[0].alamat_toko);
                $('#modal_edittoko').modal();
		});
        
    });
    
	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("user-id"),
			hitURL = "<?= base_url() ?>mst_toko/delete",
			currentRow = $(this);
            var rowId = $(this).last().attr("user-id");
		var confirmation = confirm("Anda yakin hapus toko ?");
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("toko berhasil dihapus"); }
				else if(data.status = false) { alert("toko gagal dihapus"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});
</script>