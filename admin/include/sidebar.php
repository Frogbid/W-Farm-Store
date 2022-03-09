<?php
if (!empty($_SESSION['username'])) {

    $id = $_SESSION['username'];

    $query = "SELECT * from admin WHERE username = '$id'";
    $data = mysqli_query($con, $query);
    $total = mysqli_num_rows($data);

    $username = 0;
    if ($total != 0) {
        while ($result = mysqli_fetch_assoc($data)) {
            $username = $result['user_type'];
        }
    }
    ?>
    <div class="air__menuLeft">
        <div class="air__menuLeft__outer">
            <div class="air__menuLeft__mobileToggleButton air__menuLeft__mobileActionToggle">
                <span></span>
            </div>
            <div class="air__menuLeft__toggleButton air__menuLeft__actionToggle">
                <span></span>
                <span></span>
            </div>
            <a href="javascript: void(0);" class="air__menuLeft__logo">
                <div class="air__menuLeft__logo__name">Farm Store</div>
                <div class="air__menuLeft__logo__descr">Admin Dashboard</div>
            </a>
            <a href="javascript: void(0);" class="air__menuLeft__user">
                <div class="air__menuLeft__user__avatar">
                    <img src="../components/core/img/avatars/avatar.png" height="38px" alt="Admin Avatar"/>
                </div>
                <?php
                $getkey = $con->query("select * from admin")->fetch_assoc();
                ?>
                <div class="air__menuLeft__user__name">
                    <?php echo $getkey['username']; ?>
                </div>
                <div class="air__menuLeft__user__role">
                    Administrator
                </div>
            </a>
            <div class="air__menuLeft__container air__customScroll">
                <ul class="air__menuLeft__list">
                    <?php if ($username == 0 OR $username == 1 OR $username == 2) { ?>
                        <li class="air__menuLeft__category">
                            <span>Dashboards</span>
                        </li>
                        <li class="air__menuLeft__item">
                            <a href="dashboard.php" class="air__menuLeft__link">
                                <i class="fe fe-home air__menuLeft__icon"></i>
                                <span>Dashboards</span>
                            </a>
                        </li>
                        <?php
                    }
                    if ($username == 0 OR $username == 1){
                    ?>
                    <li class="air__menuLeft__category">
                        <span>Product Info</span>
                    </li>
                    <li class="air__menuLeft__item air__menuLeft__submenu">
                        <a href="javascript: void(0)" class="air__menuLeft__link">
                            <i class="fa fa-bullhorn"></i>
                            <span>Catagory</span>
                        </a>
                        <ul class="air__menuLeft__list">
                            <li class="air__menuLeft__item">
                                <a href="category.php" class="air__menuLeft__link">
                                    <span>Add Category</span>
                                </a>
                            </li>
                            <li class="air__menuLeft__item">
                                <a href="categorylist.php" class="air__menuLeft__link">
                                    <span>Category List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="air__menuLeft__item air__menuLeft__submenu">
                        <a href="javascript: void(0)" class="air__menuLeft__link">
                            <i class="fa fa-qq"></i>
                            <span>Subcategory</span>
                        </a>
                        <ul class="air__menuLeft__list">
                            <li class="air__menuLeft__item">
                                <a href="subcategory.php" class="air__menuLeft__link">
                                    <span>Add Subcategory</span>
                                </a>
                            </li>
                            <li class="air__menuLeft__item">
                                <a href="subcategorylist.php" class="air__menuLeft__link">
                                    <span>Subcategory List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="air__menuLeft__item air__menuLeft__submenu">
                        <a href="javascript: void(0)" class="air__menuLeft__link">
                            <i class="fe fe-shopping-cart"></i>
                            <span>Product</span>
                        </a>
                        <ul class="air__menuLeft__list">
                            <li class="air__menuLeft__item">
                                <a href="product.php" class="air__menuLeft__link">
                                    <span>Add Product</span>
                                </a>
                            </li>
                            <li class="air__menuLeft__item">
                                <a href="productlist.php" class="air__menuLeft__link">
                                    <span>Product List</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                        <?php
                    }
                    if ($username == 0 OR $username == 2){
                    ?>
                    <li class="air__menuLeft__item air__menuLeft__submenu">
                        <a href="javascript: void(0)" class="air__menuLeft__link">
                            <i class="fe fe-hard-drive"></i>
                            <span>Product Order</span>
                        </a>
                        <ul class="air__menuLeft__list">
                            <li class="air__menuLeft__item">
                                <a href="order.php" class="air__menuLeft__link">
                                    <span>Pending Order</span>
                                </a>
                            </li>
                            <li class="air__menuLeft__item">
                                <a href="orders.php" class="air__menuLeft__link">
                                    <span>Complete Order</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class=" air__menuLeft__item">
                        <a href="user.php" class="air__menuLeft__link">
                            <i class="fa fa-child"></i>
                            <span>Customer</span>
                        </a>
                    </li>
                        <?php
                    }
                    ?>
                    <li class=" air__menuLeft__item">
                        <a href="contact.php" class="air__menuLeft__link">
                            <i class="fa fa-child"></i>
                            <span>Customer Contact Info</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php
}
?>