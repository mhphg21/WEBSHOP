    <style>
        .pop_up_order_detail {
            position: fixed;
            /* hoặc absolute */
            top: 50%;
            /* canh giữa */
            left: 55%;
            transform: translate(-50%, -50%);
            /* chính giữa màn hình */
            z-index: 9999;
            /* lớn để nằm trên hết */
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            /* bóng đẹp */
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            height: auto;
            display: none;
            /* Ẩn ban đầu, show bằng JS */
        }

        .form-section {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }

        .form-section h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .btn-export {
            background-color: #28a745;
            color: white;
            margin-left: 10px;
        }

        .btn-export:hover {
            background-color: #218838;
            color: white;
        }

        .table thead th {
            background-color: #e9ecef;
            font-weight: 600;
        }

        .pagination a {
            min-width: 42px;
            text-align: center;
        }

        .pagination .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .pagination .btn-outline-primary {
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .pagination .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: #fff;
        }
    </style>


    <div class="container">
        <form action="" method="POST" class="form-section">
            <h2>Danh sách đơn hàng</h2>

            <div class="row g-3">
                <!-- user name -->
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                </div>

                <!-- email user -->
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">@example.com</span>
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                </div>

                <!-- sđt user -->
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">SĐT</span>
                        <input type="text" name="phone" class="form-control" placeholder="Số điện thoại">
                    </div>
                </div>

                <!-- Địa chỉ người nhận -->
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">Địa chỉ người nhận</span>
                        <input type="text" name="shipping_address" class="form-control" placeholder="Địa chỉ">
                    </div>
                </div>

                <!-- Phương thức thanh toán -->
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">Phương thức thanh toán</span>
                        <select class="form-select" name="payment_method">
                            <option value="" selected>-- Phương thức --</option>
                            <option value="COD">COD</option>
                            <option value="Bank Transfer">Chuyển khoản</option>
                        </select>
                    </div>
                </div>

                <!-- Trạng thái đơn hàng -->
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">Trạng thái đơn hàng </span>
                        <select class="form-select" name="status">
                            <option value="" selected>-- Trạng thái --</option>
                            <option value="processing">Đang xử lí</option>
                            <option value="shipping">Đang vận chuyển</option>
                            <option value="delivered">Đã giao hàng</option>
                            <option value="cancelled">Bị hủy</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-6">
                    <label class="form-label">Từ ngày</label>
                    <input type="date" name="from_date" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Đến ngày</label>
                    <input type="date" name="to_date" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Số tiền từ</label>
                    <input type="number" name="min_price" placeholder="Nhập số tiền dương >0" class="form-control" min="0">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Số tiền đến</label>
                    <input type="number" name="max_price" placeholder="Nhập số tiền dương >0" class="form-control" min="0">
                </div>

                <div class="col-md-12 d-flex justify-content-end mt-3">
                    <button class="btn btn-success" type="submit" name="handleOrders">Tìm kiếm</button>
                    <button class="btn btn-export" type="#">Xuất Excel</button>
                </div>
            </div>
        </form>
    </div>
    <div class="alert alert-info d-flex align-items-center" role="alert">
        <i class="bi bi-list-check me-2"></i>
        Tổng số đơn hàng:<strong class="ms-1"> <?= $total ?></strong>

    </div>
    <?php
    $current_page = $_GET['page'] ?? 1;
    $current_page = (int)$current_page;
    if (!isset($num_page)) {
        $num_page = '';
    }
    // echo($num_page);
    ?>
    <?php if ($current_page > 1): ?>
        <a href="index.php?route=admin&action=list_order_page&page=<?= $current_page - 1 ?>&act=handleOrder"
            class="btn btn-outline-primary">
            ⟵ Trước
        </a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $num_page; $i++): ?>
        <a href="index.php?route=admin&action=list_order_page&page=<?= $i ?>&act=handleOrder"
            class="btn <?= $current_page == $i ? 'btn-primary' : 'btn-outline-primary' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($current_page < $num_page): ?>
        <a href="index.php?route=admin&action=list_order_page&page=<?= $current_page + 1 ?>&act=handleOrder"
            class="btn btn-outline-primary">
            Sau ⟶
        </a>
    <?php endif; ?>



    <div class="table-responsive mt-4">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>STT</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Tổng tiền</th>
                    <!-- <th>C</th> -->
                    <th>Địa chỉ</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($arrayOrder)): ?>
                    <?php foreach ($arrayOrder as $index => $row): ?>
                        <?php

                        $renderStatus = match ($row['status']) {
                            'processing' => 'Đang xử lí',
                            'shipping' => 'Đang vận chuyển',
                            'delivered' => 'Đã giao hàng',
                            'cancelled' => 'Đơn hàng bị hủy',
                            default => 'Không xác định'
                        };
                        ?>
                        <tr>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button class="btn btn-sm btn-success" onclick="showOrderDetail(<?= $row['id'] ?>)">☰</button>
                                    <button class="btn btn-sm btn-warning" onclick="showPaymentDetail(<?= $row['id'] ?>)">💳</button>
                                    <button id="update_status" class="btn btn-sm btn-danger" onclick="cancelOrder(<?= $row['id'] ?>, '<?= $row['status'] ?>')">❌</button>
                                </div>
                            </td>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['phone']) ?></td>
                            <td><?= number_format($row['total_price']) ?> ₫</td>
                            <td><?= htmlspecialchars($row['shipping_address']) ?></td>
                            <td><span class="badge bg-info"><?= $row['payment_method'] ?></span></td>
                            <td width="140">
                                <?php
                                $statusColor = match ($row['status']) {
                                    'processing' => 'warning',
                                    'shipping' => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };
                                ?>

                                <span
                                    onclick="updateStatus('<?= $row['status'] ?>', <?= $row['id'] ?>, <?= $index ?>)"
                                    id="status-<?= $index ?>"
                                    data-index="<?= $index ?>"
                                    class="button-status badge bg-<?= $statusColor ?>">
                                    <?= $renderStatus ?>
                                </span>

                            </td>
                            <td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($row['updated_at'])) ?></td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-muted text-center">Không có đơn hàng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


    <div class="pop_up_order_detail">

    </div>

    <script>
        const popup = document.querySelector('.pop_up_order_detail')
        let toggle = true

        showOrderDetail = (id) => {
            fetch(`index.php?route=admin&action=list_order_page&actionOrder=orderDetail&idOrder=${id}`)
                .then(res => res.text())
                .then(data => {
                    popup.innerHTML = data;
                    popup.style.display = 'block';
                });

        }




        showPaymentDetail = (id) => {
            fetch(`index.php?route=admin&action=list_order_page&actionOrder=paymentDetail&idOrder=${id}`)
                .then(res => res.text())
                .then(data => {
                    popup.innerHTML = data;
                    popup.style.display = 'block';
                });

        }



        window.addEventListener('click', function(e) {
            // Nếu popup đang hiển thị và click không nằm trong popup
            if (popup.style.display === 'block' && !popup.contains(e.target) && !e.target.matches('button.btn-success')) {
                popup.style.display = 'none';
            }
        });



        function updateStatus(currentStatus, orderId, tableIndex) {
            if (confirm('Bạn muốn thay đổi trạng thái')) {
                const statusCell = document.querySelector(`[data-index="${tableIndex}"]`);

                const options = [{
                        value: "processing",
                        label: "Đang xử lí"
                    },
                    {
                        value: "shipping",
                        label: "Đang vận chuyển"
                    },
                    {
                        value: "delivered",
                        label: "Đã giao hàng"
                    }
                    // {
                    //     value: "cancelled",
                    //     label: "Đơn hàng bị hủy"
                    // }
                ];

                // Tìm vị trí của trạng thái hiện tại
                let currentIndex = options.findIndex(opt => opt.value === currentStatus);

                // Tạo select
                const select = document.createElement("select");
                select.className = "form-select form-select-sm";

                // Thêm option trạng thái hiện tại

                const currentOpt = document.createElement('option');
                currentOpt.value = options[currentIndex].value;
                currentOpt.textContent = options[currentIndex].label;
                select.appendChild(currentOpt);

                // Nếu còn trạng thái tiếp theo thì thêm vào
                if (currentIndex + 1 < options.length) {
                    const nextOpt = document.createElement('option');
                    nextOpt.value = options[currentIndex + 1].value;
                    nextOpt.textContent = options[currentIndex + 1].label;
                    select.appendChild(nextOpt);
                }
                if (currentIndex === options.length - 1) {
                    alert("Đơn hàng đã ở trạng thái cuối, không thể cập nhật tiếp.");
                    return;
                }
                statusCell.replaceWith(select);







                // Xử lý khi chọn trạng thái mới
                select.addEventListener("change", function() {
                    // select.innerHTML = '';
                    const newStatus = this.value;
                    if (!confirm("Bạn có chắc muốn cập nhật trạng thái này?")) return;

                    fetch(`index.php?route=admin&action=list_order_page&actionOrder=upadetStatus&idOrder=${orderId}&newStatus=${newStatus}`)
                        .then(res => res.json())
                        .then(data => {

                            if (data.success) {
                                alert("Cập nhật thành công!");
                                // Cập nhật giao diện
                                // confirmUpdate(orderId, newStatus, tableIndex);

                                // Sau khi đổi giao diện xong mới reload
                                setTimeout(() => {
                                    window.location.reload();
                                }, 300); // delay nhẹ để DOM update
                            } else {
                                alert("Có lỗi khi cập nhật!");
                            }

                        })



                    confirmUpdate(orderId, newStatus, tableIndex);

                })



                select.setAttribute("data-index", tableIndex)

            }
        }


        /* -----------------------Confirm Upadate-------------------------- */
        function confirmUpdate(orderId, newStatus, tableIndex) {
            const badge = document.createElement("span");
            badge.className = `button-status badge bg-${getStatusColor(newStatus)}`;
            badge.dataset.index = tableIndex;
            badge.textContent = getStatusLabel(newStatus);
            badge.onclick = () => updateStatus(newStatus, orderId, tableIndex);

            const selectEl = document.querySelector(`[data-index="${tableIndex}"]`);
            selectEl.replaceWith(badge);

            // Lưu chỉ số hàng để sau reload scroll và highlight
            localStorage.setItem("scrollRowIndex", tableIndex);
            setTimeout(() => {
                window.location.reload();
            }, 300); // delay nhẹ để DOM update
        }

        // Chạy khi trang load lại
        window.addEventListener("load", () => {
            const rowIndex = localStorage.getItem("scrollRowIndex");
            if (rowIndex) {
                const row = document.querySelector(`[data-index="${rowIndex}"]`);
                if (row) {
                    // Cuộn về giữa
                    row.scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    });
                }
            }
        });





        // Hàm hỗ trợ lấy label từ value
        function getStatusLabel(status) {
            const map = {
                processing: "Đang xử lí",
                shipping: "Đang vận chuyển",
                delivered: "Đã giao hàng",
                cancelled: "Đơn hàng bị hủy"
            };
            return map[status] || status;
        }

        // Hàm hỗ trợ lấy màu
        function getStatusColor(status) {
            const map = {
                processing: "warning",
                shipping: "primary",
                delivered: "success",
                cancelled: "danger"
            };
            return map[status] || "secondary";
        }



        cancelOrder = (orderId, currentStatus) => {
            console.log(currentStatus);

            if (currentStatus === 'processing') {
                if (confirm('Bạn có muốn hủy đơn hàng')) {
                    fetch(`index.php?route=admin&action=list_order_page&actionOrder=cancelOrder&idOrder=${orderId}&newStatus=cancelled`)
                        .then(res => res.text())
                        .then(data => {
                            location.reload()
                        })
                }
            } else {
                alert('Trạng thái hiện tại của đơn hàng hiện tại không thể hủy')
                return
            }
        }



        // validate form
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector(".form-section");

            form.addEventListener("submit", function(e) {
                let email = form.querySelector("input[name='email']").value.trim();
                let phone = form.querySelector("input[name='phone']").value.trim();
                let fromDate = form.querySelector("input[name='from_date']").value;
                let toDate = form.querySelector("input[name='to_date']").value;
                let minPrice = form.querySelector("input[name='min_price']").value;
                let maxPrice = form.querySelector("input[name='max_price']").value;

                // Regex email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                // Regex phone (9–11 số)
                const phoneRegex = /^[0-9]{9,11}$/;

                // Validate email
                if (email !== "" && !emailRegex.test(email)) {
                    alert("Email không đúng định dạng!");
                    e.preventDefault();
                    return;
                }

                // Validate phone
                if (phone !== "" && !phoneRegex.test(phone)) {
                    alert("Số điện thoại chỉ gồm 9–11 chữ số!");
                    e.preventDefault();
                    return;
                }

                // Validate ngày
                if (fromDate !== "" && toDate !== "" && new Date(fromDate) > new Date(toDate)) {
                    alert("Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc!");
                    e.preventDefault();
                    return;
                }

                // Validate số tiền
                if (minPrice !== "" && (isNaN(minPrice) || Number(minPrice) < 0)) {
                    alert("Số tiền từ phải là số dương!");
                    e.preventDefault();
                    return;
                }

                if (maxPrice !== "" && (isNaN(maxPrice) || Number(maxPrice) < 0)) {
                    alert("Số tiền đến phải là số dương!");
                    e.preventDefault();
                    return;
                }

                if (minPrice !== "" && maxPrice !== "" && Number(minPrice) > Number(maxPrice)) {
                    alert("Số tiền từ phải nhỏ hơn hoặc bằng số tiền đến!");
                    e.preventDefault();
                    return;
                }
            });
        });
    </script>









































    <script>
        // console.log(statusCell)
        // handleUpate = (index, rowId) => {
        //     

        //     // Kiểm tra nếu đã có select rồi thì không làm gì cả
        //     if (statusCell.tagName === "SELECT") return;

        //     // Tạo <select>
        //     const select = document.createElement("select");
        //     select.className = "form-select form-select-sm";

        //     const options = [{
        //             value: "processing",
        //             label: "Đang xử lí"
        //         },
        //         {
        //             value: "shipping",
        //             label: "Đang vận chuyển"
        //         },
        //         {
        //             value: "delivered",
        //             label: "Đã giao hàng"
        //         },
        //         {
        //             value: "cancelled",
        //             label: "Đơn hàng bị hủy"
        //         }
        //     ];

        //     options.forEach(opt => {
        //         const option = document.createElement("option");
        //         option.value = opt.value;
        //         option.textContent = opt.label;

        //         // Nếu status hiện tại trùng thì set selected
        //         if (statusCell.innerText.trim() === opt.label) {
        //             option.selected = true;
        //         }

        //         select.appendChild(option);
        //     });

        //     // Thay thế span bằng select
        //     statusCell.replaceWith(select);

        //     // Có thể thêm sự kiện khi select thay đổi
        //     select.addEventListener("change", function() {
        //             console.log("Trạng thái mới:", this.value);
        //             // Sau khi cập nhật có thể gửi fetch hoặc AJAX lên server tại đây
        //             fetch(`index.php?route=admin&action=list_order_page&&actionOrder=upadetStatus&idOrder=${rowId}&newStatus=${this.value}`)
        //                 .then(res => res.json())
        //                 .then(data => {
        //                     if (data.success) {
        //                         alert("Cập nhật thành công!");
        //                     } else {
        //                         alert("Có lỗi khi cập nhật!");
        //                     }
        //                 })
        //         }


        //     );
        //     select.setAttribute("data-index", index);
        // }

        // confirmUpdate = (index) => {

        //     var select = document.querySelector(`[data-index="${index}"]`);
        //     var selectedValue = select.value;
        //     var selectedLabel = select.options[select.selectedIndex].text;

        //     // Mapping màu theo status
        //     const statusColorMap = {
        //         'processing': 'warning',
        //         'shipping': 'primary',
        //         'delivered': 'success',
        //         'cancelled': 'danger'
        //     };

        //     // Tạo lại span
        //     const span = document.createElement("span");
        //     span.setAttribute("data-index", index);
        //     span.className = `button-status badge bg-${statusColorMap[selectedValue] || 'secondary'}`;
        //     span.id = `status-${index}`;
        //     span.innerText = selectedLabel;

        //     select.replaceWith(span);
        // }

        // updateStatus = (index, rowId) => {
        //     if (toggle) {
        //         handleUpate(index, rowId);
        //     } else {
        //         confirmUpdate(index);
        //     }
        //     toggle = !toggle
        // };
    </script>