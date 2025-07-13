<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Machine</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?=base_url('assets/slotmachine/');?>css/app.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="area position-fixed">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <!-- ATUR WIDTH DI CONTAINER -->
    <div class="container mx-auto w-25"> 
        <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="col">
                <div class="input-group my-3">
                    <input type="text" class="form-control" placeholder="Input ID" aria-label="Input ID"
                        autocomplete="off" id="input_Id" aria-describedby="basic-addon2" oninput="toggleButton()"
                        onkeydown="checkEnter(event)">
                    <button class="input-group-text btn btn-success" id="btn-example6" onclick="validateInput()"
                        disabled>Start Spin!</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- Alert js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="<?=base_url('assets/slotmachine/');?>js/slotmachine.js"></script>
    <script>
        let expectedValues = ["1", "2", "3"];

        function validateInput() {

            let userInput = document.getElementById('input_Id').value;

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
                    }, 1000);
                }else{
                    swal.fire({
                        title: "Oops...",
                        text: "Voucher Tidak Valid",
                        icon: "question",
                    }, 3000)
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

        let sound = new Audio('ringtones/spinning.mp3');
        let ding = new Audio('ringtones/ding.wav');
        // Loop of playing sound
        sound.addEventListener('ended', function () {
            this.currentTime = 0;
            this.play();
        }, false);

    </script>
</body>

</html>
