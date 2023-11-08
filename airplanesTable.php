<table id="airplanesTable" class="table table-striped display" style="width:100%" aria-label="Airplanes Table">
    <thead class="text-center">
        <tr>
            <th style="color:#0A497B;">Airplane</th>
            <th style="color:#0A497B;">Flight Status</th>
            <th style="color:#0A497B;">Reg</th>
            <th style="color:#0A497B;">A/C TYPE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Definimos la Access key de la API
            $queryString = http_build_query([
                'access_key' => '6b4c6989c16e86b39ecb01fb10bb13dc',
                'limit' => 100,
                'dep_iata' => 'SVQ'
            ]);

            // URL de la API con la query string
            $apiURL = sprintf('%s?%s', 'http://api.aviationstack.com/v1/airplanes', $queryString);

            // Inicializamos cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Ejecutamos la API
            $api_response = curl_exec($ch);

            // Cerramos cURL
            curl_close($ch);

            // Convertimos el JSON en un array
            $api_result = json_decode($api_response, true);

            // Mostramos los datos de los vuelos en la tabla
            foreach ($api_result['data'] as $flight) {
                if (!$flight['live']['is_ground']) {
                    echo '<tr>';
                    echo '<td>' . $flight['production_line'] . '</td>';
                    echo '<td>' . $flight['plane_status'] . '</td>';
                    echo '<td>' . $flight['icao_code_hex'] . '</td>';
                    echo '<td>' . $flight['model_code'] . '</td>';
                    echo '</tr>';
                }
            }
        ?>
    </tbody>
    <script>
    $(document).ready(function() {
        $('#airplanesTable').DataTable({
            "lengthChange" : false,
            "ordering": true,
            "order": [1, "Desc"],
            "searching": false,
            "scrollY": 410,
            "pageLength": 25
        });
    });
    </script>
</table>