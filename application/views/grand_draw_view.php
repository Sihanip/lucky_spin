<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Machine</title>
    <link rel="shortcut icon" href="#" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/slotmachines2/'); ?>css/app_2.css" />
    <link href="<?= base_url('assets/'); ?>css/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>


    <div class="flex justify-center items-center h-screen">
        <div class=" max-w-3xl">
            <!-- Main Content -->
            <div class="container mx-auto text-center">
                <div class="font-extrabold text-5xl">
                    <h3 class="mb-3">Huawei</h3>
                    <h3 class="text_2">Parsel Kejuatan Ramadan</h3>
                </div>

                <!-- Backdrop Image -->
                <img src="<?= base_url('assets/slotmachines2/'); ?>/img/Group 2.png" class="w-full mt-8" alt="image doorPrice">

                <!-- Value Name -->
                <div class="wrapper-price flex justify-center items-center">
                    <div class="body-price absolute overflow-hidden inline-block" id="example6">
                        <ul class="p-0 relative align-top" id="list_spinner">

                        </ul>
                    </div>
                </div>
            </div>

            <!-- DOORPRICE -->
            <div class="flex justify-center items-center mb-8">
                <img src="<?= base_url('assets/slotmachines2/'); ?>/img/doorprice.png" alt="img-price">

                <div class="absolute mt-4">
                    <button id="prevButton"><i class=" text-2xl fa-solid fa-circle-arrow-left text-green-800"></i></button>
                        <select id="itemSelect" class="border-0 px-8 text-lg text-gray-900 outline-none focus:ring-0 focus:border-0" >
                            <option value="Freeclip">Freeclip</option>
                            <option value="Watch Buds">Watch Buds</option>
                            <option value="Electrical Motor">Electrical Motor</option>
                        </select>
                    <button id="nextButton"><i class=" text-2xl fa-solid fa-circle-arrow-right text-green-800"></i></button>
                </div>
            </div>

            <!-- Modal Main -->
            <div class="flex justify-center gap-12 items-center">
                <!-- start button -->
                <button id="btn-start" type="button"
                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full text-center me-2 mb-2">
                    start</button>

                <!-- stop button -->
                <button id="btn-stop"
                    class="text-white cursor-not-allowed bg-red-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full text-center me-2 mb-2"
                    type="button" disabled>
                    Stop
                </button>
            </div>

            <!-- Modal toggle -->
            <button id="modal-btn" data-modal-target="static-modal" data-modal-toggle="static-modal" type="button"
                hidden>
            </button>

            <!-- Main modal -->
            <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow ">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                data-modal-hide="static-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="flex items-center justify-center">
                            <img src="<?= base_url('assets/slotmachines2/'); ?>/img/Huawei.jpg" alt="img-winner" class="w-1/2">
                        </div>
                        <div class="p-4 flex justify-between items-center">
                            <p class="text-xl leading-relaxed text-green-700 font-semibold">
                                Winner Is :
                            </p>
                            <p id='the_winner' class="text-xl leading-relaxed text-green-700 font-semibold">
                                Lorem, ipsum dolor.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="<?= base_url('assets/slotmachines2/'); ?>js/doorPrice.js"></script>
    <script src="<?= base_url('assets/slotmachines2/'); ?>js/slotmachine.js"></script>

    <script>

        var btnStart = document.getElementById("btn-start");
        var btnStop = document.getElementById("btn-stop");

        btnStart.addEventListener("click", function () {
            btnStop.removeAttribute("disabled");
            btnStop.classList.remove("cursor-not-allowed");
        });

        btnStop.addEventListener("click", function () {
            btnStop.setAttribute('disabled', true);
            btnStop.classList.add("cursor-not-allowed");
            if (!btnStart.clicked) {
                return false;
            }
        });

        $('#btn-start').click(function () {
            
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: '<?= base_url() ?>grand_draw/get_user',
                data: {
                    
                }
            }).done(function (data) {
                
                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '<?= base_url() ?>grand_draw/penerima_grand',
                    data: {
                        id_user:data[2].id,
                        hadiah:$('#itemSelect').val()
                    }
                }).done(function (data) {
                    
                });
                
                console.log(data);
                document.getElementById("list_spinner").innerHTML = "";
                for (let i = 0, len = data.length, text = ""; i < len; i++) {
                    let c= i+1;
                    el = document.createElement('li');
                    el.setAttribute("id", "val-"+c);
                    el.innerHTML = '<h5 class="text-3xl font-bold text-center">'+data[i].nama+'</h5>';
                    document.getElementById('list_spinner').appendChild(el);
                }
                
    
    
                $('#example6 ul').playSpin({
                    endNum: 3,
                    manualStop: true,
    				onEnd: function () {
    					ding.play(); 
    				},
    				onFinish: function () {
                        $("#modal-btn").click();
                        document.getElementById('the_winner').innerText = data[2].nama;
                    }
                });
            });
            // sound.play();
        });

        $('#btn-stop').click(function () {
            let value = $(this).attr("id");
            $('#example6 ul').stopSpin({
				onEnd: function () {
					ding.play(); // Play ding after each number is stopped
                    alert(value);
				},
				onFinish: function () {
                    $("#modal-btn").click();
                    alert(value);
                }
            });
        });

        let sound = new Audio("<?= base_url('assets/slotmachines2/'); ?>ringtones/spinner.mp3");
        let ding = new Audio("<?= base_url('assets/slotmachines2/'); ?>ringtones/applause.mp3");
        // Loop of playing sound
        sound.addEventListener(
            "ended",
            function () {
                this.currentTime = 0;
                this.play();
            },
            false
        );

        function checkEnter(event) {
            if (event.key === "Enter") {
                validateInput();
            }
        }

    </script>
</body>

</html>