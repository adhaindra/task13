<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Filter</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Data Filter Berdasarkan Title</h2>

<form method="GET" action="">
    <label for="search">Cari berdasarkan title:</label>
    <input type="text" id="search" name="search" placeholder="Masukkan kata kunci...">
    <button type="submit">Cari</button>
</form>

<?php
$servername = "localhost"; // atau 127.0.0.1
$username = "root";
$password = "";
$dbname = "tugas13"; // Nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah ada kata kunci pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM murid";
if (!empty($search)) {
    $sql .= " WHERE titel LIKE '%" . $conn->real_escape_string($search) . "%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Title</th><th>URL</th><th>Description</th></tr>";

    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["titel"] . "</td>";
        echo "<td><a href='" . $row["url"] . "'>" . $row["url"] . "</a></td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 hasil ditemukan";
}

$conn->close();
?>

</body>
</html>
