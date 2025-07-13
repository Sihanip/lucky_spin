
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">List Voucher</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Voucher</h6>
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
                            <!--<a href="#" class="btn btn-primary btn-icon-split mb-4" id="addhadiah_modal">-->
                            <!--    <span class="icon text-white-50">-->
                            <!--        <i class="fas fa-plus"></i>-->
                            <!--    </span>-->
                            <!--    <span class="text">Tambah Hadiah</span>-->
                            <!--</a>-->
                            <div class="table-responsive">
                                <table class="table table-bordered display table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kode Voucher</th>
                                            <th>Nama</th>
                                            <th>Status Voucher</th>
                                            <th>Hadiah</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
        
<script>
$(document).ready(function(){
    $('#select_toko').change(function(){
            var table = $('#dataTable').DataTable({
            "ajax": {
                url: "<?= base_url() ?>list_voucher/get_list_voucher",
                dataSrc: "",
                data: { toko_id: $('#select_toko').val() }
            },
            dom: "Bfrip",
            "columns": [
                { data: "kode_voucher"},
                { data: "nama"},
                { data: "status_voucher"},
                { data: "nama_hadiah"},
                { data: "created_at"},
            ],
            columnDefs: [
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
    $( "#simpan_cust" ).on( "submit", function( event ) {
        var formData = {
            id_toko_modal: $("#id_toko_modal").val(),
            nama: $("#nama").val(),
            no_wa: $("#no_wa").val(),
            no_inv: $("#no_inv").val(),
            total_belanja: $("#total_belanja").val(),
            voucher_generated: $("#voucher_generated").val(),
        };

        $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>list_voucher/simpan_customer",
        data: formData,
        dataType: "json",
        encode: true,
        }).done(function (data) {
            $('#modal_tambahstok').modal('hide');
            $('#select_toko').change();
        });

        event.preventDefault();
    });
    $('#total_belanja').keyup(function(){
        var voucher_genera = Number($('#total_belanja').val())/2000000;
        $('#voucher_generated').val(Math.floor(voucher_genera));
        $('#voucher_generated2').val(Math.floor(voucher_genera));
    });
    
    $('#dataTable tbody').on('click', '.simpan_customer', function () {
        var id = $(this).attr("id").match(/\d+/)[0];
        var data = $('#dataTable').DataTable().row( id ).data();
        console.log(data.id);
        if(data.id !=""){
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
			url : "<?= base_url() ?>list_voucher/get_cek_toko",
			data : { id_toko : id_toko, id_hadiah : id_hadiah} 
			}).done(function(data){
                if(data[0].total > 0){
                    alert("Hadiah sudah ada !");
                    $('#modal_addcust').modal('hide');
                }
		});
    });
    
	jQuery(document).on("click", "#addhadiah_modal", function(){
        if($('#nama_toko').val() !=""){
            $('#id_toko_modal').val($('#select_toko').val());
            $('#nama_toko_modal').val($('#nama_toko').val());
            $('#modal_addcust').modal();
        }
	});
});
</script>