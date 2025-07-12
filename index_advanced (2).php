<?php
// ضع هنا التوكن الخاص بك
$token = "ضع_توكن_البوت_هنا";

// اقرأ البيانات القادمة من Telegram
$update = json_decode(file_get_contents('php://input'), true);

// تحقق من وجود رسالة
if (!isset($update['message'])) {
    exit;
}

$message = $update['message'];
$chat_id = $message['chat']['id'];

// التحقق من نوع الرسالة (نص أو صورة)
if (isset($message['text'])) {
    $text = $message['text'];

    switch ($text) {
        case "/start":
            $reply = "مرحباً بك في بوت تربية الدواجن 🐔🚀\nاستخدم /مساعدة لعرض جميع الأوامر المتاحة.";
            break;
        case "/السوق":
            $reply = "📊 أسعار السوق اليوم:\n- كتاكيت: 25 ريال\n- علف: 1200 ريال";
            break;
        case "/توقع":
            $reply = "🔮 التوقع الذكي:\nيتوقع ارتفاع الأسعار بنسبة 5% خلال الأيام القادمة.";
            break;
        case "/اشترك":
            $reply = "💳 الاشتراك:\nشهر = 1000 ريال\nسنة = 5000 ريال\nادفع على رقم 774795157 ثم أرسل صورة الدفع.";
            break;
        case "/مساعدة":
            $reply = "📋 الأوامر المتاحة:\n/start\n/السوق\n/توقع\n/اشترك\n/مساعدة";
            break;
        default:
            $reply = "❗ لم يتم التعرف على الأمر. استخدم /مساعدة لعرض الأوامر.";
            break;
    }

    sendMessage($chat_id, $reply);

} elseif (isset($message['photo'])) {
    // الرد على الصور برسالة تلقائية
    sendMessage($chat_id, "📷 تم استلام الصورة، وسيتم تحليلها قريبًا بإذن الله.");
}

// دالة لإرسال الرسائل
function sendMessage($chat_id, $text) {
    global $token;
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        'chat_id' => $chat_id,
        'text' => $text
    ];
    file_get_contents($url . "?" . http_build_query($data));
}
?>
