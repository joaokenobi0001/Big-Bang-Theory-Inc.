<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Soma dos Totais de Venda por País</title>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    form {
        margin-top: 20px;
    }
    input[type=text] {
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    button {
        padding: 6px 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>
<?php
$servername = "localhost";
$username = "usuario";
$password = "senha";
$dbname = "teste";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados");
}

// Consulta SQL para obter a soma dos totais de venda por país
$sql = "SELECT user_country, SUM(order_total) AS total_vendas FROM orders JOIN user ON orders.order_user_id = user.user_id GROUP BY user_country";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>País</th><th>Total de Vendas</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["user_country"] . "</td>";
        echo "<td>" . $row["total_vendas"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhuma venda encontrada";
}
$conn->close();
?>
<form action="" method="post">
  <label for="pais">Filtrar por país:</label>
  <input type="text" id="pais" name="pais">
  <button type="submit">Filtrar</button>
</form>
</body>
</html>
