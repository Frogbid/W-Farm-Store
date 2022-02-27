<div class="air__layout__footer">
    <div class="air__footer">
        <div class="air__footer__inner">
            <div class="row">
                <div class="col-md-8">
                    <?php
                    $getkey = $con->query("select * from setting")->fetch_assoc();
                    ?>
                    <p>
                        <strong>
                            <?php echo $getkey['about_us']; ?>
                        </strong>
                    </p>
                    <p>
                        © 2020 ECommerce. All rights reserved.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="air__footer__logo">
                        <div class="air__footer__logo__name"> ECommerce</div>
                        <div class="air__footer__logo__descr"> &nbsp;&nbsp;Admin Dashboard</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>