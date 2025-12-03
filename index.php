<?php
session_start();
// session_destroy();


// Include necessary client controllers
include_once './Controller/clients/HomeController.php';
include_once './Controller/clients/UserController.php';
include_once './Controller/clients/BuyingController.php';
include_once './Model/Pdo.php';
include_once './Model/clients/Product.php';
include_once './Model/clients/Cart.php';
include_once './Model/clients/UserClients.php';
include_once './Model/clients/Order.php';

// Include_include_once necessary admin controllers and models
include_once './Controller/admin/AdminController.php';
include_once './Controller/admin/ProductController.php';
include_once './Model/admin/user.php';
include_once './Model/admin/product.php';
include_once './Model/admin/order.php';
include_once './Model/admin/coupons.php';



// Xử lý routing
$route = $_GET['route'] ?? 'clients';
switch ($route) {
    case 'clients':
        // Xử lý route cho clients
        $action = $_GET['action'] ?? 'home';
        $user_id = $_SESSION['user']['id'] ?? '';
        switch ($action) {
            case 'home':
                $client = new HomeController();
                $client->index($user_id);
                break;
            case 'more_product':
                $client = new HomeController();
                $client->more($user_id);
                break;
            case 'search':
                $client = new HomeController();
                $client->search();
                break;
            case 'more_search':
                $client = new HomeController();
                $client->more_search();
                break;
            case 'pro_cate':
                $client = new HomeController();
                $client->pro_cate();
                break;
            case 'more_pro_cate':
                $client = new HomeController();
                $client->more_pro_cate();
                break;
            case 'list_cart':
                if (isset($_GET['action_cart'])) {
                    $action_cart = $_GET['action_cart'];
                    switch ($action_cart) {
                        case 'delete_cart':
                            $client = new BuyingController();
                            $client->deleteCart();
                            break;
                        case 'increase':
                            $client = new BuyingController();
                            $client->increase_cart();
                            break;
                        case 'reduce':
                            $client = new BuyingController();
                            $client->reduce_cart();
                            break;
                        case 'check_out':
                            $cart_id = $_GET['cart_id'] ?? '';
                            if (isset($_GET['coupon_id'])) {
                                $get_coupon_id = $_GET['coupon_id'] ?? '';
                            }
                            if (isset($_GET['act_checkout'])) {
                                $act_checkout = $_GET['act_checkout'];
                                switch ($act_checkout) {
                                    case 'qrcode':
                                        $client = new BuyingController();
                                        $client->show_qrcode();
                                        break;
                                    case 'popup_coupons':
                                        $client = new BuyingController();
                                        $client->coupons();
                                        break;
                                }
                            } else {
                                $client = new BuyingController();
                                $client->check_out_page($user_id);
                                break;
                            }
                            break;
                        case 'thank_you':
                            $client = new BuyingController();
                            $client->thank_you($user_id);
                            break;
                    }
                } else {
                    $client = new BuyingController();
                    $client->cart($user_id);
                    break;
                }
                break;

            case 'profile':
                if (isset($_GET['action_acc'])) {
                    $action_acc = $_GET['action_acc'];
                    switch ($action_acc) {
                        case 'oder':
                            $order_id = $_GET['order_id'] ?? '';
                            if (isset($_GET['action_oder'])) {
                                $action_oder = $_GET['action_oder'];
                                switch ($action_oder) {
                                    case 'oder_detail':
                                        $client = new HomeController();
                                        $client->oder_detail($order_id);
                                        break;
                                    case 'cancelled':
                                        $client = new HomeController();
                                        $client->cancelled();
                                        break;
                                    case 'order_confirm':
                                        $client = new HomeController();
                                        $client->order_confirm();
                                        break;
                                }
                            } else {
                                $client = new HomeController();
                                $client->view_order($user_id);
                                break;
                            }
                            break;
                        case 'viewProfile':
                            $client = new UserController();
                            $client->viewProfile($user_id);
                            break;

                        case 'updateProfile':
                            $client = new UserController();
                            $client->updateProfile();
                            break;
                    }
                }
                break;
            case 'detail':
                $client = new HomeController();
                $client->detail($user_id);
                break;
            case 'get_cart_count':
                $client = new HomeController();
                $client->get_cart_count();
                break;
        }
        break;
    case 'admin':
        // Xử lý route cho admin
        $action = $_GET['action'] ?? 'home';
        if (isset($_SESSION['role_admin']) && $_SESSION['role_admin'] === 2) {
            switch ($action) {
                case 'home':
                    $admin = new AdminController();
                    $admin->index();
                    break;
   
                //1. Trang list Users
                case 'list_user_page':
                    if (isset($_GET['actionUser']) && isset($_GET['idUser'])) {
                        $actionUser = $_GET['actionUser'];
                        $idUser = $_GET['idUser'];
                        switch ($actionUser) {
                            case 'editUser':
                                $admin = new AdminController;
                                $admin->editUserPage($idUser);
                                break;
                        }
                    } else {
                        $admin = new AdminController();
                        $admin->userPage();
                        break;
                    }
                    break;

                //2.  Trang list Order
                case 'list_order_page':
                    $idOrder = $_GET['idOrder'] ?? '';
                    $newStatus = $_GET['newStatus'] ?? '';
                    if (isset($_GET['actionOrder']) && isset($_GET['idOrder'])) {
                        $actionOrder = $_GET['actionOrder'];

                        // $idUser = $_GET['user_id'] ?? 4 ;
                        switch ($actionOrder) {
                            case 'orderDetail':
                                $admin = new AdminController();
                                $admin->orderDetailPopUp($idOrder);
                                break;
                            case 'paymentDetail':
                                $admin = new AdminController();
                                $admin->paymentDetailPopUp($idOrder);
                                break;
                            case 'upadetStatus':
                                $admin = new AdminController();
                                $admin->updateStatusOrder($idOrder, $newStatus);
                                break;
                            case 'cancelOrder':
                                $admin = new AdminController();
                                $admin->cancel_order($idOrder, $newStatus);
                                break;
                        }
                    } else {
                        $admin = new AdminController();
                        $admin->orderPage($idOrder);
                    }
                    break;
                //3. Trang cuopons
                case 'list_coupons_page':
                    $idCoupon = $_GET['idCoupon'] ?? '';
                    $newStatus = $_GET['newStatus'] ?? '';
                    if (isset($_GET['actionCoupons'])) {
                        $actionCoupons = $_GET['actionCoupons'];
                        switch ($actionCoupons) {
                            case 'updateStatus':
                                $admin = new AdminController();
                                $admin->updateStatusCoupon($newStatus, $idCoupon);
                                break;
                            case 'edit_coupons':
                                $admin = new AdminController();
                                $admin->handle_edit_coupons($idCoupon);
                                break;    
                        }
                    } else {
                        $admin = new AdminController();
                        $admin->couponPage();
                        break;
                    }
                    break;
                case 'create_coupons_page':
                    $admin = new AdminController();
                    $admin->create_coupons_page();
                    break;
                case 'list_product':
                    $admin = new AdminProductController();
                    $admin->list_product();
                    break;
                case 'detail_product':
                    $admin = new AdminProductController();
                    $admin->detail_product();
                    break;
                // Hiển thị form chỉnh sửa biến thể sản phẩm
                case 'show_update_variant':
                    $id = $_GET['id'] ?? null;
                    if ($id) {
                        $admin = new AdminProductController();
                        $admin->update_variant();
                    } else {
                        echo "Invalid product ID.";
                    }
                    break;


                // Xử lý cập nhật biến thể sản phẩm
                case 'update_variant':
                    if (isset($_POST['save'])) {
                        $id = $_GET['id'] ?? null;
                        if ($id) {
                            $admin = new AdminProductController();
                            $admin->update_variant_action();
                        } else {
                            echo "Invalid product ID.";
                        }
                    } else {
                        echo "No data to update.";
                    }
                    break;

                // Hiển thị form thêm biến thể sản phẩm
                case 'create_variant':
                    $admin = new AdminProductController();
                    $admin->create_variant();
                    break;

                // Xử lý thêm biến thể sản phẩm
                case 'create_variant_action':
                    if (isset($_POST['save'])) {
                        $admin = new AdminProductController();
                        $admin->create_variant_action();
                    } else {
                        echo "No data to add.";
                    }
                    break;

                case 'create_product':
                    $admin = new AdminProductController();
                    $admin->create_product();
                    break;

                // Lưu sản phẩm mới
                case "create_product_action":
                    $admin = new AdminProductController();
                    $admin->create_product_action();
                    break;

                // Form cập nhật sản phẩm
                case "update_product":
                    $admin = new AdminProductController();
                    $admin->form_update_product();
                    break;
                case "update_product_action":
                    $admin = new AdminProductController();
                    $admin->update_product_action();
                    break;
                
                // Cập nhật ảnh sản phẩm
                case "update_product_image":
                    $admin = new AdminProductController();
                    $admin->update_product_image();
                    break;
                
                // Thêm ảnh cho sản phẩm
                case "add_product_images":
                    $admin = new AdminProductController();
                    $admin->add_product_images();
                    break;
                
                // Xóa ảnh sản phẩm
                case "delete_product_image":
                    $admin = new AdminProductController();
                    $admin->delete_product_image();
                    break;
                
                // Thêm biến thể hàng loạt
                case "add_variants_bulk":
                    $admin = new AdminProductController();
                    $admin->add_variants_bulk();
                    break;
                
                // Thêm 1 biến thể mới
                case "add_single_variant":
                    $admin = new AdminProductController();
                    $admin->add_single_variant();
                    break;
                
                // Xóa biến thể
                case "delete_variant":
                    $admin = new AdminProductController();
                    $admin->delete_variant();
                    break;

                // Danh mục sản phẩm
                case "list_categories":
                    $admin = new AdminProductController();
                    $admin->list_categories();
                    break;
                case "delete_category":
                    $admin = new AdminProductController();
                    $admin->list_categories();
                    break;
                case "update_category":
                    $admin = new AdminProductController();
                    $admin->update_category();
                    break;
                // chart:
                case "chart":
                    $admin = new AdminProductController();
                    $admin->chart();
                    break;
                case "logout_admin":
                    $admin = new AdminController();
                    $admin->logout_admin();
                    break;
            }
            break;
        } else {
            echo '404 Not Found';
            break;
        }

    case 'user':
        // Xử lý route cho login, register, logout
        $action = $_GET['action'] ?? 'login';
        $user = new UserController();
        switch ($action) {
            case 'login':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $user->login(); // Gọi method xử lý login
                } else {
                    $user->showLoginForm();
                }
                break;

            case 'register':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $user->register(); // Gọi method xử lý register
                } else {
                    $user->showRegisterForm();
                }
                break;

            case 'forgotPassword':
                $user->forgotPassword();
                break;

            case 'logout':
                $user->logout(); // Gọi method xử lý logout
                break;
            // Xử lý route cho login
            // echo 'Login page';
            default:
                // Nếu không có route hợp lệ, trả về trang 404
                echo '404 Not Found';
                break;
        }
        break;
}
