
// Biểu đồ Doanh thu
const revenueLabels = <?= json_encode($ngay, JSON_UNESCAPED_UNICODE) ?>;
const revenueData = <?= json_encode($tongtien, JSON_UNESCAPED_UNICODE) ?>;

new Chart("chartRevenue", {
    type: "line",
    data: {
        labels: revenueLabels,
        datasets: [{
            label: "Doanh thu",
            fill: true,
            backgroundColor: "rgba(0, 123, 255, 0.1)",
            borderColor: "rgba(0, 123, 255, 1)",
            pointBackgroundColor: "rgba(0, 123, 255, 1)",
            pointRadius: 5,
            pointHoverRadius: 8,
            borderWidth: 2,
            data: revenueData
        }]
    },
    options: {
        responsive: true,
        legend: { display: true, position: 'bottom' },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    callback: function(value) {
                        return value.toLocaleString() + " ₫";
                    }
                },
                gridLines: { color: "#eee" }
            }],
            xAxes: [{ gridLines: { color: "#f5f5f5" } }]
        },
        tooltips: {
            callbacks: {
                label: function(tooltipItem) {
                    return tooltipItem.yLabel.toLocaleString() + " ₫";
                }
            }
        }
    }
});

// Biểu đồ sản phẩm theo danh mục
const categoryLabels = <?= json_encode($category_name, JSON_UNESCAPED_UNICODE) ?>;
const categoryData = <?= json_encode($category_stock, JSON_UNESCAPED_UNICODE) ?>;
const categoryColors = [
    "#b91d47", "#00aba9", "#2b5797", "#e8c3b9", "#1e7145",
    "#ff6384", "#36a2eb", "#ffcd56", "#4bc0c0", "#9966ff"
];

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
        legend: { position: 'bottom' },
        title: {
            display: true,
            text: "Số lượng sản phẩm theo danh mục"
        }
    }
});
