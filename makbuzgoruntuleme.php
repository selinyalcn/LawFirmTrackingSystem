<?php include "dashboard.php"; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makbuz Görüntüleme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
        }
        table, th, td {
            border: 1px solid #d3d3d3;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
        }
        .search-input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            font-size: 14px;
            border: 1px solid #d3d3d3;
        }
        .update-form {
            display: none; /* Form varsayılan olarak gizli */
        }
        .form-row {
            background-color: #f2f2f2;
        }
        .total-cell {
            font-weight: bold;
            text-align: center;
        }
        .new-record-form {
            text-align: center;
            background-color: #f9f9f9;
        }
        .total-section {
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
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
        xhr.open("POST", "guncelle3.php", true);
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

    function deleteRecord(id) {
        if (confirm('Bu kaydı silmek istediğinizden emin misiniz?')) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "sil.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert("Kayıt silindi.");
                    location.reload();
                } else {
                    alert("Silme sırasında hata oluştu.");
                }
            };
            xhr.send("id=" + id);
        }
    }

    // Borç ve alacak toplamını hesapla ve göster
    function calculateTotal() {
        var borcToplam = 0;
        var alacakToplam = 0;
        var borcElements = document.querySelectorAll('.borc-input');
        var alacakElements = document.querySelectorAll('.alacak-input');

        borcElements.forEach(function(element) {
            borcToplam += parseFloat(element.value) || 0;
        });

        alacakElements.forEach(function(element) {
            alacakToplam += parseFloat(element.value) || 0;
        });

        document.getElementById('borc-toplam').textContent = borcToplam.toFixed(2);
        document.getElementById('alacak-toplam').textContent = alacakToplam.toFixed(2);
        document.getElementById('kazanc-toplam').textContent = (alacakToplam - borcToplam).toFixed(2);
    }

    // Sayfa yüklendiğinde toplamı hesapla
    window.onload = function() {
        calculateTotal();
    };

    // Arama fonksiyonu
    function searchColumn(columnIndex) {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementsByClassName("search-input")[columnIndex];
        filter = input.value.toLowerCase();
        table = document.getElementById("data-table");
        tr = table.getElementsByTagName("tr");

        for (i = 2; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[columnIndex];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    </script>
</head>
<body>
    <h1>Makbuz Görüntüleme</h1>
    <div class="new-record-form">
        <h2>KASA GELİR/GİDER GİRİŞ</h2>
        <form action="kaydet.php" method="post">
            <label for="kasa">Kasa:</label>
            <select name="kasa" id="kasa">
                <option value="Merkez Kasa">Merkez Kasa</option>
                <option value="Kişisel Kasa">Kişisel Kasa</option>
            </select><br><br>
            <label for="gelir_gider_turu">Gelir/Gider Türü:</label>
            <input type="text" name="gelir_gider_turu" id="gelir_gider_turu"><br><br>
            <label for="tutar">Tutar:</label>
            <input type="number" name="tutar" id="tutar"><br><br>
            <label for="borc_alacak">Borç/Alacak:</label>
            <select name="borc_alacak" id="borc_alacak">
                <option value="Borç">Borç</option>
                <option value="Alacak">Alacak</option>
            </select><br><br>
            <label for="tarih">Tarih:</label>
            <input type="date" name="tarih" id="tarih"><br><br>
            <label for="aciklama">Açıklama:</label>
            <input type="text" name="aciklama" id="aciklama"><br><br>
            <input type="submit" value="Kaydet">
        </form>
    </div>

    <table id="data-table">
        <tr>
            <th>Kasa</th>
            <th>Gelir/Gider Türü</th>
            <th>Borç</th>
            <th>Alacak</th>
            <th>Tarih</th>
            <th>Açıklama</th>
            <th>İşlemler</th>
        </tr>
        <tr>
            <td><input type="text" class="search-input" onkeyup="searchColumn(0)" placeholder="Kasa ara..."></td>
            <td><input type="text" class="search-input" onkeyup="searchColumn(1)" placeholder="Gelir/Gider ara..."></td>
            <td><input type="text" class="search-input" onkeyup="searchColumn(2)" placeholder="Borç ara..."></td>
            <td><input type="text" class="search-input" onkeyup="searchColumn(3)" placeholder="Alacak ara..."></td>
            <td><input type="text" class="search-input" onkeyup="searchColumn(4)" placeholder="Tarih ara..."></td>
            <td><input type="text" class="search-input" onkeyup="searchColumn(5)" placeholder="Açıklama ara..."></td>
            <td></td>
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

        // SQL sorgusunu hazırla
        $sql = "SELECT id, kasa, gelir_gider_türü, borc, alacak, tarih, aciklama FROM makbuzgörüntüleme";
        $result = $conn->query($sql);
        // Hata kontrolü
        if (!$result) {
            die("Sorgu hatası: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            // Verileri tabloya yazdır
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                echo "<tr>";
                echo "<td>" . $row["kasa"]. "</td><td>" . $row["gelir_gider_türü"]. "</td><td>" . $row["borc"]. "</td><td>" . $row["alacak"]. "</td><td>" . $row["tarih"]. "</td><td>" . $row["aciklama"]. "</td>";
                echo "<td><button onclick='showUpdateForm($id)'>Güncelle</button> <button onclick='deleteRecord($id)'>Sil</button></td>";
                echo "</tr>";
                echo "<tr id='update-form-$id' class='update-form form-row'>";
                echo "<td colspan='7'>";
                echo "<form id='form-$id' onsubmit='event.preventDefault(); updateRecord($id);'>";
                echo "<input type='hidden' name='id' value='$id'>";
                echo "<table>";
                echo "<tr><td>Kasa</td><td><input type='text' name='kasa' value='" . $row["kasa"] . "'></td></tr>";
                echo "<tr><td>Gelir/Gider Türü</td><td><input type='text' name='gelir_gider_türü' value='" . $row["gelir_gider_türü"] . "'></td></tr>";
                echo "<tr><td>Borç</td><td><input type='text' name='borc' value='" . $row["borc"] . "' class='borc-input' onchange='calculateTotal();'></td></tr>";
                echo "<tr><td>Alacak</td><td><input type='text' name='alacak' value='" . $row["alacak"] . "' class='alacak-input' onchange='calculateTotal();'></td></tr>";
                echo "<tr><td>Tarih</td><td><input type='text' name='tarih' value='" . $row["tarih"] . "'></td></tr>";
                echo "<tr><td>Açıklama</td><td><input type='text' name='aciklama' value='" . $row["aciklama"] . "'></td></tr>";
                echo "<tr><td colspan='2'><button type='submit'>Kaydet</button></td></tr>";
                echo "</table>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Kayıt bulunamadı</td></tr>";
        }

        // Veritabanı bağlantısını kapat
        $conn->close();
        ?>
        <tr>
            <td colspan="2" class="total-cell">Toplam:</td>
            <td class="total-cell" id="borc-toplam"></td>
            <td class="total-cell" id="alacak-toplam"></td>
            <td colspan="3"></td>
        </tr>
    </table>

    <div class="total-section">
        TOPLAM KAZANÇ: <span id="kazanc-toplam">0.00</span> TL
    </div>
</body>
</html>
