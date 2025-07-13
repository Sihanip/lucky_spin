<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?=base_url('assets/');?>css/app.css">
    <link rel="stylesheet" href="<?=base_url('assets/');?>css/output.css">
    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
</head>

<body style="background-color: rgb(100, 0, 0);">
    <div class="container mx-auto text-center justify-center items-center flex-col flex h-screen px-4">
        <div class="grid grid-cols-1 login-wrapper gap-4">
        <div class="flex">
            <input placeholder="Input ID" aria-label="Input ID" autocomplete="off" id="input_Id"
                aria-describedby="basic-addon2" oninput="toggleButton()" onkeydown="checkEnter(event)"
                class="rounded-none rounded-s-lg bg-gray-50 border focus:ring-red-900 focus:border-red-900 block flex-1 text-md p-2.5 w-1/2">
            <button onclick="validateInput()" disabled id="btn-example6"
                class="inline-flex items-center px-4 sm:px-8 text-md bg-red-800 rounded-s-0 rounded-e-md cursor-pointer text-white">
                Login
                <svg class="w-5 h-5 text-white ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                </svg>
            </button>
        </div>
        <h5 class="text-2xl font-bold text-white mt-4 text-center">Login</h5>
    </div>
</div>

    <!-- Toastify -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        function validateInput() {

            let userInput = document.getElementById('input_Id').value;

            if (userInput.trim() === '') {
                Toastify({
                    text: "ID Cannot Be Empaty",
                    duration: 3000,
                    position: "right",
                    gravity: "top",
                    style: {
                        background: "white",
                        color: "red",
                        textAlign: "center",
                        borderRadius: "10px",
                    }
                }).showToast();
                return;
            }

            // if (expectedValues.includes(userInput)) {
            //     window.location = "index2.html";

            // } else {
            // }

			$.ajax({
				url: '<?= base_url() ?>undian/get_id',
				data: {id:userInput},
			})
			.done(function(data) {
                let data2 =JSON.parse(data);
				let id_toko		 = data2.id_toko;
				let kode_voucher = data2.kode_voucher;
                if(id_toko !='none'){
                    setInterval( () => {
                        window.location.href = '<?= base_url() ?>undian?id_toko='+id_toko+'&kode_voucher='+kode_voucher;
                    }, 200);
                }else{
                    Toastify({
                        text: "ID Wrong",
                        duration: 2500,
                        position: "right",
                        gravity: "top",
                        style: {
                            background: "white",
                            color: "red",
                            textAlign: "center",
                            borderRadius: "10px"
                        }
                    }).showToast();
                }
			});

            // Reset nilai input
            document.getElementById('input_Id').value = '';

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
        
    </script>

    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>