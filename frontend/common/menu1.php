                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="checkout.html"><i class="fa fa-refresh"></i> So sánh sản phẩm</a></li>
                                    <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                    <?php 
                                    $customers = $customerDao->findByUsername($username);
                                    
                                    ?>
                                    <li><a href="index.php?action=customer_profile"><i class="fa fa-user"></i><?=$customers['name']?></a></li>
                                    <li><a href="index.php"><i class="fa fa-sign-out">Logout</i></a></li>
                                </ul>
                            </div>
                        </div>