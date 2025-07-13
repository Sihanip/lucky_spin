
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Detail Toko</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Toko</h6>
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
                            </fieldset>
                            <a href="#" class="btn btn-primary btn-icon-split mb-4" id="addhadiah_modal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Tambah Hadiah</span>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered display table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Hadiah</th>
                                            <th>Stok Awal</th>
                                            <th>Hadiah Terpilih</th>
                                            <th>Stok Akhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    
<div class="modal fade" id="modal_addhadiah" tabindex="-1" role="dialog" aria-labelledby="modal_addhadiahLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_addhadiahLabel">Tambah Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form  role="form" id="add_hadiah" action="<?php echo base_url() ?>detail_toko/add_hadiah" method="post" >
            <div class="modal-body">
                <div class="form-group">
                    <label for="toko">toko</label>
                        <input type="hidden" class="form-control" id="id_toko_modal" name="id_toko_modal" >
                        <fieldset disabled>
                            <input type="text" class="form-control" id="nama_toko_modal" name="nama_toko_modal" >
                        </fieldset>
                    </div>
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
                            <option value="<?php echo $lst->id; ?>"><?php echo $lst->nama_hadiah; ?></option>
                            <?php
                                $i++; }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kuota_hadiah">Kuota Hadiah</label>
                    <input type="text" class="form-control" id="kuota_hadiah" name="kuota_hadiah" >
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
                
                <fieldset disabled>
                    <div class="form-group">
                        <label for="nama_hadiah_add">Nama Hadiah</label>
                        <input type="text" class="form-control" id="nama_hadiah_add" name="nama_hadiah_add" >
                    </div>
                    <div class="form-group">
                        <label for="stok_sekarang_add">Stok Sekarang</label>
                        <input type="text" class="form-control" id="stok_sekarang_add" name="stok_sekarang_add" >
                    </div>
                </fieldset>
                <div class="form-group">
                    <label for="tambah_stok">Tambah Stok</label>
                    <input type="hidden" class="form-control" id="stok_sekarang_add2" name="stok_sekarang_add2" >
                    <input type="hidden" class="form-control" id="total_stok_add2" name="total_stok_add2" >
                    <input type="hidden" class="form-control" id="id_hadiah_add2" name="id_hadiah_add2" >
                    <input type="hidden" class="form-control" id="id_toko_add2" name="id_toko_add2" >
                    <input type="text" class="form-control" id="tambah_stok" name="tambah_stok" >
                </div>
                <fieldset disabled>
                    <div class="form-group">
                        <label for="total_stok2">Total Stok</label>
                    <input type="text" class="form-control" id="total_stok2" name="total_stok2" >
                    </div>
                </fieldset>
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
    $('#select_toko').change(function(){
            var table = $('#dataTable').DataTable({
            "ajax": {
                url: "<?= base_url() ?>detail_toko/get_detail_toko",
                dataSrc: "",
                data: { toko_id: $('#select_toko').val() }
            },
            dom: "Bfrip",
            "columns": [
                { data: "nama_hadiah"},
                { data: "stok"},
                { data: "hadiah_didapat"},
                { data: "stok_akhir"},
                { data: "id_hadiah"},
            ],
            columnDefs: [
            {  targets: 4,
                width: "100px",
                render: function (data, type, row, meta) {
                    return '<input type="button" class="add_stok" id=s-"' + meta.row + '" value="Tambah Stok"/>';
                }

            }
            ],
            "order": [ 1, 'desc' ],
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
            id_hadiah_add2: $("#id_hadiah_add2").val(),
            id_toko_add2: $("#id_toko_add2").val(),
            stok_sekarang_add2: $("#stok_sekarang_add2").val(),
            tambah_stok: $("#tambah_stok").val(),
            total_stok2: $("#total_stok2").val(),
        };

        $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>detail_toko/add_stok",
        data: formData,
        dataType: "json",
        encode: true,
        }).done(function (data) {
            $('#modal_tambahstok').modal('hide');
            $('#select_toko').change();
        });

        event.preventDefault();
    });
    $('#tambah_stok').keyup(function(){
        var stok_total = Number($('#stok_sekarang_add2').val())+ Number($('#tambah_stok').val());
        $('#total_stok_add2').val(stok_total);
        $('#total_stok2').val(stok_total);
    });
    
    $('#dataTable tbody').on('click', '.add_stok', function () {
        var id = $(this).attr("id").match(/\d+/)[0];
        var data = $('#dataTable').DataTable().row( id ).data();
        console.log(data.id);
        if(data.id !=""){
            $('#total_stok2').val("");
            $('#tambah_stok').val("");
            $('#stok_sekarang_add').val(data.stok);
            $('#stok_sekarang_add2').val(data.stok);
            $('#nama_hadiah_add').val(data.nama_hadiah);
            $('#id_hadiah_add2').val(data.id_hadiah);
            $('#id_toko_add2').val($('#select_toko').val());
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