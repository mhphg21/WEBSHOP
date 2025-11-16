<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-box-open me-2"></i>Danh sách sản phẩm</h3>
        <a href="index.php?route=admin&action=create_product" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Thêm sản phẩm mới
        </a>
    </div>

    <!-- search form -->
    <form method="post" action="index.php?route=admin&action=list_product" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm sản phẩm">
            </div>
            <div class="col-auto">
                <select class="form-select" name="filter_by_categories" id="filter_by_categories">
                    <option selected value="0">Danh mục</option>
                    <?php foreach ($categories as $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" name="search_form" class="btn btn-primary">
                    <i class="bi bi-search"></i> Tìm kiếm
                </button>
            </div>
        </div>
    </form>

    <!-- products table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Mô tả</th>
                    <th>Số lượng tồn</th>
                    <th>Tình trạng</th>
                    <th>Cập nhật</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($all_products)): ?>
                    <?php foreach ($all_products as $product): ?>
                        <tr>
                            <td>
                                <img src="./Public/Img/uploads/<?= $product["thumbnail"] ?>" alt="Ảnh sản phẩm" width="60"
                                    height="60" style="border-radius: 8px; object-fit: cover;">
                            </td>
                            <td><?= $product["name"] ?></td>
                            <td><?= $product["categories"] ?></td>
                            <td class="text-truncate" style="max-width: 200px;"><?= $product["description"] ?></td>
                            <td><?= $product["total_stock"] ?></td>
                            <td><?= $product["status"] ?></td>
                            <td><?= $product["updated_at"] ?></td>
                            <td>
                                <a href="index.php?route=admin&action=detail_product&id=<?= $product["id"] ?>"
                                    class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                <a href="index.php?route=admin&action=update_product&id=<?= $product["id"] ?>"
                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Không tìm thấy sản phẩm
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        <nav>
            <ul class="pagination">
                <?php if ($current_page > 1): ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="index.php?route=admin&action=list_product&page=<?= $current_page - 1 ?>">Prev</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?route=admin&action=list_product&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="index.php?route=admin&action=list_product&page=<?= $current_page + 1 ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>