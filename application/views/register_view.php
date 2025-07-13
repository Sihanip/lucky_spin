<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HES LUCKY DRAW</title>
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>img/icon.webp">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?=base_url('assets/');?>css/app.css">
    <link href="<?=base_url('assets/');?>css/output.css" rel="stylesheet">
    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-200">
    <div class="m-4 ">
        <div class="form-card w-full sm:w-auto shadow-lg mx-auto rounded-xl bg-white bg">
            <header class="flex flex-col justify-center items-center mt-4">
                <div class="relative flex justify-center items-center  my-6">
                    <img class="w-1/2 h-auto " src="<?=base_url('assets/');?>/img/logo.svg" alt="huawei logo">
                </div>
                <p class="mt-1">Thanks for Buying!😄</p>
            </header>
            <form id="simpan_cust" class=""  method="post">
            <main class="p-4">
                <h1 class="text-xl font-semibold text-gray-600 text-center">Grand Prize</h1>
                    <div class="my-3">
                        <div class="relative">
                            <input type="text" id="kode_toko"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-300 focus:outline-none focus:ring-0 focus:border-green-600 peer"
                                placeholder=" " autocomplete="off"/>
                            <label for="kode_toko"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Kode Akses Toko</label>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="relative">
                            <input type="hidden" id="id_toko"/>
                            <input type="text" id="nama_toko"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer"
                                placeholder=" " autocomplete="off"
                                aria-label="Disabled input example"
                                disabled />
                            <label for="nama_toko"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Nama Toko</label>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="relative">
                            <input type="text" id="nama"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer"
                                placeholder=" " autocomplete="off"/>
                            <label for="nama"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Nama</label>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="relative">
                            <input type="number" id="no_telp"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer"
                                placeholder=" " autocomplete="off"/>
                            <label for="no_telp"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                No. Telp</label>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="relative">
                            <input type="email" id="email"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer"
                                placeholder=" " autocomplete="off"/>
                            <label for="email"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Email</label>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="relative">
                            <input type="text" id="no_receip"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer"
                                placeholder=" " autocomplete="off"/>
                            <label for="no_receip"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                No Receipt</label>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="relative">
                            <input type="number" id="nominal_beli"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer"
                                placeholder=" " autocomplete="off"/>
                            <label for="nominal_beli"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Nominal Pembelian</label>
                        </div>
                    </div>
            </main>
            <footer class="mt-1 p-4">
                <button type="submit"  value="Submit" id="submitBtn" 
                    class="submit-button px-4 py-3 rounded-lg bg-green-600 text-white focus:ring focus:outline-none w-full text-lg font-semibold transition-colors">
                    Submit
                </button>
            </footer>
                </form>
        </div>
    </div>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    
<script>
$(document).ready(function(){
    
    $("#no_receip").focusout(function(){   
        var no_receip = $("#no_receip").val();
		jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : "<?= base_url() ?>customer_grand/get_no_receip",
			data : { no_receip : no_receip} 
			}).done(function(data){
                if(data[0].total > 0){
                    $("#no_receip").val("");
                    alert("No Receipt Sudah Terpakai");
                }else{
                }
		});
    });
    $("#kode_toko").focusout(function(){   
        var kode_toko = $("#kode_toko").val();
		jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : "<?= base_url() ?>customer_grand/get_kode_toko",
			data : { kode_toko : kode_toko} 
			}).done(function(data){
                if(data[0].total > 0){
			        $("#nama_toko").val(data[0].nama_toko)
			        $("#id_toko").val(data[0].id)
                }else{
                    alert("Cek Kode Akses");
                }
		});
    });
    $( "#simpan_cust" ).on( "submit", function( event ) {
        var formData = {
            id_toko: $("#id_toko").val(),
            kode_toko: $("#kode_toko").val(),
            nama: $("#nama").val(),
            no_telp: $("#no_telp").val(),
            email: $("#email").val(),
            no_receip: $("#no_receip").val(),
            nama_barang: $("#nama_barang").val(),
            nik: $("#nik").val(),
            nominal_beli: $("#nominal_beli").val(),
            total_spin: $("#total_spin").val(),
        };
        if($("#nama_toko").val()!="" && $("#nominal_beli").val() > 0 && $("#no_receip").val() !=""){
            $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>customer_grand/simpan_customer",
            data: formData,
            dataType: "json",
            encode: true,
            }).done(function (data) {
                // if(data=="success"){
                    // setInterval( () => {
                        window.location.href = '<?= base_url() ?>undian?id_toko='+$("#id_toko").val()+'&no_receip='+$("#no_receip").val();
                    // }, 50);
                // }else{
                // }
                
                
            });
        }else{
            alert("Cek input");
            
        }

        event.preventDefault();
    });
    $('#nominal_beli').keyup(function(){
        var voucher_genera = Number($('#nominal_beli').val())/2000000;
        $('#total_spin').val(1);
    });
});
</script>
</body>

</html>