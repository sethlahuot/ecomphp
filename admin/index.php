<?php 
session_start();
include "../middleware/adminMiddleware.php";
include "includes/header.php";
include "../config/dashboard_stats.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
          <div class="row mt-4">
          <div class="ms-3">
            <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
            <p class="mb-4">
              Check the sales, value and bounce rate by country.
            </p>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                  <div>
                    <p class="text-sm mb-0 text-capitalize">Total Product</p>
                    <h4 class="mb-0"><?php echo getTotalProducts(); ?></h4>
                  </div>
                  <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10">weekend</i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                  <div>
                    <p class="text-sm mb-0 text-capitalize">Total Users</p>
                    <h4 class="mb-0"><?php echo getTotalUsers(); ?></h4>
                  </div>
                  <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10">person</i>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                  <div>
                    <p class="text-sm mb-0 text-capitalize">Total Order</p>
                    <h4 class="mb-0"><?php echo getTotalOrders(); ?></h4>
                  </div>
                  <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10">leaderboard</i>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                  <div>
                    <p class="text-sm mb-0 text-capitalize">total Sales</p>
                    <h4 class="mb-0">$<?php echo number_format(getTotalSales(), 2); ?></h4>
                  </div>
                  <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10">weekend</i>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          </div>
      </div>
    </div>
</div>
<?php include "includes/footer.php" ?>
