<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Relatório de Pedidos</title>
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
    button {
        margin-top: 10px;
        padding: 10px 20px;
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

$sql = "SELECT orders.order_id, orders.order_user_id, orders.order_total, orders.order_date, user.user_name, user.user_address, user.user_city, user.user_country FROM orders JOIN user ON orders.order_user_id = user.user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID do Pedido</th><th>ID do Usuário</th><th>Total do Pedido</th><th>Data do Pedido</th><th>Nome do Usuário</th><th>Endereço</th><th>Cidade</th><th>País</th></tr>";
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $bg_color = $i % 2 == 0 ? '#ffffff' : '#f2f2f2';
        echo "<tr style='background-color: $bg_color;'>";
        echo "<td>" . $row["order_id"] . "</td>";
        echo "<td>" . $row["order_user_id"] . "</td>";
        echo "<td>" . $row["order_total"] . "</td>";
        echo "<td>" . $row["order_date"] . "</td>";
        echo "<td>" . $row["user_name"] . "</td>";
        echo "<td>" . $row["user_address"] . "</td>";
        echo "<td>" . $row["user_city"] . "</td>";
        echo "<td>" . $row["user_country"] . "</td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
} else {
    echo "Nenhum pedido encontrado";
}
$conn->close();
?>
<button onclick="window.print()">Imprimir</button>
</body>
</html>
