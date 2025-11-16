<style>
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

    .btn-filter.active,
    .btn-filter:hover {
        background-color: #4e73df;
        color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }
</style>

<!-- Views/admin/home/dashboard.php -->
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm p-4">
                <h2 class="mb-3">👋 Chào mừng đến với Trang Quản trị</h2>

            </div>
        </div>
    </div>

    <!-- Thông tin cửa hàng -->
    <div class="row mb-4">
        <div class="col-md-7">
            <!-- <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    🏪 Thông tin cửa hàng
                </div>
                <div class="card-body">
                    <p><strong>Tên cửa hàng:</strong> Canifa</p>
                    <p><strong>Địa chỉ:</strong> Xuân Phương, Bắc Từ Liêm</p>
                    <p><strong>Email:</strong> contact@abcshop.vn</p>
                    <p><strong>Số điện thoại:</strong> 0909 999 999</p>
                </div>
            </div> -->
            <div class="card p-4 h-100">
                <h5 class="fw-bold text-center mb-4">Biểu đồ Doanh Thu</h5>
                <canvas id="myChart" class="mb-4"></canvas>

                <!-- Bộ lọc theo Ngày/Tháng/Năm -->
                <div class="d-flex justify-content-center">
                    <div class="btn-group" role="group" aria-label="Bộ lọc">
                        <a href="index.php?route=admin&action=home&filter=day"
                            class="btn btn-filter  rounded-pill px-4 me-2">Ngày</a>
                        <a href="index.php?route=admin&action=home&filter=month"
                            class="btn btn-filter rounded-pill px-4 me-2">Tháng</a>
                        <a href="index.php?route=admin&action=home&filter=year"
                            class="btn btn-filter rounded-pill px-4">Năm</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card p-4 h-100">
                <h5 class="fw-bold text-center mb-4">Sản phẩm theo danh mục</h5>
                <canvas id="chartCategory"></canvas>
            </div>
        </div>
    </div>

    <!-- Tóm tắt dữ liệu -->
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Sản phẩm</h5>
                <h2 class="text-primary"><?= $countProducts ?? 0 ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Đơn hàng</h5>
                <h2 class="text-danger"><?= $countOrders ?? 0 ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Khách hàng</h5>
                <h2 class="text-success"><?= $countCustomers ?? 0 ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Doanh thu</h5>
                <?php $total_revenue = 0;
                foreach ($revenue as $row): ?>
                    <?php $total_revenue += $row['total_price'] ?>
                <?php endforeach ?>
                <h2 class="text-warning"><?= number_format($total_revenue ?? 0, 0, ',', '.') ?>₫</h2>
            </div>
        </div>
    </div>
</div>

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
</script>

<?php
    $category_name = array_column($get_categories, 'category_name');
    $category_stock = array_column($get_categories, "total_products")
?>
<script>
    const barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
    ];


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
                        callback: function (value, index, values) {
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
                    label: function (tooltipItem, data) {
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
</script>