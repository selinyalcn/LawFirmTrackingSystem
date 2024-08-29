<?php include "dashboard.php"; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duruşma Sorgulama</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            color: #333;
            text-align: center;
        }
        h2 {
            color: #555;
        }
        form {
            display: inline-block;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }
        input[type="date"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Duruşma Sorgulama</h2>
    <form method="post" action="">
        <label for="start_date">Başlangıç Tarihi:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>
        <label for="end_date">Bitiş Tarihi:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>
        <button type="submit" name="submit">Duruşma Sorgula</button>
    </form>
    <br>
    <?php
    if (isset($_POST['submit'])) {
        // Veritabanı bağlantısını yapalım
        $servername = "localhost";
        $username = "root"; 
        $password = "";
        $dbname = "final_projesi"; 

        // Bağlantıyı oluştur
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Bağlantıyı kontrol et
        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        // Formdan gelen tarih aralığını al
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // SQL sorgusunu hazırla
        $sql = "SELECT * FROM hukukdosyaları WHERE dava_tarihi BETWEEN '$start_date' AND '$end_date'";

        // Sorguyu çalıştır ve sonucu al
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Tabloyu oluştur
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Davacı</th>
                        <th>Davalı</th>
                        <th>Dava Tarihi</th>
                        <th>Dava Konusu</th>
                        <th>Mahkeme</th>
                        <th>Esas No</th>
                        <th>Dosya Durumu</th>
                    </tr>";

            // Veritabanından gelen verileri tabloya yerleştir
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["davaci"] . "</td>
                        <td>" . $row["davali"] . "</td>
                        <td>" . $row["dava_tarihi"] . "</td>
                        <td>" . $row["dava_konusu"] . "</td>
                        <td>" . $row["mahkeme"] . "</td>
                        <td>" . $row["esas_no"] . "</td>
                        <td>" . $row["dosya_durumu"] . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "Belirtilen tarih aralığında hiçbir dava bulunamadı.";
        }

        // Bağlantıyı kapat
        $conn->close();
    }
    ?>
</body>
</html>

