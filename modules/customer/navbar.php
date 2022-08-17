<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <a class="navbar-brand text-primary" href="#"><span class="text-danger">Car</span>Rental</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="./customer_component.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./my_booking_component.php">Booking</a>
            </li>
        </ul>
    </div>
    <?php if(isset($_SESSION['customer'])){?>
    <div class="d-flex">
        <a class="btn btn-primary" href="../auth/customer_logout.php">logout</a>
    </div>>
    <?php }?>
    <?php if(!isset($_SESSION['customer'])){?>
        <div class="d-flex">
            <a class="btn btn-primary" href="../auth/customer_login.php">login</a>
        </div>>
    <?php }?>
</nav>
