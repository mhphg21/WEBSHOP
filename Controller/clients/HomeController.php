<?php
class HomeController
{
    public function index($user_id)
    {
        $gets = new Product();
        $hot_pros = $gets->get_hot_product();
        $products = $gets->get_8_product();
        $coupons = $gets->get_coupons();
        $banners = $gets->get_banner();
        $categories = $gets->list_category();
        $count = $gets->get_count_pro();
        if (isset($_POST['search-pro'])) {
            $keyword = trim($_POST['search']);

            $get = new Product();
            $pros_by_search = $get->pros_by_search($keyword);
            // print_r($pros_by_search);
            // die();
        }

        include './Views/clients/layouts/header1.php';
        include './Views/clients/products/list.php';
        include './Views/clients/layouts/footer.php';
    }

    public function more($user_id)
    {
        $gets = new Product();
        $limit = $_GET['limit'] ?? 8;
        $products = $gets->get_more_product($limit);
        include './Views/clients/products/more_products.php';
    }

    public function search()
    {
        if (isset($_POST['search-pro'])) {
            $keyword = trim($_POST['search']);

            $get = new Product();
            $pros_by_search = $get->pros_by_search($keyword);
            $count_pros_by_search = $get->count_pros_by_search($keyword);
            $categories = $get->list_category();
        }
        include './Views/clients/layouts/header1.php';
        include './Views/clients/products/popup-search.php';
        include './Views/clients/layouts/footer.php';
    }

    public function more_search()
    {
        $gets = new Product();
        $limit = $_GET['limit'] ?? 8;
        $keyword = $_GET['keyword'] ?? '';
        $products = $gets->get_more_search($limit, $keyword);
        include './Views/clients/products/more_search.php';
    }

    public function pro_cate()
    {
        $get = new Product();
        $cate_id = $_GET['cate_id'] ?? 1;
        $categories = $get->list_category();
        $pro_by_cate = $get->pro_by_cate($cate_id);
        $count_pro_cate = $get->count_pro_cate($cate_id);
        $name_by_cate = $get->name_by_cate($cate_id);
        include './Views/clients/layouts/header1.php';
        include './Views/clients/products/list_by_cate.php';
        include './Views/clients/layouts/footer.php';
    }

    public function more_pro_cate()
    {
        $gets = new Product();
        $limit = $_GET['limit'] ?? 8;
        $cate_id = $_GET['cate_id'] ?? 1;
        $products = $gets->get_more_cate_pro($limit, $cate_id);
        include './Views/clients/products/more_cate_pro.php';
    }

    public function detail($user_id)
    {
        $get_id = new Product();
        $id = $_GET['id'] ?? '';
        $arr_products_variant = $get_id->get_product_variant_from_id($id);
        $color_id = $get_id->get_color_id_by_product_variant_id($id);
        $image_is_primary = $get_id->get_image_is_primary($id, $color_id);
        // die();
        $variant_id = $_GET['id'] ?? '';
        $product_id = $get_id->get_product_id_from_variant($variant_id);
        $cate_id = $get_id->get_cate_by_product_id($product_id);
        $pro_by_cate = $get_id->pro_by_cate($cate_id);
        $color_images = $get_id->get_image_color($product_id);
        $image_isnot_primary = $get_id->get_image_isnot_primary($color_id, $variant_id);
        $current_color_value_id = $get_id->get_color_value_id_by_variant($variant_id);
        $list_size = $get_id->get_size_by_color($product_id, $current_color_value_id);
        $categories = $get_id->list_category();
        $hot_pros = $get_id->get_hot_product();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
            $cart_model = new Cart();
            $user_id = $_SESSION['user']['id'] ?? '';

            if (!$user_id) {
                header("Location: index.php?route=user&action=login");
                exit;
            }

            $product_variant_id = $_POST['product_size'] ?? null;
            $quantity = 1;

            $cart_id = $cart_model->get_or_create_cart_id($user_id);

            $exists = $cart_model->check_variant_exists_in_cart($cart_id, $product_variant_id);

            if ($exists) {
                $cart_model->increase_quantity($cart_id, $product_variant_id, $quantity);
            } else {
                $cart_model->add_cart_item($cart_id, $product_variant_id, $quantity);
            }
        }

        include './Views/clients/layouts/header1.php';
        include './Views/clients/products/detail.php';
        include './Views/clients/layouts/footer.php';
    }

    public function view_order($user_id)
    {
        // echo '<pre>';
        if (!$user_id) {
            header("Location: index.php?route=user&action=login");
            exit;
        }

        $get = new OrderClients();

        $categories = $get->list_category();

        $list_order = $get->list_order($user_id);
        // print_r($list_order);
        // die();

        $list_color = $get->list_color_by_user($user_id);

        $list_size = $get->list_size_by_user($user_id);

        $count_order = $get->count_order($user_id);

        include './Views/clients/layouts/header1.php';
        include './Views/clients/layouts/profile_header.php';
        include './Views/clients/orders/list_order.php';
        include './Views/clients/layouts/profile_footer.php';
        include './Views/clients/layouts/footer.php';
    }

    public function oder_detail($order_id)
    {
        // echo'<pre>';
        $get = new OrderClients();
        $categories = $get->list_category();

        $info_items = $get->get_info_items($order_id);

        $info_order = $get->get_info_order($order_id);

        $info_color = $get->get_info_color($order_id);
        $info_size = $get->get_info_size($order_id);

        include './Views/clients/layouts/header1.php';
        include './Views/clients/layouts/profile_header.php';
        include './Views/clients/orders/order_detail.php';
        include './Views/clients/layouts/profile_footer.php';
        include './Views/clients/layouts/footer.php';
    }

    public function cancelled()
    {
        $get = new OrderClients();
        if (isset($_GET['order_id']) && isset($_SESSION['user']['id'])) {

            $user_id = $_SESSION['user']['id'];
            $order_id = $_GET['order_id'];

            $get->update_status_cancelled($order_id);
            $get->update_payments_cancel($order_id);
        }

        $info_items = $get->get_info_items($order_id);
        foreach ($info_items as $row) {
            $product_variant_id = $row['product_variant_id'];
            $quantity = $row['quantity'];

            $get->update_stock_quantity($quantity, $product_variant_id);
        }
    }

    public function order_confirm()
    {
        $get = new OrderClients();
        if (isset($_GET['order_id']) && isset($_SESSION['user']['id'])) {

            $user_id = $_SESSION['user']['id'];
            $order_id = $_GET['order_id'];

            $get->update_status_delivered($order_id);

            $get->update_payments($order_id);
        }
    }

    // public function re_buy()
    // {
    //     $get = new OrderClients();
    //     if (isset($_GET['order_id']) && isset($_SESSION['user']['id'])) {

    //         $user_id = $_SESSION['user']['id'];
    //         $order_id = $_GET['order_id'];

    //         // $get->update_status_($order_id);
    //     }
    // }
}
