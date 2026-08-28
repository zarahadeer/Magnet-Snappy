<?php

include("includes/connection.php");

$pageTitle = "Magnet Snappy | Snap It. Stick It. Cherish It.";

include("includes/header.php");
include("includes/navbar.php");

?>

<!-- HERO SECTION -->
<section class="hero-section">

    <div class="hero-container">

        <!-- LEFT SIDE -->
        <div class="hero-content">

            <span class="hero-small-text">
                LITTLE MEMORIES. BIG FEELINGS. ♡
            </span>

            <h1 class="hero-title">
                <span class="snap-text">Snap It.</span><br>
                <span class="stick-text">Stick It.</span><br>
                <span class="cherish-text">Cherish It.</span>
            </h1>

            <p class="hero-description">
                Turn your favorite memories into cute little
                magnets you can keep close every day. ♡
            </p>

            <div class="hero-buttons">

                <a href="products.php" class="btn-pink">
                    Shop Magnets
                    <i class="bi bi-arrow-right"></i>
                </a>

                <a href="#about" class="btn-purple">
                    Our Story
                </a>
                <br>
                

            </div>

        </div>


        <!-- RIGHT SIDE -->
        <div class="hero-image-area">

            <div class="hero-image-bg"></div>

            <div class="hero-magnets">

                <div class="magnet magnet-1">
                    <img src="images/hero-magnet-1.jpg" alt="Photo Magnet">
                </div>

                <div class="magnet magnet-2">
                    <img src="images/hero-magnet-2.jpg" alt="Photo Magnet">
                </div>

                <!-- <div class="magnet magnet-3">
                    <img src="images/hero-magnet-3.jpg" alt="Photo Magnet">
                </div> -->

                <div class="magnet magnet-4">
                    <img src="images/hero-magnet-4.jpg" alt="Photo Magnet">
                </div>

            </div>

            <!-- Decorative hearts -->
            <span class="hero-heart heart-1">♡</span>
            <span class="hero-heart heart-2">♡</span>

        </div>

    </div>

</section>


<!-- =========================
     ABOUT SECTION
========================= -->

<section class="about-section" id="about">

    <div class="about-container">

        <!-- About Image -->

        <div class="about-image">

            <img
                src="images/about.jpg"
                alt="Magnet Snappy memories"
            >

        </div>


        <!-- About Content -->

        <div class="about-content">

            <span class="section-label">
               <em>A LITTLE ABOUT US</em>
            </span>

            <h2>
                Because your memories
                deserve a place
                <span>on the fridge.</span>
            </h2>

            <p>
                At Magnet Snappy, we turn your favourite
                photographs into beautiful little magnets
                that you can see and enjoy every day.
            </p>

            <p>
                From family moments and holidays to
                pets, friendships and special occasions,
                we help you keep the memories that matter
                close.
            </p>

            <a href="products.php" class="btn-purple">
                Explore Our Magnets
            </a>

        </div>

    </div>

</section>


<!-- =========================
     PRODUCTS PREVIEW
========================= -->

<section class="products-preview" id="shop">

    <div class="section-heading">

        <span class="section-label">
            MAGNET SNAPPY SHOP
        </span>

        <h2>
            Pick your <span>favorites.</span>
        </h2>

        <p>
            Cute little magnets made to keep
            your favourite memories close.
        </p>

    </div>


    <div class="product-preview-grid">

        <?php

        $query = "SELECT * FROM products ORDER BY id DESC LIMIT 6";

        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0):

            while ($product = mysqli_fetch_assoc($result)):

        ?>

            <div class="product-card">

                <div class="product-image">

                    <img
                        src="<?php echo htmlspecialchars($product['image']); ?>"
                        alt="<?php echo htmlspecialchars($product['name']); ?>"
                    >

                </div>

                <div class="product-info">

                    <h3>
                        <?php echo htmlspecialchars($product['name']); ?>
                    </h3>

                    <p class="product-price">
                        £<?php echo number_format($product['price'], 2); ?>
                    </p>

                    <a
                        href="products.php"
                        class="btn-small"
                    >
                        View Product
                    </a>

                </div>

            </div>

        <?php

            endwhile;

        else:

        ?>

            <div class="no-products">

                <h3>Our magnets are coming soon 💕</h3>

                <p>
                    New designs will be added here.
                </p>

            </div>

        <?php endif; ?>

    </div>


    <div class="shop-button">

        <a href="products.php" class="btn-pink">
            View All Magnets
        </a>

    </div>

</section>


<!-- =========================
     FAQ SECTION
========================= -->

<section class="faq-section" id="faq">

    <div class="section-heading">

        <span class="section-label">
            QUESTIONS?
        </span>

        <h2>
            Frequently Asked <span>Questions</span>
        </h2>

    </div>


    <div class="faq-container">


        <div class="faq-item">

            <h3>
                Can I use my own photo?
            </h3>

            <p>
                Yes! You can upload your favourite
                photo when placing your order.
            </p>

        </div>


        <div class="faq-item">

            <h3>
                What currency do you accept?
            </h3>

            <p>
                Orders and payments are processed
                in British Pounds (£ GBP).
            </p>

        </div>


        <div class="faq-item">

            <h3>
                How long does delivery take?
            </h3>

            <p>
                Delivery times depend on your location
                and the selected delivery option.
            </p>

        </div>


        <div class="faq-item">

            <h3>
                Can I order multiple magnets?
            </h3>

            <p>
                Absolutely! Add as many magnets as
                you like to your cart.
            </p>

        </div>

    </div>

</section>


<!-- =========================
     CONTACT SECTION
========================= -->

<section class="contact-section" id="contact">

    <div class="section-heading">

        <span class="section-label">
            LET'S CONNECT
        </span>

        <h2>
            Have a <span>question?</span>
        </h2>

        <p>
            Send us a message and we'll be happy
            to help.
        </p>

    </div>


    <div class="contact-container">

        <form
            action=""
            method="POST"
            class="contact-form"
        >

            <div class="form-row">

                <div class="form-group">

                    <label>
                        Your Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter your name"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >

                </div>

            </div>


            <div class="form-group">

                <label>
                    Message
                </label>

                <textarea
                    name="message"
                    rows="5"
                    placeholder="Write your message..."
                    required
                ></textarea>

            </div>


            <button
                type="submit"
                class="btn-pink"
            >
                Send Message
            </button>

        </form>

    </div>

</section>


<?php

include("includes/footer.php");

?>