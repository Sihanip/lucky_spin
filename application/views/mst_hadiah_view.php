
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Master Hadiah</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Master Hadiah</h6>
                        </div>
                        <div class="card-body">
                            
                            <a href="#" class="btn btn-primary btn-icon-split mb-4" data-toggle="modal" data-target="#modal_addtoko">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Tambah Hadiah</span>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name Hadiah</th>
                                            <th>Stok Awal</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php 
                                        if(!empty($list_hadiah))
                                        { $i=1;
                                            foreach($list_hadiah as $lst)
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?>.</td>
                                            <td><?php echo $lst->nama_hadiah; ?></td>
                                            <td><?php echo $lst->stok_awal; ?></td>
                                            <td><img style="width:100px" src="<?php echo base_url()."assets/upload/".$lst->gambar; ?>" class="card-img-top" alt="..."></td>
                                            <td class="text-center">
                                                 <a class="btn btn-sm btn-info edit_hadiah" href="#" data-user-id="<?php echo $lst->id; ?>" title="Edit"><i class="fa fa-pencil-alt"></i></a>&nbsp; 
                                                <!--<a class="btn btn-sm btn-danger deleteHadiah" href="#" data-user-id="<?php echo $lst->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>-->
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
        <form  role="form" id="save_newhadiah" action="<?php echo base_url() ?>mst_hadiah/save_newhadiah" method="post"  enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_hadiah">Nama Hadiah</label>
                    <input type="text" class="form-control" id="nama_hadiah" name="nama_hadiah" >
                </div>
                <div class="form-group">
                    <label for="stok_awal">Stok Awal</label>
                    <input type="text" class="form-control" id="stok_awal" name="stok_awal" >
                </div>
                <div>
					<label for="gambar">Pilih Gambar Avatar</label>
					<input type="file" name="gambar" id="gambar" accept="image/png, image/jpeg, image/jpg, image/gif">
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
<div class="modal fade" id="modal_edithadiah" tabindex="-1" role="dialog" aria-labelledby="modal_edithadiahLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_edithadiahLabel">Tambah Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form  role="form" id="edittoko" action="<?php echo base_url() ?>mst_hadiah/edithadiah" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_hadiah_edit">Nama</label>
                    <input type="text" class="form-control" id="nama_hadiah_edit" name="nama_hadiah_edit" >
                    <input type="hidden" class="form-control" id="id_hadiah_edit" name="id_hadiah_edit" >
                </div>
                <div class="form-group">
                    <label for="stok_awal_edit">Stok Awal</label>
                    <input type="text" class="form-control" id="stok_awal_edit" name="stok_awal_edit" >
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
    $(".edit_hadiah").click(function(){   
        var toko_id = $(this).data("user-id");
		jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : "<?= base_url() ?>mst_hadiah/get_hadiah",
			data : { toko_id : toko_id } 
			}).done(function(data){
				console.log(data[0].nama_hadiah);
                $('#id_hadiah_edit').val(toko_id);
                $('#nama_hadiah_edit').val(data[0].nama_hadiah);
                $('#stok_awal_edit').val(data[0].stok_awal);
                $('#modal_edithadiah').modal();
		});
        
    });
    
	jQuery(document).on("click", ".deleteHadiah", function(){
		var userId = $(this).data("user-id"),
			hitURL = "<?= base_url() ?>mst_hadiah/delete",
			currentRow = $(this);
            var rowId = $(this).last().attr("user-id");
		var confirmation = confirm("Anda yakin hapus hadiah ?");
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
				if(data.status = true) { alert("hadiah berhasil di hapus"); }
				else if(data.status = false) { alert("hadiah gagal di hapus"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});
</script>