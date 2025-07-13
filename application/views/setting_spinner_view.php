
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Setting Lucky Draw</h1>
                    <p class="mb-4"></p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Setting Lucky Draw</h6>
                        </div>
                        <div class="card-body"  style="width: 18rem;">
                        <img class="card-img-top  p-3" src="<?php echo base_url() ?>assets/img/lucky.png" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pilih Toko</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="select_toko" name="select_toko" aria-label="Default select example">
                                        
                                        <option value=""selected>Open this select menu</option>
                                        <?php 
                                            if(!empty($list_toko))
                                            { $i=1;
                                                foreach($list_toko as $lst)
                                                {
                                            ?>
                                            <option value="<?php echo $lst->id; ?>"><?php echo $lst->nama_toko; ?></option>
                                            <?php
                                                    $i++; }
                                                }
                                                ?>
                                    </select>
                                </div>
                            </div>
                            <fieldset disabled>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nama Toko</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="nama_toko" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Alamat Toko</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="alamat_toko" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="username_akses" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </fieldset>
                            <div class="table-responsive">
                                <table class="table table-bordered display table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No Spin</th>
                                            <th>Nama Hadiah</th>
                                            <th>Stok Hadiah</th>
                                            <th>Hadiah Terpilih</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
           
<!-- Modal -->
<div class="modal fade" id="modal_tambahstok" tabindex="-1" role="dialog" aria-labelledby="modal_tambahstokLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_tambahstokLabel">Tambah Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form  role="form" id="add_stok" action="<?php echo base_url() ?>detail_toko/add_stok" method="post">
            <div class="modal-body">
                
                <div class="form-group">
                    <label for="nama_hadiah">Nama Hadiah</label>
                    <select class="form-select" id="select_hadiah" name="select_hadiah" aria-label="Default select example">     
                            <option value=""selected>Open this select menu</option>
                            <?php 
                                if(!empty($list_hadiah))
                                { $i=1;
                                foreach($list_hadiah as $lst)
                                {
                            ?>
                            <option value="<?php echo $lst->id_hadiah; ?>"><?php echo $lst->nama_hadiah; ?></option>
                            <?php
                                $i++; }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="no_spinner" name="no_spinner" >
                    <input type="hidden" class="form-control" id="id_toko_add2" name="id_toko_add2" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit"  value="Submit" id="submitBtn_edit"  class="btn btn-primary">Tambah Hadiah</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $('#select_toko').change(function(){
            var table = $('#dataTable').DataTable({
            "ajax": {
                url: "<?= base_url() ?>setting_spinner/get_setting_spinner",
                dataSrc: "",
                data: { toko_id: $('#select_toko').val() }
            },
            dom: "Bfrip",
            "columns": [
                { data: "no_spinner"},
                { data: "nama_hadiah"},
                { data: "stok"},
                { data: "hadiah_didapat"},
                { data:"stok"},
            ],
            columnDefs: [
            {  targets: 4,
                width: "100px",
                render: function (data, type, row, meta) {
                    return '<input type="button" class="add_stok" id=s-"' + meta.row + '" value="Pilih Hadiah"/>';
                }

            }
            ],
            "order": [ 0, 'asc' ],
            paging: false,
            fixedHeader: true,
            destroy: true,
        });
      
		jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : "<?= base_url() ?>mst_toko/get_toko",
			data : { toko_id : $('#select_toko').val() } 
			}).done(function(data){
				console.log(data[0].nama_toko);
                $('#nama_toko').val(data[0].nama_toko);
                $('#id_toko').val(data[0].id);
                $('#kode_akses').val(data[0].kode_akses);
                $('#username_akses').val(data[0].username_akses);
                $('#alamat_toko').val(data[0].alamat_toko);
		});
        table.on('click', 'button', function (e) {
            let data = table.row(e.target.closest('tr')).data();
        
            alert(data[0] + "'s salary is: " + data[1]);
        });
    });
    $( "#add_stok" ).on( "submit", function( event ) {
        var formData = {
            id_hadiah: $("#select_hadiah").val(),
            no_spinner: $("#no_spinner").val(),
            username_toko: $("#id_toko_add2").val(),
        };

        $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>setting_spinner/update_hadiah",
        data: formData,
        dataType: "json",
        encode: true,
        }).done(function (data) {
            $('#modal_tambahstok').modal('hide');
            $('#select_toko').change();
        });

        event.preventDefault();
    });
    
    $('#dataTable tbody').on('click', '.add_stok', function () {
        var id = $(this).attr("id").match(/\d+/)[0];
        var data = $('#dataTable').DataTable().row( id ).data();
        console.log(data.id);
        if(data.id !=""){
            $('#no_spinner').val(data.no_spinner);
            $('#id_toko_add2').val($('#username_akses').val());
            $('#modal_tambahstok').modal();
        }
        
    });
    $("#select_hadiah").change(function(){   
        var id_hadiah = $("#select_hadiah").val();
        var id_toko = $("#id_toko_modal").val();
		jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : "<?= base_url() ?>detail_toko/get_cek_toko",
			data : { id_toko : id_toko, id_hadiah : id_hadiah} 
			}).done(function(data){
                if(data[0].total > 0){
                    alert("Hadiah sudah ada !");
                    $('#modal_addhadiah').modal('hide');
                }
		});
    });
    
	jQuery(document).on("click", "#addhadiah_modal", function(){
        if($('#nama_toko').val() !=""){
            $('#id_toko_modal').val($('#select_toko').val());
            $('#nama_toko_modal').val($('#nama_toko').val());
            $('#modal_addhadiah').modal();
        }
	});
});
</script>