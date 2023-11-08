<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="d-none d-md-block col-md-4">
                    <div class="row">
                        <div class="col-12 mt-3 d-flex justify-content-center">
                            <form method="POST" class="d-flex">
                                <input type="date" id="fechaPers" name="fechaPers" class="form-control"
                                    max="<?php echo date('Y-m-d'); ?>">
                                <button type="submit" class="btn ml-2" value="Search" id="search"
                                    style="background-color: #0A497B; color: gold;"><strong><i
                                            class="fa-solid fa-magnifying-glass"></i></strong></button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 my-2">
                            <div class="text-center">
                                <button type="button" class="btn" value="Today" id="obtenerFecha"
                                    style="background-color: #0A497B; color: gold;"><strong>Today</strong></button>
                                <script>
                                $(document).ready(function() {
                                    $("#obtenerFecha").click(function() {
                                        $.ajax({
                                            type: "POST",
                                            url: "obtener_fecha.php",
                                            success: function(data) {
                                                $("#resultadoFecha").html(data);
                                            }
                                        });
                                    });
                                });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="text-center">
                                <div class="form-outline">
                                    <?php
                                        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['q'])) {
                                            // Obtener la consulta de búsqueda del usuario
                                            $query = $_GET['q'];

                                            // Definir los parámetros de la API
                                            $queryParams = [
                                                'access_key' => '6b4c6989c16e86b39ecb01fb10bb13dc',
                                                'limit' => 50,
                                                'search' => $query, // Agregar el término de búsqueda a los parámetros
                                            ];

                                            // Construir la URL de la API con los parámetros
                                            $apiURL = sprintf('%s?%s', 'http://api.aviationstack.com/v1/cities'. http_build_query($queryParams));


                                            // Inicializar cURL
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, $apiURL);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                            // Ejecutar la API
                                            $api_response = curl_exec($ch);

                                            // Cerrar cURL
                                            curl_close($ch);

                                            // Convertir la respuesta JSON en un array
                                            $api_result = json_decode($api_response, true);

                                            // Devolver los resultados como una respuesta JSON
                                            header('Content-Type: application/json');
                                            echo json_encode($api_result);
                                            exit;
                                        }
                                    ?>
                                    <input type="search" type="text" id="searchInput" list="searchOptions"
                                        class="form-control" placeholder="Flight, Orig, Dest, Reg, Team Leader"
                                        aria-label="Search" />
                                    <datalist id="searchOptions"></datalist>
                                    <script>
                                    const searchInput = document.getElementById('searchInput');
                                    const searchOptions = document.getElementById('searchOptions');

                                    searchInput.addEventListener('input', function() {
                                        const query = searchInput.value;

                                        // Realizar una solicitud AJAX para obtener las opciones desde la API
                                        fetch(`<?php echo $_SERVER['PHP_SELF']; ?>?q=${query}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                // Limpiar opciones anteriores
                                                searchOptions.innerHTML = '';

                                                // Agregar las nuevas opciones al datalist
                                                data.forEach(optionValue => {
                                                    const option = document.createElement('option');
                                                    option.value = optionValue;
                                                    searchOptions.appendChild(option);
                                                });
                                            })
                                            .catch(error => console.error(
                                                'Error al cargar opciones desde la API: ' + error));
                                    });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 d-flex justify-content-center align-items-center">
                    <div class="text-center mt-xs">
                        <h1 class="text-white">Operations</h1>
                    </div>
                </div>

                <div class="col-12 d-md-none d-block">
                    <div class="row">
                        <div class="col-12 mt-3 d-flex justify-content-center">
                            <form method="POST" class="d-flex">
                                <input type="date" id="fechaPers" name="fechaPers" class="form-control"
                                    max="<?php echo date('Y-m-d'); ?>">
                                <button type="submit" class="btn ml-2" value="Search" id="search"
                                    style="background-color: #0A497B; color: gold;"><strong><i
                                            class="fa-solid fa-magnifying-glass"></i></strong></button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 my-2">
                            <div class="text-center">
                                <button type="button" class="btn" value="Today" id="obtenerFecha"
                                    style="background-color: #0A497B; color: gold;"><strong>Today</strong></button>
                                <script>
                                $(document).ready(function() {
                                    $("#obtenerFecha").click(function() {
                                        $.ajax({
                                            type: "POST",
                                            url: "obtener_fecha.php",
                                            success: function(data) {
                                                $("#resultadoFecha").html(data);
                                            }
                                        });
                                    });
                                });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="text-center">
                                <div class="form-outline">
                                    <input type="search" id="busquedaPersonalizada" class="form-control"
                                        placeholder="Flight, Orig, Dest, Reg, Team Leader" aria-label="Search" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $fechaPers = $_POST["fechaPers"];
//     echo "La fecha ingresada es: " . $fechaPers;
//     return $fechaPers;

// }
?>