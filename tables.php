<section class="container-fluid mb-5">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="row">
                <div class="col-12 tablename">
                    <h5 class="text-center align-vertical">Airplanes</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                        include('airplanesTable.php');
                    ?>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="row">
                <div class="col-12 tablename">
                    <h5 class="text-center align-vertical">Arrivals</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                        include('arrivalsTable.php');
                    ?>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="row">
                <div class="col-12 tablename">
                    <h5 class="text-center align-vertical">Departures</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                        include('departuresTable.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>