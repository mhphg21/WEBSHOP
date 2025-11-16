<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Phân Tích</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f9;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-filter {
            background-color: #e9ecef;
            color: #6c757d;
            border: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-filter.active, .btn-filter:hover {
            background-color: #4e73df;
            color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="p-4 p-md-5">

    <div class="container-fluid my-5">
        <h1 class="text-center fw-bold text-dark mb-5">Tổng quan Phân Tích Doanh thu & Sản phẩm</h1>
        <div class="row g-4">

            <!-- Thẻ Tổng quan (ví dụ) -->
            <div class="col-md-12 col-lg-4">
                <div class="card h-100 p-4">
                    <h5 class="fw-bold text-dark mb-3">Tổng quan</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Tổng Doanh thu</span>
                        <span class="fw-bold text-success"><?=number_format($get_total_revenue_and_orders['tongtien'])?> VND</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Số đơn hàng</span>
                        <span class="fw-bold text-info"><?=$get_total_revenue_and_orders['tongsoluong']?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-secondary">Sản phẩm bán chạy</span>
                        <span class="fw-bold text-warning"><?=$best_selling['name']?></span>
                    </div>
                </div>
            </div>

            <!-- Biểu đồ Doanh thu -->
            <div class="col-md-12 col-lg-8">
                <div class="card p-4 h-100">
                    <h5 class="fw-bold text-center mb-4">Biểu đồ Doanh Thu</h5>
                    <canvas id="myChart" class="mb-4"></canvas>

                    <!-- Bộ lọc theo Ngày/Tháng/Năm -->
                    <div class="d-flex justify-content-center">
                        <div class="btn-group" role="group" aria-label="Bộ lọc">
                            <a href="index.php?route=admin&action=chart&filter=day" class="btn btn-filter  rounded-pill px-4 me-2">Ngày</a>
                            <a href="index.php?route=admin&action=chart&filter=month" class="btn btn-filter rounded-pill px-4 me-2">Tháng</a>
                            <a href="index.php?route=admin&action=chart&filter=year" class="btn btn-filter rounded-pill px-4">Năm</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Biểu đồ Sản phẩm -->
            <div class="col-md-12 col-lg-6 mt-4">
                <div class="card p-4 h-100">
                    <h5 class="fw-bold text-center mb-4">Sản phẩm theo danh mục</h5>
                    <canvas id="chartCategory"></canvas>
                </div>
            </div>

        </div>
    </div>

    <!-- Đoạn mã PHP và JavaScript để xử lý dữ liệu -->
    <?php
    $ngay = array_column($result, 'ngay');
    $tongtien = array_column($result, 'tongtien');
    $category_name = array_column($get_categories, 'category_name');
    $category_stock = array_column($get_categories, "total_products");
    ?>
    <script>
        // Lấy dữ liệu từ PHP
        const xValues = <?= json_encode($ngay, JSON_UNESCAPED_UNICODE) ?>;
        const yValues = <?= json_encode($tongtien, JSON_UNESCAPED_UNICODE) ?>;

        // Biểu đồ Doanh thu (Chart.js)
        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    label: 'Doanh thu',
                    fill: true,
                    lineTension: 0.2,
                    backgroundColor: "rgba(78, 115, 223, 0.2)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 7500000,
                            callback: function(value, index, values) {
                                return value.toLocaleString('vi-VN') + ' VNĐ';
                            }
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, 0.05)",
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0.05)",
                        }
                    }]
                },
                title: {
                    display: false
                }
            }
        });

        // Lấy dữ liệu biểu đồ sản phẩm từ PHP
        const categoryLabels = <?= json_encode($category_name, JSON_UNESCAPED_UNICODE) ?>;
        const categoryData = <?= json_encode($category_stock, JSON_UNESCAPED_UNICODE) ?>;
        const categoryColors = [
            "#4e73df", "#1cc88a", "#36b9cc", "#f6c23e", "#e74a3b",
            "#858796", "#5a5c69", "#f8f9fc", "#0dcaf0", "#000"
        ];

        // Biểu đồ sản phẩm theo danh mục (Chart.js)
        new Chart("chartCategory", {
            type: "pie",
            data: {
                labels: categoryLabels,
                datasets: [{
                    backgroundColor: categoryColors,
                    data: categoryData
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                    labels: {
                        fontColor: '#495057'
                    }
                },
                title: {
                    display: false,
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce((acc, val) => acc + val);
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = ((currentValue / total) * 100).toFixed(2) + "%";
                            return data.labels[tooltipItem.index] + ": " + currentValue + " (" + percentage + ")";
                        }
                    }
                }
            }
        });

        // Thêm các sự kiện cho nút filter
        // const filterButtons = document.querySelectorAll('.btn-filter');
        // filterButtons.forEach(button => {
        //     button.addEventListener('click', () => {
        //         filterButtons.forEach(btn => {
        //             btn.classList.remove('active');
        //         });
        //         button.classList.add('active');
          
        //     });
        // });

    </script>
</body>

</html>
