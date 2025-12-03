<?php
class AdminController
{

    public function index()
    {

        $stmt = new AdminProduct();
        $countProducts = $stmt->count_total_products();
        $countOrders = $stmt->count_total_orders();
        $countCustomers = $stmt->count_total_customers();
        $get_categories = $stmt->count_product_by_category();

        // $result = $stmt->filter_total_price_by_day();
        $filter = $_GET['filter'] ?? 'day';
        switch ($filter) {
            case 'year':
                $result = $stmt->filter_total_price_by_year();
                break;
            case 'month':
                $result = $stmt->filter_total_price_by_month();
                break;
            default:
                $result = $stmt->filter_total_price_by_day();
                break;
        }
   
        $revenue = $stmt->get_revenue();

        // Load the home view
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/products/home_admin.php';
        include './Views/admin/layouts/footer.php';
    }


    // -------------------------------------List User-----------------------------------
    public function userPage()
    {
        $admin = new User();

        // echo $_SESSION['role_id'];
        // die();

        // print_r ($arrayUser);
        // die();
        if (isset($_POST['handleUser']) || isset($_GET['act']) === 'handleUser1') {
            // Lấy dữ liệu từ form

            $username = trim($_POST['username'] ?? '');
            $limit = 10;
            $page = $_GET['page'] ?? 1;
            $email = trim($_POST['email'] ?? '');
            $role = trim($_POST['role'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $status = trim($_POST['status']) ?? '';
            $created_start = $_POST['from_date'] ?? '';
            $created_end = $_POST['to_date'] ?? '';
            $total = $admin->countFilteredUsers($username, $email, $role, $phone, $address, $status, $created_start, $created_end);
            $num_page = ceil($total / $limit);
            $list = [
                $limit,
                $total,
                $num_page,
                $username,
                $email,
                $role,
                $phone,
                $address,
                $status,
                $created_start,
                $created_end
            ];

            $_SESSION['user'] = $list;
            // Gọi đến model User để tìm kiếm
            $arrayUser = $admin->searchUsers($username, $email, $role, $phone, $address, $status, $created_start, $created_end, $page, $limit);
            // die();
        } else if (isset($_GET['act'])) {
            //Phải lưu data vào session thì sau khi nhấn chuyển trang mới có dữ liệu để ren lại users
            $page = $_GET['page'] ?? 1;


            [
                $limit,
                $total,
                $num_page,
                $username,
                $email,
                $role,
                $phone,
                $address,
                $status,
                $created_start,
                $created_end
            ] = $_SESSION['user'];
            $arrayUser = $admin->searchUsers($username, $email, $role, $phone, $address, $status, $created_start, $created_end, $page, $limit);
        }
        // else {
        //     $arrayUser = $admin->getListUser();
        //     $total = $admin->countUser();
        // }

        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/users/list.php';
        include './Views/admin/layouts/footer.php';
    }

    // -------------------------------------Edit User-----------------------------------

    public function editUserPage($idUser)
    {
        $model = new User();
        $renderUserId = $model->getUSerById($idUser);
        // print_r($renderUserId);
        $renderRole = $model->getRole();
        $page = $_GET['page'] ?? 1;
        // Nếu như bấm hủy sẽ quay lại danh sách user đang hiện thị trước khi nhấn sửa
        if (isset($_GET['act'])) {
            //Phải lưu data vào session thì sau khi nhấn chuyển trang mới có dữ liệu để ren lại users


            [
                $limit,
                $total,
                $num_page,
                $username,
                $email,
                $role,
                $phone,
                $address,
                $status,
                $created_start,
                $created_end
            ] = $_SESSION['user'];
            // $total = $model->countFilteredUsers($username, $email, $role, $phone, $address, $status, $created_start, $created_end);
            // $num_page = ceil($total / $limit);

            $arrayUser = $model->searchUsers($username, $email, $role, $phone, $address, $status, $created_start, $created_end, $page, $limit);
        }



        if (isset($_POST['save'])) {
            $status = trim($_POST['status'] ?? '');
            $role = trim($_POST['role'] ?? '');
            $updated_at = date('Y-m-d');
            $model->editUser($status, $role, $updated_at, $idUser);
            header("Location: index.php?route=admin&action=list_user_page&actionUser=editUser&idUser=$idUser");
        }
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/users/userId.php';
        include './Views/admin/layouts/footer.php';
    }



    // -------------------------------------List Order-----------------------------------
    public function orderPage($idOrder)
    {
        $model = new Order();

        if (isset($_POST['handleOrders'])) {
            $limit = 10;
            $page = $_GET['page'] ?? 1;


            $name = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $shipping_address = trim($_POST['shipping_address'] ?? '');
            $payment_method = trim($_POST['payment_method'] ?? '');
            $status = trim($_POST['status'] ?? '');
            $created_at = trim($_POST['from_date'] ?? '');
            $updated_at = trim($_POST['to_date'] ?? '');
            $min_price = trim($_POST['min_price'] ?? '');
            $max_price = trim($_POST['max_price'] ?? '');

            $total = $model->countFilterOrder($name, $email, $phone, $shipping_address, $payment_method, $status, $created_at, $updated_at, $min_price, $max_price);
            $num_page = ceil($total / $limit);
            $list = [
                $limit,
                $total,
                $num_page,
                $name,
                $email,
                $phone,
                $shipping_address,
                $payment_method,
                $status,
                $created_at,
                $updated_at,
                $min_price,
                $max_price
            ];
            $_SESSION['order'] = $list;
            $arrayOrder = $model->searchOrder($name, $email, $phone, $shipping_address, $payment_method, $status, $created_at, $updated_at, $min_price, $max_price, $page, $limit);
        } else if (isset($_GET['act'])) {
            $page = $_GET['page'];
            [
                $limit,
                $total,
                $num_page,
                $name,
                $email,
                $phone,
                $shipping_address,
                $payment_method,
                $status,
                $created_at,
                $updated_at,
                $min_price,
                $max_price
            ] = $_SESSION['order'];
            $arrayOrder = $model->searchOrder($name, $email, $phone, $shipping_address, $payment_method, $status, $created_at, $updated_at, $min_price, $max_price, $page, $limit);
        } else {

            $arrayOrder = $model->listOrderPending();
            $total = $model->countOrderProcessing();
        }

        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/orders/listOrders.php';
        include './Views/admin/layouts/footer.php';
    }


    public function orderDetailPopUp($idOrder)
    {
        $model = new Order();
        $arrayOrderDetail = $model->orderDetail($idOrder);
        $arrayOrderDetail_length = count($arrayOrderDetail);
        echo "<pre>";
        $i = 0;
        for ($i; $i < $arrayOrderDetail_length; $i++) {
            $sizeValue = $model->getSize($arrayOrderDetail[$i]['product_variant_id']);
            $sizeArray[] = $sizeValue;
        }
        $j = 0;
        for ($j; $j < $arrayOrderDetail_length; $j++) {
            $colorValue = $model->getcolor(pdv_id: $arrayOrderDetail[$j]['product_variant_id']);
            $colorArray[] = $colorValue;
            // print_r($colorValue);
        }


        // die();

        include './Views/admin/orders/popUpOrder.php';
    }

    public function paymentDetailPopUp($idOrder)
    {
        $model = new Order();
        $arrayPaymentDetail = $model->paymentDetail($idOrder);
        // print_r($arrayPaymentDetail);
        // die();
        include './Views/admin/orders/popUpPayment.php';
    }

    public function updateStatusOrder($idOrder, $newStatus)
    {
        $model = new Order();
        $statusOrder = $model->handleUpdateOrderStatus($newStatus, $idOrder);
        $statusPayment = $model->handleUpdatePaymentStatus($newStatus, $idOrder);
        
        // Tạo thông báo cho khách hàng khi cập nhật trạng thái đơn hàng
        $user_id = $model->get_user_id_by_order($idOrder);
        if ($user_id) {
            $notification = new Notification();
            $status_text = [
                'pending' => 'đang chờ xử lý',
                'processing' => 'đang được xử lý',
                'shipped' => 'đang vận chuyển',
                'delivered' => 'đã giao thành công',
                'cancelled' => 'đã bị hủy'
            ];
            $status_message = $status_text[$newStatus] ?? $newStatus;
            $message = "Đơn hàng #{$idOrder} của bạn đã được cập nhật trạng thái: {$status_message}.";
            
            if ($newStatus == 'delivered') {
                $message .= " Cảm ơn bạn đã mua hàng!";
            } elseif ($newStatus == 'shipped') {
                $message .= " Đơn hàng đang trên đường giao đến bạn.";
            } elseif ($newStatus == 'cancelled') {
                $message .= " Nếu có thắc mắc, vui lòng liên hệ chúng tôi.";
            }
            
            $notification->create_notification($user_id, $message, 'order');
        }
        
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/orders/listOrders.php';
        include './Views/admin/layouts/footer.php';
    }


    public function cancel_order($idOrder, $newStatus)
    {
        $model = new Order();
        $statusOrder = $model->handleUpdateOrderStatus($newStatus, $idOrder);
        $statusPayment = $model->handleUpdatePaymentStatus($newStatus, $idOrder);
        
        // Tạo thông báo khi hủy đơn hàng
        $user_id = $model->get_user_id_by_order($idOrder);
        if ($user_id) {
            $notification = new Notification();
            $message = "Đơn hàng #{$idOrder} của bạn đã bị hủy. Nếu có thắc mắc, vui lòng liên hệ với chúng tôi để được hỗ trợ.";
            $notification->create_notification($user_id, $message, 'order');
        }
    }







    public function couponPage()
    {
        $model = new Coupons();
        $array_code_coupons = $model->get_code_coupons();
        if (isset($_POST['handleCoupons'])) {
            $limit = 10;
            $page = $_GET['page'] ?? 1;

            $code = trim($_POST['code'] ?? '');
            $used_count = trim($_POST['used_count'] ?? '');
            $min_price = htmlspecialchars(trim($_POST['min_price'] ?? ''));
            $max_price = htmlspecialchars(trim($_POST['max_price'] ?? ''));
            $status = htmlspecialchars(trim($_POST['status'] ?? ''));
            $order_value = htmlspecialchars(trim($_POST['order_value'] ?? ''));
            $start_date = trim($_POST['start_date'] ?? '');
            $end_date = trim($_POST['end_date'] ?? '');


            $total = $model->countFilterCoupons($code, $min_price, $max_price, $status, $start_date, $end_date, $used_count, $order_value);
            $num_page = ceil($total / $limit);
            $list = [
                $limit,
                $total,
                $num_page,
                $code,
                $used_count,
                $min_price,
                $max_price,
                $status,
                $status,
                $order_value,
                $start_date,
                $end_date
            ];
            $_SESSION['coupons'] = $list;
            $listCoupons = $model->searchCoupons($code, $min_price, $max_price, $status, $start_date, $end_date, $used_count, $order_value, $page, $limit);
        } else if (isset($_GET['act'])) {
            $page = $_GET['page'] ?? 1;
            [
                $limit,
                $total,
                $num_page,
                $code,
                $used_count,
                $min_price,
                $max_price,
                $status,
                $status,
                $order_value,
                $start_date,
                $end_date
            ] = $_SESSION['coupons'];
            $listCoupons = $model->searchCoupons($code, $min_price, $max_price, $status, $start_date, $end_date, $used_count, $order_value, $page, $limit);
        } else if (isset($_GET['create'])) {
            $listCoupons = $model->getListNewCoupon();
            $total = $model->countFilterNewCouponsByStatus();
        } 

        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/coupons/listCoupons.php';
        include './Views/admin/layouts/footer.php';
    }

    public function updateStatusCoupon($newStatus, $idCoupon)
    {
        $model = new Coupons();
        $newStatus = $model->handleUpdateStatusCoupon($newStatus, $idCoupon);
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/coupons/listCoupons.php';
        include './Views/admin/layouts/footer.php';
    }

    //------------------------------Edit coupons------------------------------
    public function handle_edit_coupons($idCoupon)
    {
        $model = new Coupons();
        $array_code_coupons = $model->get_code_coupons();
        if (isset($_POST['confirm_update_coupons'])) {
            $code = htmlspecialchars($_POST['code']);
            $discount_value = str_replace(',', '', $_POST['discount_value']); // loại bỏ dấu phẩy
            $usage_limit = htmlspecialchars($_POST['usage_limit']);
            // $used_count = htmlspecialchars($_POST['used_count']);
            $start_date = htmlspecialchars($_POST['start_date']);
            $end_date = htmlspecialchars($_POST['end_date']);

            $model->update_coupon($code, $discount_value, $usage_limit, $start_date, $end_date, $idCoupon);
            header("Location: index.php?route=admin&action=list_coupons_page&act=update");
            exit;
        } else {
            $detailCoupons = $model->get_coupons_by_id($idCoupon);
        }
        include './Views/admin/coupons/edit_coupons.php';
    }

    public function logout_admin()
    {
        if ($_GET['action'] == "logout_admin" && $_SESSION['role_admin'] === 2) {
            unset($_SESSION['role_admin']);
            echo "<script>alert('Đăng xuất thành công!');</script>";
        }
        header('Location: index.php?route=user&action=login');
    }

    public function create_coupons_page()
    {
        $model = new Coupons();
        $array_code_coupons = $model->get_code_coupons();
        
        if (isset($_POST['confirm_create_coupons'])) {
            if (isset($_POST['confirm_create_coupons'])) {
            $code = htmlspecialchars($_POST['code']);
            $discount_value =  str_replace(',', '', $_POST['discount_value']); // loại bỏ dấu phẩy
            $min_order_value =  str_replace(',', '', $_POST['min_order_value']); // loại bỏ dấu phẩy
            $usage_limit = htmlspecialchars($_POST['usage_limit']);
            $start_date = htmlspecialchars($_POST['start_date']);
            $end_date = htmlspecialchars($_POST['end_date']);

            // Validate
            if (empty($code) || $discount_value <= 0 || $usage_limit <= 0) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin hợp lệ'); window.history.back();</script>";
                exit;
            }

            $model->create_coupon($code, $discount_value, $min_order_value, $usage_limit, $start_date, $end_date);
            
            
            header("Location: index.php?route=admin&action=list_coupons_page&create=create");
            exit;
            }
        }
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/coupons/create_coupons.php';
        include './Views/admin/layouts/footer.php';
    }
}
