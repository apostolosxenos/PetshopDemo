<?php
include('admin_header.php');
include('navbar.php');
include('sidebar.php');
?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <!-- <h1 class="m-0 text-dark">Προσθήκη Προϊόντος</h1> -->
            </div>
            <div class="col-sm-6">
              <!-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Admin Panel</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol> -->
            </div>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3>Προσθήκη προϊόντος</h3>
                  </div>
                </div>
                <div class="card-body">
                  <form method="POST" action="<?php echo htmlspecialchars('add_product_check.php') ?>">
                    <div class="form-group">
                      <label for="device">
                        <h5>Ονομασία:</h5>
                      </label>
                      <input type="text" name="name" required class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="category">
                        <h5>Κατηγορία:</h5>
                      </label>
                      <select name="category" class="form-control">
                        <option value="ΤΡΟΦΗ">ΤΡΟΦΗ</option>
                        <option value="ΛΙΧΟΥΔΙΕΣ">ΛΙΧΟΥΔΙΕΣ</option>
                        <option value="ΚΟΛΑΡΑ">ΚΟΛΑΡΑ</option>
                        <option value="ΚΟΛΑΡΑ">ΡΟΥΧΑ</option>
                        <option value="ΚΟΛΑΡΑ">ΠΑΙΧΝΙΔΙΑ</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="description">
                        <h5>Περιγραφή:</h5>
                      </label>
                      <input type="text" name="description" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="image">
                        <h5>Φωτογραφία (σύνδεσμος):</h5>
                      </label>
                      <input type="text" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="stock">
                        <h5>Απόθεμα:</h5>
                      </label>
                      <input type="text" name="stock" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="price">
                        <h5>Τιμή</h5>
                      </label>
                      <input type="text" name="price" class="form-control">
                    </div>
                    <div class="form-group">
                      <input class="btn btn-primary" type="submit" name="add-product" value="Προσθήκη" style="float: right">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <?php include('admin_footer.php') ?>