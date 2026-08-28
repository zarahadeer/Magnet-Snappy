<?php

include("includes/connection.php");

include("includes/header.php");

include("includes/navbar.php");

?>


<!-- ==========================================
     PRODUCTS PAGE HEADER
========================================== -->

<section class="products-page-header">

    <div class="container text-center">

        <span class="section-label">
            MAGNET SNAPPY SHOP
        </span>

        <h1>
            Pick your
            <span>favorites.</span>
        </h1>

        <p>
            Cute little magnets made to keep
            your favorite memories close.
        </p>

    </div>

</section>


<!-- ==========================================
     PRODUCTS SECTION
========================================== -->

<section class="products-section">

    <div class="container">

        <div class="row g-4">

            <?php

            $query = "SELECT * FROM products ORDER BY id DESC";

            $result = mysqli_query($con, $query);


            if ($result && mysqli_num_rows($result) > 0):

                while ($product = mysqli_fetch_assoc($result)):

            ?>


                    <!-- PRODUCT CARD -->

                    <div class="col-sm-6 col-lg-3">

                        <div class="product-card">


                            <!-- PRODUCT IMAGE -->

                            <div class="product-image">

                                <?php if (!empty($product['image'])): ?>

                                    <img
                                        src="images/products/<?php echo htmlspecialchars($product['image']); ?>"
                                        alt="<?php echo htmlspecialchars($product['name']); ?>"
                                    >

                                <?php else: ?>

                                    <div class="no-product-image">

                                        <i class="bi bi-image"></i>

                                        <span>
                                            No Image
                                        </span>

                                    </div>

                                <?php endif; ?>


                                <!-- HEART -->

                                <span class="product-heart">

                                    <i class="bi bi-heart"></i>

                                </span>

                            </div>


                            <!-- PRODUCT INFORMATION -->

                            <div class="product-info">

                                <h3>

                                    <?php
                                    echo htmlspecialchars(
                                        $product['name']
                                    );
                                    ?>

                                </h3>


                                <p>

                                    <?php
                                    echo htmlspecialchars(
                                        $product['description']
                                    );
                                    ?>

                                </p>


                                <!-- PRICE + CART -->

                                <div class="product-footer">

                                    <strong>

                                        £<?php

                                        echo number_format(
                                            $product['price'],
                                            2
                                        );

                                        ?>

                                    </strong>


                                    <?php if (isset($product['stock']) && $product['stock'] > 0): ?>

                                        <a
                                            href="cart.php?add=<?php echo $product['id']; ?>"
                                            class="add-cart"
                                        >

                                            <i class="bi bi-plus"></i>

                                            Add

                                        </a>


                                    <?php elseif (!isset($product['stock'])): ?>

                                        <!--
                                            If your database does not
                                            have a stock column, allow
                                            the product to be added.
                                        -->

                                        <a
                                            href="cart.php?add=<?php echo $product['id']; ?>"
                                            class="add-cart"
                                        >

                                            <i class="bi bi-plus"></i>

                                            Add

                                        </a>


                                    <?php else: ?>

                                        <span class="out-of-stock">

                                            Out of stock

                                        </span>

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div>


            <?php

                endwhile;

            else:

            ?>


                <!-- ======================================
                     COMING SOON SECTION
                ======================================= -->

                <section class="coming-soon-section">

                    <div class="container">

                        <div class="coming-soon-card">


                            <div class="coming-soon-icon">

                                <i class="bi bi-magnet"></i>

                            </div>


                            <span class="section-label">
                                MAGNET SNAPPY
                            </span>


                            <h2>
                                Our magnets are
                                <span>coming soon!</span>
                            </h2>


                            <p>
                                We're preparing something
                                special for you.
                                Check back soon for our
                                latest cute and memorable
                                magnet designs.
                            </p>

                        </div>

                    </div>

                </section>


            <?php

            endif;

            ?>

        </div>

    </div>

</section>


<!-- ==========================================
     BOOTSTRAP JS
========================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


<!-- YOUR JAVASCRIPT -->

<script src="js/script.js"></script>


<?php

include("includes/footer.php");

?>