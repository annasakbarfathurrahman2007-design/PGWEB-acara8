<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kecamatan = $_POST['kecamatan'];
    $luas = $_POST['luas'];
    $jumlah_penduduk = $_POST['jumlah_penduduk'];

    $conn = new mysqli("localhost", "root", "", "latihan8a");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "INSERT INTO kecamatan
            (Kecamatan, luas, jumlah_penduduk)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $kecamatan, $luas, $jumlah_penduduk);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>  

<h3>Form Input</h3>

<form method="POST" action="">
    Kecamatan:<br>
    <input type="text" name="kecamatan" required><br>

    Luas:<br>
    <input type="number" step="any" name="luas" required><br>

    Jumlah Penduduk:<br>
    <input type="number" name="jumlah_penduduk" required><br><br>

    <input type="submit" value="Submit">
</form>
