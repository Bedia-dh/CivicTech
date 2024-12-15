<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Proposition</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="interieur.png">
            <img src="tun.jpg">
        </div>
    </div>
    <!-- Section pour la label cliquable -->
    <section id="proposal-section">
        <div class="container">
            <h2>فضاء المواطن - تقديم اقتراح</h2>
            <p>يمكنك تقديم مشروع جديد للبلدية من خلال تعبئة الاستمارة التالية:</p>
            <button id="open-form" class="button">أضف مشروعك</button>
        </div>

        <!-- Interface du formulaire -->
        <div id="form-container" class="hidden">
            <h3>نموذج تقديم مشروع</h3>
            <form action="index.php" method="post">
            <label for="name">الاسم :</label>
            <input type="text" id="name" name="name" placeholder="أدخل اسمك">

            <label for="family_name">اللقب :</label>
            <input type="text" id="family_name" name = "family_name" placeholder="أدخل لقبك">
            
            
            <label for="phone">رقم الهاتف :</label>
            <input type="text" id="phone" name="phone" placeholder="أدخل رقم الهاتف">

            <label for="email">البريد ال لكتروني:</label>
            <input type="email" id="email" name="email" placeholder="أدخل البريد ال��لكتروني">



            <div class="input-group">
                    <label for="region">المنطقة:</label>
                    <br>
                    <select id="region" name = "region">
                        <option value="">اختر ولاية</option>
                        <option value="ariana">أريانة</option>
                        <option value="beja">باجة</option>
                        <option value="ben-arous">بن عروس</option>
                        <option value="bizerte">بنزرت</option>
                        <option value="gabes">قابس</option>
                        <option value="gafsa">قفصة</option>
                        <option value="jendouba">جندوبة</option>
                        <option value="kairouan">القيروان</option>
                        <option value="kasserine">القصرين</option>
                        <option value="kebili">قبلي</option>
                        <option value="kef">الكاف</option>
                        <option value="mahdia">المهدية</option>
                        <option value="manouba">منوبة</option>
                        <option value="medenine">مدنين</option>
                        <option value="monastir">المنستير</option>
                        <option value="nabeul">نابل</option>
                        <option value="sfax">صفاقس</option>
                        <option value="sidi-bouzid">سيدي بوزيد</option>
                        <option value="siliana">سليانة</option>
                        <option value="sousse">سوسة</option>
                        <option value="tataouine">تطاوين</option>
                        <option value="tozeur">توزر</option>
                        <option value="tunis">تونس</option>
                        <option value="zaghouan">زغوان</option>
                    </select>

                </div>   
                <label for="postal_code">الرمز البريدي :</label>
                    <input type="text" id="postal_code" name = "postal_code" placeholder="...">

                    <label for="municipalities">البلدية :</label>
                    <select id="municipalities" name = "municipalities"></select>


                <div class="input-group">
                <label for="description">وصف المشروع :</label>
                <textarea id="description" name= "description" rows="5" placeholder="أدخل وصف مشروعك"></textarea>
                </div>

                
                <div class="input-group">
                <label for="amount">:المبلغ المقترح</label>
                <input type="number" id="amount" name="amount" placeholder="المبلغ المقترح" min="0">
                </div>


                <input class="button" type="submit" value="submit" name="send">
            </form>
        </div>
    </section>

    <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$REGION_EMAILS = [
    'ben-arous' => 'jguirimahmed111@gmail.com',
    'ariana' => 'badiidh125@gmail.com',
    'bizerte' => 'nour.nsiri2009@gmail.com',
    'gabes' => 'kahlounahmed1@gmail.com',
    'gafsa' => 'kahlounahmed1@gmail.com',
    'jendouba' => 'kahlounahmed1@gmail.com',
    'kairouan' => 'kahlounahmed1@gmail.com',
    'kasserine' => 'kahlounahmed1@gmail.com',
    'kebili' => 'kahlounahmed1@gmail.com',
    'kef' => 'kahlounahmed1@gmail.com',
    'mahdia' => 'kahlounahmed1@gmail.com',
    'manouba' => 'kahlounahmed1@gmail.com',
    'medenine' => 'kahlounahmed1@gmail.com',
    'monastir' => 'kahlounahmed1@gmail.com',
    'nabeul' => 'kahlounahmed1@gmail.com',
    'sfax' => 'kahlounahmed1@gmail.com',
    'sidi-bouzid' => 'kahlounahmed1@gmail.com',
    'siliana' => 'kahlounahmed1@gmail.com',
    'sousse' => 'kahlounahmed1@gmail.com',
    'tataouine' => 'kahlounahmed1@gmail.com',
    'tozeur' => 'kahlounahmed1@gmail.com',
    'tunis' => 'kahlounahmed1@gmail.com',
    'zaghouan' => 'kahlounahmed1@gmail.com',
    'beja' => 'kahlounahmed1@gmail.com'
];

function get_recipient_email($region) {
    global $REGION_EMAILS;
    return isset($REGION_EMAILS[$region]) ? $REGION_EMAILS[$region] : "jguirimahmed111@gmail.com";
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['send']))
{
    $sender_name = "smtp tester";
    $sender_email = "noreply@mailer.org";
    //
    $username = "jguirimahmed112@gmail.com";
    $password = "oipn ibhp txum thkm";
    //

    $region = isset($_POST['region']) ? strtolower(sanitize_input($_POST['region'])) : '';
    $receiver_email = get_recipient_email($region);

    $receiver_email = $receiver_email;
    $message = "<html><body>";
    $message .= "<p><strong>Date:</strong> " . date("Y-m-d H:i:s") . "</p>";
    $message .= "<p><strong>Sender Details:</strong></p>";
    $message .= "<p>Name: " . $_POST['name'] . "</p>";
    $message .= "<p>Family Name: " . $_POST['family_name'] . "</p>";
    $message .= "<p>Municipality: " . $_POST['municipalities'] . "</p>";
    $message .= "<p>Region: " . $_POST['region'] . "</p>";
    $message .= "<p>Postal Code: " . $_POST['postal_code'] . "</p>";
    $message .= "<p><strong>Phone:</strong> " . $_POST['phone'] . "</p>";
    $message .= "<p><strong>Email:</strong> " . $_POST['email'] . "</p>";
    $message .= "<p><strong>Description:</strong> " . $_POST['description'] . "</p>";
    $message .= "<p><strong>montant:</strong> " . $_POST['amount'] . "</p>";
    $message .= "</body></html>";
    $subject = "project proposal by ".$_POST['name'];
    
    $mail = new PHPMailer(true);
    $mail->isSMTP();
  //$mail->SMTPDebug = 2;
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
  
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    
    $mail->setFrom($sender_email, $sender_name);
    $mail->Username = $username;
    $mail->Password = $password;
  
    $mail->Subject = $subject;
    $mail->msgHTML($message);
    $mail->addAddress($receiver_email);
    if (!$mail->send()) {
        $error = "Mailer Error: " . $mail->ErrorInfo;
        echo '<p id="info_msg">'.$error.'</p>';
        echo '<p id="info_msg">'.$_POST["amount"].'</p>';
    }
    else {
        echo '<p id="info_msg"></p>';
    }
}
else{
    echo '<p id="info_msg"></p>';
}
?>

    <script src="App.js"></script>
</body>
</html>
