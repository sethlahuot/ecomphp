<!-- About Us start -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/ecomphp/config/connect.php";
$settings_query = "SELECT * FROM settings LIMIT 1";
$stmt = $pdo->prepare($settings_query);
$stmt->execute();
$settings = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="testimonial-header text-center">
        </div>
        <div class="row">
            <div class="col-md-12">
                <p><?= htmlspecialchars($settings['about_description1']) ?></p>
            </div>
        </div>
        <h4 class="display-5 mb-5 text-dark">Our Story!</h4>
        <div class="row">
            <div class="col-md-12">
                <p><?= htmlspecialchars($settings['about_description2']) ?></p>
            </div>
        </div>
        <h4 class="display-5 mb-5 text-dark">What Makes Us Different?</h4>
        <div class="row">
            <div class="col-md-12">
                <?= htmlspecialchars($settings['about_description3']) ?>
            </div>
        </div>
        <h4 class="display-5 mb-5 text-dark">Our Mission</h4>
        <div class="row">
            <div class="col-md-12">
                <p><?= htmlspecialchars($settings['about_description4']) ?></p>
            </div>
        </div>
    </div>
</div>
<!-- About Us End -->

        