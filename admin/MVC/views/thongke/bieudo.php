<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biểu Đồ Doanh Thu và Tỷ Lệ Dịch Vụ</title>
    <!-- Thêm link đến Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-around{
            display: flex;
            flex-direction: row;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            width: 1500px;
        }
        .chart-dt {
         width: 80%;
         text-align: center;
        }
        .chart-dv{
            width: 30%;
        }
        
        </style>
</head>
<body>
  <div class="chart-around">
    <div class="chart-dt" >
        <h2>Biểu Đồ Doanh Thu</h2>
        <canvas id="revenueChart"></canvas>
    </div>
    <div class="chart-dv" >
        <h2>Biểu Đồ Tỷ Lệ Sử Dụng Dịch Vụ</h2>
        <canvas id="serviceChart"></canvas>
    </div>
  </div>
    <script>
        // Tải dữ liệu từ getRevenueData.php
        fetch('/admin/MVC/model/thongke.php')
            .then(response => response.json())
            .then(data => {
                // Dữ liệu cho biểu đồ doanh thu
                const revenueLabels = data.revenueData.map(item => {
                    const date = new Date(item.date);
                    return `${date.getDate().toString().padStart(2, '0')}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getFullYear()}`;
                });

                const revenues = data.revenueData.map(item => item.revenue);

                // Biểu đồ doanh thu
                const revenueCtx = document.getElementById('revenueChart').getContext('2d');
                new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: revenueLabels,
                        datasets: [{
                            label: 'Doanh Thu (VND)',
                            data: revenues,
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Ngày (DD-MM-YYYY)'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Doanh Thu (VND)'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }
                        }
                    }
                });

                // Dữ liệu cho biểu đồ tròn
                const serviceLabels = data.serviceData.map(item => item.service);
                const usageCounts = data.serviceData.map(item => item.usage_count);

                // Biểu đồ tỷ lệ dịch vụ
                const serviceCtx = document.getElementById('serviceChart').getContext('2d');
                new Chart(serviceCtx, {
                    type: 'pie',
                    data: {
                        labels: serviceLabels,
                        datasets: [{
                            label: 'Tỷ Lệ Sử Dụng Dịch Vụ',
                            data: usageCounts,
                            backgroundColor: [
                                'rgba(255, 0, 0, 0.2)',
                                'rgba(54, 162, 235)',
                                'rgba(255, 206, 86)',
                                'rgba(75, 192, 192)',
                                'rgba(153, 102, 255)',
                                'rgba(255, 0, 0)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = ((context.raw / total) * 100).toFixed(2);
                                        return `${context.label}: ${percentage}% (${context.raw} lần)`;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Lỗi khi tải dữ liệu:', error);
            });
    </script>
</body>
</html>
