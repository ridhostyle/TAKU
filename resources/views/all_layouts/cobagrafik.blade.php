<?php
$servername = 'localhost';
$username = 'root'; // ganti dengan username database Anda
$password = ''; // ganti dengan password database Anda
$dbname = 'cobagrafik'; // ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

// Query untuk mengambil data penjualan per bulan
$sql = "SELECT DATE_FORMAT(date, '%Y-%m') as month, SUM(amount) as total_amount FROM sales GROUP BY month ORDER BY month";
$result = $conn->query($sql);

$months = [];
$totals = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $months[] = $row['month'];
        $totals[] = $row['total_amount'];
    }
} else {
    echo '0 hasil';
}
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Gaya tambahan untuk border grafik */
        #myChart {
            border: 2px solid #5eff63;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div style="width: 100%;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var labels = <?php echo json_encode($months); ?>;
            var totals = <?php echo json_encode($totals); ?>;

            var data = {
                labels: labels,
                datasets: [{
                        label: 'Total Penjualan Per Bulan',
                        backgroundColor: labels.map((_, i) =>
                            `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.6)`
                        ),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 3,
                        data: totals
                    },
                    {
                        label: 'Garis Tren',
                        type: 'line',
                        data: totals,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        fill: false
                    }
                ]
            };

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    animation: {
                        duration: 1500, // Durasi animasi dalam milidetik
                        easing: 'easeOutBounce' // Efek transisi animasi
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.raw;
                                    // Tambahkan informasi tambahan, seperti persentase perubahan
                                    if (context.dataIndex > 0) {
                                        var prevValue = context.dataset.data[context.dataIndex - 1];
                                        var currValue = context.raw;
                                        var percentageChange = ((currValue - prevValue) / prevValue *
                                            100).toFixed(2);
                                        label += ` (${percentageChange}% dari bulan sebelumnya)`;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
