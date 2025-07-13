<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HES LUCKY DRAW</title>
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>img/icon.webp">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/app.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/output.css">
    <!-- Font Awasome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>

<body>

        <div class=" container mx-auto justify-center items-center flex h-screen">
            <!--<button type="button" id="back_btn"  onclick="back(event)" class="text-white bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold items-center flex flex-row w-auto rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">-->
            <!--    <i class="fa-solid fa-arrow-left pe-4 "></i>Back-->
            <!--</button>-->
            <div class="wrapper-spin grid grid-cols-1">
                
                <div class="btn_back mb-5">
                  <a href="#" id="back_btn"  onclick="back(event)">
                    <i
                      class="fa fa-arrow-left-long border-2 border-green-800 rounded-full p-3 text-green-800 w-11 cursor-pointer"
                    ></i>
                  </a>
                </div>
                
                <div class="bg-white border-2 border-gray-200 rounded-lg shadow-md">
                    <div class="text-center mt-5">
                        <h5 class="text-gray-800 text-lg font-bold">HUAWEI</h5>
                        <p class="text-green-600 text-2xl font-bold">Parsel Kejutan Ramadan</h5>
                    </div>
                      
                    <div class="body-spin inline-block overflow-hidden" id="example6">
                        <ul class="p-0 relative align-top">
            
                            <?php
                            if (!empty($list_hadiah)) {
                                $i = 1;
                                foreach ($list_hadiah as $lst) {
                                    ?>
                                    <li id="val-<?php echo $i; ?>">
                                        <div class="flex justify-center items-center">
                                            <img src="<?= base_url('assets/upload/'); ?><?php echo $lst->gambar; ?>"
                                                alt="<?php echo $lst->gambar; ?>">
                                        </div>
                                    </li>
            
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    
                      <div class="px-5 pb-5">
                        <div class="flex items-center justify-between">
                                <div class="relative w-full rounded">
                                    <input type="text" id="input_Id"
                                value="" oninput="toggleButton()"
                                onkeydown="checkEnter(event)"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-green-600 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-green-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer"
                                    placeholder=" " disabled/>
                                    <button type="submit" id="btn-example6" onclick="validateInput()"
                                        class="absolute top-0 end-0 p-2.5 text-sm font-medium text-white bg-green-700 rounded-e-lg border border-green-700 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 h-full">
                                        <span>Start Spin!</span>
                                    </button>
                                    <label for="input_Id" style=""
                                        class="absolute text-sm text-white duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]   px-2 peer-focus:px-2 peer-focus:text-green-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                        ID</label>
                                </div>
                                
                        </div>
                      </div>
                </div>

        <div class="">
            <input type="hidden" value="<?= $this->session->userdata('id_toko') ?>" id="idToko" name="idToko"
                                aria-label="Disabled input example"
                                disabled>
            <input type="hidden" value="<?= $this->session->userdata('no_receip') ?>" id="no_receip" name="no_receip"
                                aria-label="Disabled input example"
                                disabled>
            <input type="hidden" value="" id="tot_spin" name="tot_spin" 
                                aria-label="Disabled input example"
                                disabled />
            <input type="hidden" value="" id="nama_cust" name="nama_cust"
                                aria-label="Disabled input example"
                                disabled />
        </div>
    </div>
    </div>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <!-- Alert js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="<?=base_url('assets/slotmachine/');?>js/slotmachine.js"></script>

    <script>

        $(document).ready(function () {
            
            var no_receip = $("#no_receip").val();
    		jQuery.ajax({
    			type : "POST",
    			dataType : "json",
    			url : "<?= base_url() ?>undian/get_spin",
    			data : { no_receip : no_receip} 
    			}).done(function(data){
                    if(data.tot_spin > 0){
    			        $("#tot_spin").val(data.tot_spin)
    			        $("#input_Id").val(data.kode_voucher)
    			        $("#nama_cust").val(data.nama)
                        toggleButton();
                    }else{
                        setTimeout(function () {
                            swal.fire({
                                title: "Oops...",
                                text: "Spin sudah habis",
                                icon: "question",
                            }, 3000)
                        });
                        $('#back_btn').show();
                    }
    		});
            $('#back_btn').hide();
        });
        function validateInput() {

            let userInput = document.getElementById('input_Id').value;
            let idToko = document.getElementById('idToko').value;

            if (userInput.trim() === '') {
                setTimeout(function () {
                    swal.fire({
                        title: "Oops...",
                        text: "ID NULL",
                        icon: "question",
                    }, 3000)
                });
                return;
            }

            $.ajax({
                url: '<?= base_url() ?>undian/get_id_random',
                data: { id_voucher: userInput, idToko: idToko },
            })
                .done(function (data) {
                    let data2 = JSON.parse(data);
                    if (data2.urut_hadiah != '-') {
                        let urut_hadiah = data2.urut_hadiah;
                        let id_hadiah = data2.hadiah;
                        let gambar = data2.gambar;
                        let nama = data2.nama;
                        let kode_voucher = data2.id;
                        setTimeout(function () {
                            jQuery.ajax({
                                type: "POST",
                                dataType: "json",
                                url: '<?= base_url() ?>undian/save_history_hadiah',
                                data: {
                                    id_hadiah: id_hadiah,
                                    kode_voucher: userInput,
                                    id_toko: idToko,
                                }
                            }).done(function (data) {
                                console.log(data);
                            });
                            sound.play(); // Start play the sound after click button
                            $('#example6 ul').playSpin({
                                time: 4000,
                                endNum: [urut_hadiah],
                                onEnd: function () {
                                    ding.play(); // Play ding after each number is stopped
                                },
                                onFinish: function () {
                                    sound.pause();
                                    Swal.fire({
                                        title: "Yey!",
                                        text: ("congratulations "+$("#nama_cust").val()+" got: " + nama),
                                        imageUrl: "<?= base_url('assets/upload/'); ?>" + gambar,
                                        imageWidth: 300,
                                        imageHeight: 300,
                                    });
                                    
                                    var no_receip = $("#no_receip").val();
                            		jQuery.ajax({
                            			type : "POST",
                            			dataType : "json",
                            			url : "<?= base_url() ?>undian/get_spin",
                            			data : { no_receip : no_receip} 
                            			}).done(function(data){
                                            if(data.tot_spin > 0){
                            			        $("#tot_spin").val(data.tot_spin)
                            			        $("#input_Id").val(data.kode_voucher)
                            			        $("#nama_cust").val(data.nama)
                                                toggleButton();
                                            }else{
                                                $("#tot_spin").val(0);
                                                $("#input_Id").val("");
                                                $('#back_btn').show();
                                                // setTimeout(function () {
                                                //     swal.fire({
                                                //         title: "Oops...",
                                                //         text: "Spin sudah habis",
                                                //         icon: "question",
                                                //     }, 3000)
                                                // });
                                                // alert("Spin Sudah Habis");
                                            }
                            		});
                                },
                                easing: 'easeOutBack'
                            });

                        });
                    } else {
                        setTimeout(function () {
                            swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "ID Incorrect, Please Enter ID Correctly.",
                                confirmButtonColor: '#d33',
                                showConfirmButton: true,
                            }, 3000)
                            
                            $('#back_btn').show();
                        });
                        // alert("ID Salah")
                    }
                });
            // Nonaktifkan button setelah reset nilai input
            toggleButton();
        }

        function toggleButton() {
            let userInput = document.getElementById('input_Id').value;
            let validateButton = document.getElementById('btn-example6');

            // Nonaktifkan tombol jika input kosong, aktifkan jika ada input
            validateButton.disabled = userInput.trim() === '';
        }

        function checkEnter(event) {
            if (event.key === "Enter") {
                validateInput();
            }
        }
        function back(event) {
                    // setInterval( () => {
                        window.location.href = '<?= base_url() ?>undian/register';
                    // }, 200);
        }
        let sound = new Audio('<?=base_url('assets/slotmachine/');?>ringtones/spinning.mp3');
        let ding = new Audio('<?=base_url('assets/slotmachine/');?>ringtones/ding.wav');
        // Loop of playing sound
        sound.addEventListener('ended', function () {
            this.currentTime = 0;
            this.play();
        }, false);

    </script>
</body>

</html>