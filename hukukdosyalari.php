<?php include "dashboard.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HUKUK DOSYALARI</title>
    <style>
        /* CSS Stil Kodları */
        body {
            font-family: Arial, sans-serif;
            background-color: #C0C0C0; /* Arka plan rengi */
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto; /* Tabloyu ortala */
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd; /* Kenarlık rengi */
        }

        th {
            background-color: #666; /* Başlık arka plan rengi */
            color: white; /* Başlık metin rengi */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Çift sıra arka plan rengi */
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #a9a9a9;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: black;
        }

        .update-form {
            display: none; /* Form varsayılan olarak gizli */
        }

        .form-row {
            background-color: #f2f2f2;
        }

        #add-form-container {
            display: none; /* Ekleme formunu varsayılan olarak gizli yap */
            width: 80%;
            margin: 20px auto;
            background-color: #f2f2f2;
            padding: 20px;
            border: 1px solid #ddd;
        }
    </style>
    <script>
        function showUpdateForm(id) {
            var form = document.getElementById('update-form-' + id);
            var isVisible = form.style.display === 'table-row';
            var forms = document.querySelectorAll('.update-form');
            forms.forEach(function(f) {
                f.style.display = 'none';
            });
            if (!isVisible) {
                form.style.display = 'table-row';
            }
        }

        function updateRecord(id) {
            var form = document.getElementById('form-' + id);
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "edit.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert("Bilgiler güncellendi.");
                    location.reload();
                } else {
                    alert("Güncelleme sırasında hata oluştu.");
                }
            };
            xhr.send(formData);
        }

        function showAddForm() {
            var formContainer = document.getElementById('add-form-container');
            formContainer.style.display = (formContainer.style.display === 'block') ? 'none' : 'block';
        }

        function addRecord() {
            var form = document.getElementById('add-form');
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert("Yeni dosya eklendi.");
                    location.reload();
                } else {
                    alert("Ekleme sırasında hata oluştu.");
                }
            };
            xhr.send(formData);
        }
    </script>
</head>
<body>
    <h1>HUKUK DOSYALARI</h1>
     


    <table>
        <tr>
            <th>ID</th>
            <th>Davacı</th>
            <th>Davalı</th>
            <th>Dava Tarihi</th>
            <th>Dava Konusu</th>
            <th>Mahkeme</th>
            <th>Esas No</th>
            <th>Dosya Durumu</th>
            <th>İşlemler</th>
        </tr>

        
        <?php
        // Veritabanı bilgileri
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "final_projesi";

        // Veritabanına bağlanma
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Bağlantıyı kontrol etme
        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        // Hukuk dosyalarını sorgulama
        $sql = "SELECT * FROM hukukdosyaları";
        $result = $conn->query($sql);

        // Her satırı işleme alma
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row['id'];
                echo "<tr>";
                echo "<td>" . $id . "</td>";
                echo "<td>" . $row['davaci'] . "</td>";
                echo "<td>" . $row['davali'] . "</td>";
                echo "<td>" . $row['dava_tarihi'] . "</td>";
                echo "<td>" . $row['dava_konusu'] . "</td>";
                echo "<td>" . $row['mahkeme'] . "</td>";
                echo "<td>" . $row['esas_no'] . "</td>";
                echo "<td>" . $row['dosya_durumu'] . "</td>";
                echo "<td><button onclick=\"showUpdateForm($id)\">Güncelle</button></td>";
                echo "</tr>";
                echo "<tr id='update-form-$id' class='update-form form-row'>";
                echo "<td colspan='9'>";
                echo "<form id='form-$id' onsubmit='event.preventDefault(); updateRecord($id);'>";
                echo "<input type='hidden' name='id' value='$id'>";
                echo "<table>";
                echo "<tr><td>Davacı</td><td><input type='text' name='davaci' value='" . htmlspecialchars($row['davaci'], ENT_QUOTES) . "'></td></tr>";
                echo "<tr><td>Davalı</td><td><input type='text' name='davali' value='" . htmlspecialchars($row['davali'], ENT_QUOTES) . "'></td></tr>";
                echo "<tr><td>Dava Tarihi</td><td><input type='text' name='dava_tarihi' value='" . htmlspecialchars($row['dava_tarihi'], ENT_QUOTES) . "'></td></tr>";
                echo "<tr><td>Dava Konusu</td><td><input type='text' name='dava_konusu' value='" . htmlspecialchars($row['dava_konusu'], ENT_QUOTES) . "'></td></tr>";
                echo "<tr><td>Mahkeme</td><td><input type='text' name='mahkeme' value='" . htmlspecialchars($row['mahkeme'], ENT_QUOTES) . "'></td></tr>";
                echo "<tr><td>Esas No</td><td><input type='text' name='esas_no' value='" . htmlspecialchars($row['esas_no'], ENT_QUOTES) . "'></td></tr>";
                echo "<tr><td>Dosya Durumu</td><td><input type='text' name='dosya_durumu' value='" . htmlspecialchars($row['dosya_durumu'], ENT_QUOTES) . "'></td></tr>";
                echo "<tr><td colspan='2'><input type='submit' value='Güncelle' class='btn btn-primary'></td></tr>";
                echo "</table>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>0 sonuç</td></tr>";
        }

        // Bağlantıyı kapatma
        $conn->close();
        ?>
    </table>

    <!-- Ekleme formu -->
    <div id="add-form-container">
        <form id="add-form" onsubmit="event.preventDefault(); addRecord();">
            <table>
                <tr><td>Davacı</td><td><input type="text" name="davaci"></td></tr>
                <tr><td>Davalı</td><td><input type="text" name="davali"></td></tr>
                <tr><td>Dava Tarihi</td><td><input type="text" name="dava_tarihi"></td></tr>
                <tr><td>Dava Konusu</td><td><input type="text" name="dava_konusu"></td></tr>
                <tr><td>Mahkeme</td><td><input type="text" name="mahkeme"></td></tr>
                <tr><td>Esas No</td><td><input type="text" name="esas_no"></td></tr>
                <tr><td>Dosya Durumu</td><td><input type="text" name="dosya_durumu"></td></tr>
                <tr><td colspan="2"><input type="submit" value="Ekle" class="btn btn-primary"></td></tr>
            </table>
        </form>
    </div>

    <!-- Ekle butonu -->
    <div class="button-container">
        <button onclick="showAddForm()">Ekle</button>
    </div>
</body>
</html>




