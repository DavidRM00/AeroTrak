<table id="arrivalsTable" class="table table-striped display" style="width:100%" aria-label="Arrivals Table">
    <thead class="text-center tablename" style="color:gold;">
        <tr >
            <th style="color:#0A497B;">Flight Nº</th>
            <th style="color:#0A497B;">Orig</th>
            <th style="color:#0A497B;">ETA</th>
            <th style="color:#0A497B;">ATA</th>
            <th style="color:#0A497B;">STA</th>
            <th style="color:#0A497B;">TOB</th>
            <th style="color:#0A497B;">BAG</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php
        // Definimos la Access key de la API
        $queryString = http_build_query([
            'access_key' => '6b4c6989c16e86b39ecb01fb10bb13dc',
            'limit' => 50,
            'dep_iata' => 'SVQ'
        ]);

        // URL de la API con la query string
        $apiURL = sprintf('%s?%s', 'http://api.aviationstack.com/v1/flights', $queryString);

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
        foreach ($api_result['data'] as $arrival) {
            if (!$arrival['live']['is_ground']) {
                echo '<tr>';
                echo '<td>' . $arrival['flight']['iata'] . '</td>';
                echo '<td>' . $arrival['arrival']['iata'] . '</td>';
                echo '<td>' . substr($arrival['arrival']['scheduled'], 11, 5) . '</td>';
                echo '<td>' . substr($arrival['arrival']['estimated'], 11, 5) . '</td>';
                echo '<td>' . substr($arrival['arrival']['actual'], 11, 5) . '</td>';
                echo '<td>' . $arrival['arrival']['delay'] . '</td>';
                echo '<td>' . $arrival['arrival']['baggage'] . '</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
    <script>
    $(document).ready(function() {
        $('#arrivalsTable').DataTable({
            "lengthChange": false,
            "ordering": false,
            "searching": false,
            "scrollY": 500,
            "pageLength": 50,
            "paging": false,
            "info": false
        });
    });
    </script>
</table>
