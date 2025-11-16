<!DOCTYPE html>
<html lang="vi">


<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            background-color: #f1f3f5;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .admin-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 56px;
            background-color: #ffffff;
            color: #333;
            padding: 15px 20px;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .admin-sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            width: 250px;
            height: calc(100vh - 56px);
            background-color: #ffffff;
            color: #333;
            overflow-y: auto;
            border-right: 1px solid #dee2e6;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .admin-sidebar::-webkit-scrollbar {
            display: none;
        }

        .admin-sidebar-link {
            display: block;
            color: #333;
            padding: 12px 20px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 6px;
            margin: 4px 10px;
        }

        .admin-sidebar-link:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        .admin-main-content {
            position: absolute;
            top: 56px;
            left: 250px;
            right: 0;
            bottom: 0;
            padding: 20px;
            overflow-y: auto;
            background-color: #f8f9fa;
        }

        .collapse {
            transition: max-height 0.3s ease-out;
            overflow: hidden;
        }
    </style>

</head>

<body>
    <!-- Header -->
    <header class="admin-header">
        <a href="index.php?route=admin" class="text-decoration-none">
            <h4 class="mb-0 text-dark"><i class="fas fa-chart-line me-2"></i>Admin Dashboard</h4>
        </a>
        <div>
            <span>Xin chào, Admin</span>
            <button class="btn btn-sm btn-outline-secondary ms-3"> <i class="fas fa-sign-out-alt me-1"></i> <a href="index.php?route=admin&action=logout_admin">Đăng xuất</a> </button>
        </div>
    </header>

    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav class="admin-sidebar">
            <div class="dropdown">
                <a class="dropdown-toggle admin-sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#productMenu" aria-expanded="false">
                    <i class="fas fa-box me-2"></i> Sản phẩm
                </a>
                <div class="collapse ps-3" id="productMenu">
                    <a class="admin-sidebar-link py-1" href="index.php?route=admin&action=list_product"><i class="fas fa-list me-2"></i> Danh sách sản phẩm</a>
                    <a class="admin-sidebar-link py-1" href="index.php?route=admin&action=create_product"><i class="fas fa-plus me-2"></i> Thêm sản phẩm</a>
                    
                </div>
            </div>

            <div class="dropdown">
                <a class="dropdown-toggle admin-sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#userMenu" aria-expanded="false">
                    <i class="fas fa-user me-2"></i> Người dùng
                </a>
                <div class="collapse ps-3" id="userMenu">
                    <a class="admin-sidebar-link py-1" href="index.php?route=admin&action=list_user_page"><i class="fas fa-users me-2"></i> Danh sách người dùng</a>
                    <!-- <a class="admin-sidebar-link py-1" href="#"><i class="fas fa-user-check me-2"></i> Trạng thái</a> -->
                </div>
            </div>

            <div class="dropdown">
                <a class="dropdown-toggle admin-sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#orderMenu" aria-expanded="false">
                    <i class="fas fa-shopping-cart me-2"></i> Đơn hàng
                </a>
                <div class="collapse ps-3" id="orderMenu">
                    <a class="admin-sidebar-link py-1" href="index.php?route=admin&action=list_order_page"><i class="fas fa-list-alt me-2"></i> Danh sách đơn hàng</a>
                    <!-- <a class="admin-sidebar-link py-1" href="#"><i class="fas fa-sync-alt me-2"></i> Cập nhật</a> -->
                </div>
            </div>

            <div class="dropdown">
                <a class="dropdown-toggle admin-sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#couponsMenu" aria-expanded="false">
                    <i class="fa-solid fa-ticket-simple"></i> Quản lý coupons
                </a>
                <div class="collapse ps-3" id="couponsMenu">
                    <a class="admin-sidebar-link py-1" href="index.php?route=admin&action=list_coupons_page"><i class="fas fa-list-alt me-2"></i> Danh sách coupons</a>
                    <a class="admin-sidebar-link py-1" href="index.php?route=admin&action=create_coupons_page"><i class="fas fa-sync-alt me-2"></i>Tạo mới</a>
                </div>
            </div>

            <a class="admin-sidebar-link" href="index.php?route=admin&action=list_categories">
                <i class="fas fa-folder me-2"></i> Quản lý danh mục
            </a>


            <!-- <div class="dropdown">
                <a class="dropdown-toggle admin-sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#feedbackMenu" aria-expanded="false">
                    <i class="fas fa-comments me-2"></i> Đánh giá & phản hồi
                </a>
                <div class="collapse ps-3" id="feedbackMenu">
                    <a class="admin-sidebar-link py-1" href="#"><i class="fas fa-star me-2"></i> Tất cả đánh giá</a>
                    <a class="admin-sidebar-link py-1" href="#"><i class="fas fa-flag me-2"></i> Báo cáo phản hồi</a>
                </div>
            </div> -->

            <div class="dropdown">
                <a class="dropdown-toggle admin-sidebar-link" href="index.php?route=admin&action=chart&filter=all" data-bs-toggle="collapse" data-bs-target="#statMenu" aria-expanded="false">
                    <i class="fas fa-chart-line me-2"></i> Thống kê
                </a>
                <div class="collapse ps-3" id="statMenu">
                    <a class="admin-sidebar-link py-1" href="index.php?route=admin&action=chart&filter=all"><i class="fas fa-dollar-sign me-2"></i> Doanh thu</a>
                    <a class="admin-sidebar-link py-1" href="#"><i class="fas fa-eye me-2"></i> Lượt truy cập</a>
                </div>
            </div>

            <a href="#" class="admin-sidebar-link"><i class="fas fa-cog me-2"></i> Cài đặt</a>
        </nav>

        <div class="admin-main-content">

            <!-- Main Content here -->