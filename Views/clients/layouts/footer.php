</div>
<footer class="footer">
    <div class="footer-container">

        <!-- Thương hiệu -->
        <div class="footer-column">
            <h3>THƯƠNG HIỆU</h3>
            <div class="ul">
                <div class="li"><a href="#">Giới thiệu</a></div>
                <div class="li"><a href="#">Hệ thống cửa hàng</a></div>
                <div class="li"><a href="#">Tin tức</a></div>
                <div class="li"><a href="#">Tuyển dụng</a></div>
                <div class="li"><a href="#">Với cộng đồng</a></div>
                <div class="li"><a href="#">Liên hệ</a></div>
            </div>
        </div>

        <!-- Hỗ trợ -->
        <div class="footer-column">
            <h3>HỖ TRỢ</h3>
            <div class="ul">
                <div class="li"><a href="#">Hỏi đáp</a></div>
                <div class="li"><a href="#">Chính sách KHTT</a></div>
                <div class="li"><a href="#">Điều kiện - Điều khoản chính sách KHTT</a></div>
                <div class="li"><a href="#">Chính sách vận chuyển</a></div>
                <div class="li"><a href="#">Kiểm tra đơn hàng</a></div>
                <div class="li"><a href="#">Gợi ý tìm size</a></div>
                <div class="li"><a href="#">Tra cứu điểm thẻ</a></div>
                <div class="li"><a href="#">Chính sách bảo mật thông tin KH</a></div>
            </div>
        </div>

        <!-- Sản phẩm -->
        <div class="footer-column">
            <h3>SẢN PHẨM</h3>
            <div class="ul">
                <?php
                foreach ($categories as $row) {
                ?>
                    <div class="li"><a href="#"><?= $row['name'] ?></a></div>
                <?php } ?>
            </div>
        </div>

        <!-- Tài khoản -->
        <div class="footer-column">
            <h3>TÀI KHOẢN</h3>
            <div class="ul">
                <div class="li"><a href="#">Đăng nhập/Đăng Ký</a></div>
                <div class="li"><a href="#">Mã ưu đãi</a></div>
                <div class="li"><a href="#">Lịch sử đặt hàng</a></div>
            </div>
        </div>

        <!-- Theo dõi -->
        <div class="footer-column">
            <h3>THEO DÕI CHÚNG TÔI</h3>
            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
            </div>
        </div>

    </div>
</footer>

<!-- ---------------------------TRANG HOME------------------------------- -->
<script>
// Hàm cập nhật badge giỏ hàng
function updateCartBadge(count) {
    const badge = document.getElementById('cart-badge');
    if (badge) {
        badge.textContent = count > 99 ? '99+' : count;
        badge.style.display = count > 0 ? 'flex' : 'none';
    }
}

// Hàm lấy số lượng giỏ hàng từ server
function fetchCartCount() {
    fetch('index.php?route=clients&action=get_cart_count', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartBadge(data.count);
        }
    })
    .catch(error => console.error('Error fetching cart count:', error));
}

    let limit = 8;
    const viewMore = document.getElementById("view-more-pro");

    function moreProducts(count) {
        limit += limit;
        fetch(`index.php?route=clients&action=more_product&limit=${limit}`)
            .then(response => response.text())
            .then(data => {
                document.querySelector('#ap').style.display = 'none'
                viewMore.innerHTML = data
                viewMore.style.display = 'block'
            });
        if ((count + 8) <= limit) {
            alert("Đã hết sản phẩm")
        }
    }

    function moreProductsSearch(keyword, count) {
        limit += limit;
        fetch(`index.php?route=clients&action=more_search&limit=${limit}&keyword=${keyword}`)
            .then(response => response.text())
            .then(data => {
                document.querySelector('#ap').style.display = 'none'
                viewMore.innerHTML = data
                viewMore.style.display = 'block'
            });
        if ((count + 8) <= limit) {
            alert("Đã hết sản phẩm")
        }
    }

    function moreProductsCate(cate_id, count) {
        limit += limit;
        fetch(`index.php?route=clients&action=more_pro_cate&limit=${limit}&cate_id=${cate_id}`)
            .then(response => response.text())
            .then(data => {
                document.querySelector('#ap').style.display = 'none'
                viewMore.innerHTML = data
                viewMore.style.display = 'block'
            });
        if ((count + 8) <= limit) {
            alert("Đã hết sản phẩm")
        }
    }

    document.getElementById("searchForm").addEventListener("submit", function(e) {
        const input = document.getElementById("searchInput");
        const keyword = input.value.trim();

        if (keyword.length < 1) {
            e.preventDefault();
            alert("Vui lòng nhập ký tự để tìm kiếm!");
            input.focus();
        }
    });

    document.getElementById("donhang").addEventListener("click", function(e) {
        e.preventDefault();
        if (!isLoggedIn) {
            if (!confirm("Vui lòng đăng nhập để xem đơn hàng!")) return;
            window.location.href = "index.php?route=user&action=login";
            return;
        } else {
            window.location.href = "index.php?route=clients&action=profile&action_acc=oder"
        }
    })
</script>

<!-- ---------------------------------PHẦN SLIDE SHOW------------------------------ -->
<script>
    const ban = document.getElementsByClassName("ban");
    let currentIndex = 0;
    ban[currentIndex].style.display = "block";

    function preview() {
        ban[currentIndex].style.display = "none";
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = ban.length - 1;
        }
        ban[currentIndex].style.display = "block";
    }

    function next() {
        ban[currentIndex].style.display = "none";
        currentIndex++;
        if (currentIndex > ban.length - 1) {
            currentIndex = 0;
        }
        ban[currentIndex].style.display = "block";
    }

    function start() {
        setInterval(next, 3000);
    }
    start();
</script>

<!-- -------------------------------PHẦN SỬ DỤNG COUPONS----------------------------------- -->
<script>
    function useCoupon() {
        const target = document.querySelector('.view-more');
        if (!target) return;

        target.scrollIntoView({
            behavior: 'smooth',
            block: 'end' // đưa ra giữa màn hình
        });
    }
</script>

<!-- ---------------------------------------PHẦN SHOW GIỎ HÀNG------------------------------------------- -->
<script>
    const popup = document.getElementById('popup-cart');
    const isLoggedIn = <?= isset($_SESSION['user']) ? 'true' : 'false' ?>;
    const userId = <?= isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 'null' ?>;


    function show_list_cart(user_id) {
        if (!isLoggedIn) {
            if (!confirm("Vui lòng đăng nhập để xem giỏ hàng!")) return;
            window.location.href = "index.php?route=user&action=login";
            return;
        }

        fetch(`index.php?route=clients&action=list_cart`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(res => res.text())
            .then(data => {
                // console.log('data: ', data);
                popup.innerHTML = data;
                popup.style.display = 'block';
            });
    }

    document.addEventListener('click', function(e) {
        if (!popup.contains(e.target) && !e.target.closest('.nav-link')) {
            popup.style.display = 'none';
        }
    });

    function deleteFromCart(variantId) {
        if (!confirm("Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?")) return;

        fetch(`index.php?route=clients&action=list_cart&action_cart=delete_cart&variant_id=${variantId}`, {
                method: 'GET'
            })
            .then(res => res.text())
            .then(data => {
                show_list_cart(userId);
            })
            .catch(err => {
                alert("Đã có lỗi xảy ra khi xóa sản phẩm.");
                console.error(err);
            });
    }

    function reduceCart(variantId, quantity) {
        if (quantity <= 1) {
            if (!confirm("Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?")) return;
        }

        fetch(`index.php?route=clients&action=list_cart&action_cart=reduce&variant_id=${variantId}`, {
                method: 'GET'
            })
            .then(res => res.text())
            .then(data => {
                show_list_cart(userId);
            })
            .catch(err => {
                alert("Đã có lỗi xảy ra khi xóa sản phẩm.");
                console.error(err);
            });
    }

    function increaseCart(variantId, stockQuantity, quantity) {
        if (quantity >= stockQuantity) {
            alert(`Mặt hàng chỉ còn ${stockQuantity} sản phẩm`);
            return;
        }

        fetch(`index.php?route=clients&action=list_cart&action_cart=increase&variant_id=${variantId}`, {
                method: 'GET'
            })
            .then(res => res.text())
            .then(data => {
                show_list_cart(userId);
            })
            .catch(err => {
                alert("Đã có lỗi xảy ra khi xóa sản phẩm.");
                console.error(err);
            });
    }
</script>

<!-- -------------------------------------------PHẦN DETAIL VÀ THÊM VÀO GIỎ--------------------------------------------------- -->

<script>
    function show_detail(productVariantId, user_id) {
        fetch(`index.php?route=clients&action=detail&id=${productVariantId}&user_id=${user_id}`)
            .then(res => res.text())
            .then(html => {
                document.querySelector('.container-header1').style.display = 'none';
                document.querySelector('footer').style.display = 'none';
                document.querySelector('.container-detail').style.display = 'none';
                document.querySelector('#product-detail').innerHTML = html;
                document.querySelector('#product-detail').style.display = 'block';
            })
            .catch(err => console.error(err));
    }

    function activeImg(clickedImg) {
        const colorImg = document.querySelectorAll(" .color-img img");
        colorImg.forEach(img => img.classList.remove("active"));
        clickedImg.classList.add("active");
    }


    function changeImage(thumb) {
        const main = document.getElementById("main-image");
        main.src = thumb.src;

        // Đổi class active nếu bạn muốn đánh dấu ảnh đang chọn
        const allThumbs = document.querySelectorAll(".child-img img");
        allThumbs.forEach(img => img.classList.remove("active"));
        thumb.classList.add("active");
    }

    // Lấy tất cả nút size
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('bl-size')) {
            const sizeInput = document.getElementById('product_size');
            const selectedSize = e.target.getAttribute('data-size');
            sizeInput.value = selectedSize;
            console.log('selectedSize: ', selectedSize);

            document.querySelectorAll('.bl-size').forEach(btn => btn.classList.remove('active'));
            e.target.classList.add('active');
        }
    });

    function validateForm() {
        const size = document.getElementById('product_size').value;
        if (!size) {
            alert('Vui lòng chọn kích cỡ!');
            return false;
        }

        const isLoggedIn = <?= isset($_SESSION['user']) ? 'true' : 'false' ?>;
        if (!isLoggedIn) {
            alert("Vui lòng đăng nhập để thêm vào giỏ hàng!");
            window.location.href = "index.php?route=user&action=login";
            return false;
        }

        alert("Đã thêm sản phẩm vào giỏ hàng!");
        return true;
    }
</script>

<!-- ------------------------------Phần order---------------------------- -->
<script>
    function actionOder(processing, shipping, cancelled, orderId, productVariantId) {
        if (processing) {
            if (confirm('Bạn có chắc muốn hủy đơn hàng này?')) {
                // console.log("Hủy đơn hàng ID:", orderId);
                fetch(`index.php?route=clients&action=profile&action_acc=oder&action_oder=cancelled&order_id=${orderId}`)
                    .then(res => res.text())
                    .then(data => {
                        alert("Hủy đơn hàng thành công!");
                        location.reload();
                    })

                    .catch(err => {
                        alert("Đã có lỗi xảy ra khi hủy đơn hàng.");
                        console.error(err);
                    });

            }
        } else if (shipping) {
            if (confirm('Xác nhận đã nhận được hàng?')) {
                fetch(`index.php?route=clients&action=profile&action_acc=oder&action_oder=order_confirm&order_id=${orderId}`)
                    .then(res => res.text())
                    .then(data => {
                        alert("Cảm ơn quý khách!");
                        location.reload();
                    })

                    .catch(err => {
                        alert("Đã có lỗi xảy ra khi hủy đơn hàng.");
                        console.error(err);
                    });
            }
        } else if (cancelled) {
            if (confirm('Bạn muốn mua lại đơn hàng này?')) {
                window.location = `index.php?route=clients&action=detail&id=${productVariantId}&user_id=${userId}`
            }
        }
    }
</script>

</body>

</html>