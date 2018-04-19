<?php
try {
    $connection = com\loabten\model\data\DatabaseUtils::connect();
    $productDao = new com\loabten\model\data\ProductDao($connection);
} catch (Exception $exc) {
    $error = $exc->getMessage();
    include 'views/dashboard/error.php';
}?>
<?php
$result = $productDao->findAll();
    ?>
    <div class="category-tab">
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tshirt" >
                <div class="col-sm-3">
                    <?php
                    if (!empty($result)):
                    $ch = 'A';
                    foreach ($result as $row) :
                        ?>
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <?php if (!empty($row['image'])): ?>
                                            <img src="..<?= $row['image'] ?>" width="30" height="30">
                                        <?php else: ?>
                                            &nbsp;
                                        <?php endif ?>
                                        <h2><?= $row['unitprice'] ?>đ</h2>
                                        <p><?= $row['productname'] ?></p>
                                        <?php //include 'common/list_control_buttons.php';?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        $ch ++;
                        if ($ch > 'Z')
                        $ch = 'A';
                         endforeach;
                         endif;
                        ?>
                </div>
            </div>
        </div>
    </div><!--/category-tab-->

    <div class="productsale"><!--Sản phẩm giảm giá-->
        <h2 class="title text-center">Sản phẩm giảm giá</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="common/images/home/donghoda.jpg" alt="" />
                                    <h2>290.000đ</h2>
                                    <p>Đồng Hồ Đa Năng 100A</p>
                                    <?php include 'common/list_control_buttons.php';?>  </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="common/images/home/neptn.jpg" alt="" />
                                    <h2>10.000đ</h2>
                                    <p>Nẹp Tản Nhiệt</p>
                                    <?php include 'common/list_control_buttons.php';?>  </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="common/images/home/htkhilanh.jpg" alt="" />
                                    <h2>950.000đ</h2>
                                    <p>Hệ Thống Thổi Khí Lạnh</p>
                                    <?php include 'common/list_control_buttons.php';?>  </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="common/images/home/mchuyengt.jpg" alt="" />
                                    <h2>120.000đ</h2>
                                    <p>Mạch Chuyển Giao Tiếp USB</p>
                                    <?php include 'common/list_control_buttons.php';?>  </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="common/images/home/nguonzeqi.jpg" alt="" />
                                    <h2>130.000đ</h2>
                                    <p>Nguồn ZEQI 5V 2.5A</p>
                                    <?php include 'common/list_control_buttons.php';?>  </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="common/images/home/tannhiet.jpg" alt="" />
                                    <h2>70.000đ</h2>
                                    <p>Tản Nhiệt Nhôm</p>
                                    <?php include 'common/list_control_buttons.php';?>  </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="common/images/home/xetank.jpg" alt="" />
                                    <h2>1.800.000đ</h2>
                                    <p>Khung Xe Tank</p>
                                    <?php include 'common/list_control_buttons.php';?>  </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="common/images/home/camera.jpg" alt="" />
                                    <h2>480.000đ</h2>
                                    <p>Camera USB 2MP</p>
                                    <?php include 'common/list_control_buttons.php';?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div><!--/Sản phẩm giảm giá-->

    </div>
