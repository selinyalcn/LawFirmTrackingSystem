<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <style>
        /* CSS Stil Kodları */
        .girisyapbutonu {
            z-index: 5;
        }

        .yazi {
            z-index: 5;
        }

        .header {
            text-align: center;
            display: flex;
            justify-content: center; /* İçeriği yatayda ortala */
            align-items: center;
            background-color: #aaa;
            color: black;
            height: 75px;
            position: relative;
            z-index: 1;
        }

        .login-button {
            background-color: #333; /* Buton arka plan rengi */
            color: #fff; /* Buton yazı rengi */
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            position: absolute; /* Butonu pozisyonlandırmak için */
            right: 20px; /* Sağdan 20px içeri */
            top: 50%; /* Üstten dikey ortala */
            transform: translateY(-50%); /* Dikey olarak ortala */
            z-index: 5; /* Resmin önünde olması için */
        }

        .modal {
            display: none; /* Modalı başlangıçta gizle */
            position: fixed; /* Sabit konumda */
            z-index: 3; /* Diğer içeriklerden önde olması için */
            left: 0;
            top: 0;
            width: 100%; /* Ekran genişliği */
            height: 100%; /* Ekran yüksekliği */
            overflow: auto; /* İçerik dışına taşarsa kaydırma çubuğunu göster */
            background-color: rgba(0, 0, 0, 0.4); /* Arka plana bir opaklık ekleyerek modal dışındaki içeriği bulanıklaştır */
            padding-top: 60px; /* Modalın üst kısmındaki içeriği ayarlamak için */
        }

        .modal-content {
            background-color: #fff; /* Arka plan rengi */
            margin: 5% auto; /* Modalı dikey olarak ortala */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 50%; /* Modalın genişliği */
            z-index: 2;

        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            z-index: 2;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
            z-index: 2;
        }

        .login-box {
            text-align: center;
            z-index: 5;
        }

        .login-box h2 {
            margin: 0 0 30px;
            padding: 0;
            color: #333; /* Başlık rengi */
            z-index: 5;
        }

        .login-box .user-box {
            position: relative;
            margin-bottom: 30px;
            z-index: 5;
        }

        .login-box .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #333; /* Yazı rengi */
            margin-bottom: 5px;
            border: none;
            border-bottom: 1px solid #ccc; /* Alt çizgi rengi */
            outline: none;
            background: transparent;
            z-index: 5;
        }

        .login-box .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            color: #666; /* Etiket rengi */
            pointer-events: none;
            transition: .5s;

        }

        .login-box .user-box input:focus ~ label,
        .login-box .user-box input:valid ~ label {
            top: -20px;
            left: 0;
            color: #2a3030; /* Aktif etiket rengi */
            font-size: 12px;

        }

        .login-box button {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            background: #273838; /* Buton arka plan rengi */
            color: #fff; /* Buton yazı rengi */
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
            z-index: 5;
        }

        .login-box button:hover {
            background: #2d3f45; /* Hover buton arka plan rengi */
            z-index: 5;
        }

        .login-box form a {
            display: block;
            margin-top: 20px;
            color: #333; /* Link rengi */
            text-decoration: none;
            z-index: 5;
        }

        .login-box form a:hover {
            color: #2d3f45; /* Hover link rengi */
            z-index: 5;
        }

        .login-button {
            background-color: #2d3f45; /* Mavi arka plan rengi */
            color: #fff; /* Beyaz metin rengi */
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            z-index: 5;
        }

        .login-button:hover {
            background-color: #2d3f45; /* Hover durumunda arka plan rengi */

        }

        .saydam-resim {
            position: relative; /* Resmi içeren container'ı sabit konumda tut */
            width: 100%;
            height: 100%;
            z-index: -1; /* Resmi arkaya al */
            overflow: hidden; /* Resmin container'ından taşan kısımları gizle */
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        * {
            margin: 0;
            padding: 0;

        }

        /* Diğer CSS stilleri buraya gelecek */

        .footer {
            position: relative; /* Footer'ı sabit konumda değil, resmin altında yer alacak */
            background-color: #151515;
            padding: 80px 0;
            color: #FFF;
            text-align: center;
            z-index: 0; /* Resmin altına yerleştir */
        }

        .footer.show {
            bottom: 0; /* İçerik en altta olduğunda footer'ı göster */
        }

        .container {
            max-width: 1170px;
            margin: auto;
            height: 300px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        ul {
            list-style: none;

        }

        .footer-col {
            width: 25%;
            padding: 0 15px;
        }

        .footer-col h4 {
            font-size: 18px;
            color: #FFF;
            text-transform: capitalize;
            margin-bottom: 35px;
            font-weight: 500;
            position: relative;
        }

        .footer-col h4::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -10px;
            background-color: #E91E63;
            width: 50px;
            height: 2px;
        }

        .footer-col ul li:not(:last-child) {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            color: #DDD;
            display: block;
            font-size: 1rem;
            font-weight: 300;
            text-transform: capitalize;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-col ul li a:hover {
            color: #FFF;
            padding-left: 7px;
        }

        .footer-col .social-links a {
            color: #FFF;
            background-color: rgba(255, 255, 255, 0.2);
            display: inline-block;
            height: 40px;
            width: 40px;
            border-radius: 50%;
            text-align: center;
            margin: 0 10px 10px 0;
            line-height: 40px;
            transition: all 0.5s ease;
        }

        .footer-col .social-links a:hover {
            color: #151515;
            background-color: #FFF;
        }

        @media(max-width: 767px) {
            .footer-col {
                width: 50%;
                margin-bottom: 30px;
            }
        }

        @media(max-width: 574px) {
            .footer-col {
                width: 100%;
            }
        }

        /* Resmin arka planda kalması için gerekli CSS */
        .background-image {
            position: absolute; /* Resmi sabit konumda tut */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Resmi arka plana al */
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .content {
            z-index: 2;
        }

        .resim-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .resim-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.5;
        }

        h1 {
            text-align: center;
        }

        .background-container {
            position: relative; /* Resmin container'ını sabit konumda tut */
            width: 100%;
            height: 100vh; /* Ekranın tamamını kaplaması için */
        }

        .background-image {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Resmi container'a sığdır */
            opacity: 0.5; /* %50 opaklık */
        }

        .overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: gold; /* Altın rengi */
        }

        .overlay-text h1 {
            font-size: 3rem; /* İstenilen büyüklük */
            margin-bottom: 20px;
        }

        .overlay-text p {
            font-size: 1.5rem; /* İstenilen büyüklük */
            margin-top: 20px;
        }

        .content-section {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 50px 0;
        }

        .content-section img {
            margin-right: 20px;
            max-width: 100%;
            height: auto;
        }

        .content-section .text-content {
            max-width: 600px;
        }
    </style>

</head>
<body>
<div class="header">
    <!-- Header içeriği -->
    <h1>SEMSS BİLİŞİM SİSTEMLERİNE HOŞGELDİNİZ</h1>

    <button class="login-button" onclick="openLoginModal()">Giriş Yap</button>

</div>

<!-- Giriş modalı -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeLoginModal()">&times;</span>
        <div class="login-box">
            <div class="yazi">
                <h2>SEMSS HUKUK BÜROSU</h2>
                <h2>GİRİŞ EKRANI</h2>
            </div>

            <form action="login.php" method="POST"> <!-- Form action burada değiştirildi -->  
                <div class="user-box">
                    <input type="text" name="username" required="">
                    <label>Kullanıcı Adı</label>

                </div>
                <div class="user-box">
                    <input type="password" name="password" required="">
                    <label>Şifre</label>
                </div>
                <div class="girisyapbutonu">
                    <button type="submit">Giriş Yap</button>
                    <a href="#">Şifremi Unuttum</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="saydam-resim">

    <div class="background-container">
        <img src="adalet.jpg" alt="Adalet Resmi" class="background-image">
        <div class="overlay-text">
            <h1>"ADALET MÜLKÜN TEMELİDİR"</h1>
            <p>Fiat iustitia, et pereat mundus</p>
        </div>
    </div>

</div>

<div class="content-section">
    <img src="logo.jpeg" alt="T&K HUKUK VE ARABULUCULUK" style="width: 400px; height: 200px;">
    <div class="text-content">
        <h1>SEMSS HUKUK VE ARABULUCULUK</h1>
        <h3>
        Hukuk bürosu takip sistemi, bir hukuk bürosunun iş süreçlerini dijital ortamda organize etmesine ve 
        yönetmesine olanak tanıyan yazılımlardır.<br> Bu sistemler, dava dosyalarının, müvekkil bilgileri ve 
        belgelerin etkili bir şekilde yönetilmesini sağlar. Hukuk bürosu takip sistemi, dosyaların ve belgelerin 
        dijital ortamda düzenlenmesi sayesinde avukatların ve diğer personelin ihtiyaç duydukları bilgilere hızlıca  
        ulaşmasını sağlayarak verimliliği artırır. Otomatik bildirimler ve hatırlatmalar, önemli tarihlerin ve  
        görevlerin kaçırılmasını engelleyerek insan hatasını minimize eder. Tüm işlemlerin ve değişikliklerin kayıt  
        altına alınması iş süreçlerinin izlenebilirliğini ve hesap verilebilirliğini artırır. Fiziksel dosyalama ve evrak 
        işleri gibi zaman alıcı süreçlerin dijitalleşmesi, hem zaman hem de maliyet açısından önemli tasarruf sağlar. 
        Ayrıca, dijital verilerin güvenli bir şekilde saklanması ve yetkisiz erişimlere karşı korunması, hassas
        bilgilerin gizliliğini garanti eder. Bu sistemler, modern hukuk bürolarının etkinliğini ve müşteri memnuniyetini  
        artırarak rekabet avantajı elde etmelerine yardımcı olur.


        </h3>
    </div>
</div>

<div class="footer">
    <div class="container row">
        <div class="footer-col">
            <h4>SEMSS Bilişim Sistemi</h4>
            <ul>
                <li><a href="#">Selin Yalçın tarafından hazırlanmıştır.</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Bize Ulaşın</h4>
            <ul>
                <li><a href="#">Yardım Masası İletişim Bilgileri
                    Telefon: 05350647050
                    Faks : 0(312) 293 22 22
                    Email: selin.yalcn00@gmail.com</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Önemli İşler</h4>
            <ul>
                <li><a href="#">E imza</a></li>
                <li><a href="#">Mevzuat</a></li>
                <li><a href="#">Hukuki Yardım</a></li>
                <li><a href="#">SEMSS dan Haberler</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Takip Edin</h4>
            <div class="social-links">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</div>

<script>
    // Giriş modalını aç
    function openLoginModal() {
        document.getElementById('loginModal').style.display = 'block';
    }

    // Giriş modalını kapat
    function closeLoginModal() {
        document.getElementById('loginModal').style.display = 'none';
    }
</script>

<script src="https://kit.fontawesome.com/3b161c540c.js" crossorigin="anonymous"></script>

</body>
</html>


