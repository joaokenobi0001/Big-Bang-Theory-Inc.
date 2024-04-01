<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "usuario";
$password = "senha";
$dbname = "teste";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta SQL para obter os pedidos por dia
$sql = "SELECT DATE(order_date) AS order_date, SUM(order_total) AS total_pedidos FROM orders GROUP BY DATE(order_date)";
$result = $conn->query($sql);

// Array para armazenar os pedidos por dia
$pedidos_por_dia = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pedidos_por_dia[$row["order_date"]] = $row["total_pedidos"];
    }
}

// Calculando a média dos pedidos por dia
$media_pedidos = array_sum($pedidos_por_dia) / count($pedidos_por_dia);

// Função para obter a cor com base na média
function obter_cor($media) {
    if ($media < 3000) {
        return "red";
    } elseif ($media > 3000) {
        return "green";
    } else {
        return "gray";
    }
}

// HTML para exibir a tabela
echo "<table border='1'>";
echo "<tr><th>Data</th><th>Pedidos</th></tr>";
foreach ($pedidos_por_dia as $data => $pedidos) {
    echo "<tr style='background-color: " . obter_cor($pedidos) . ";'>";
    echo "<td>$data</td><td>$pedidos</td>";
    echo "</tr>";
}
echo "<tr style='background-color: " . obter_cor($media_pedidos) . ";'>";
echo "<td><b>Média</b></td><td><b>" . number_format($media_pedidos, 2) . "</b></td>";
echo "</tr>";
echo "</table>";

// Fecha conexão
$conn->close();
?>
