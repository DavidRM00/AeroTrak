<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_date = date('Y-m-d');

    // Definir la query string con la Access key y la fecha de vuelo
    $queryString = http_build_query([
        'access_key' => '6b4c6989c16e86b39ecb01fb10bb13dc',
        'flight_date' => $flight_date
    ]);

    // URL de la API con la query string
    $apiURL = sprintf('%s?%s', 'http://api.aviationstack.com/v1/flights', $queryString);


    // Inicializar cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la API
    $api_response = curl_exec($ch);

    // Cerrar cURL
    curl_close($ch);

    // Convertir el JSON en un array
    $api_result = json_decode($api_response, true);

    // Mostrar los datos de los vuelos en la tabla
    // Antes de mostrar la tabla

    echo '<table>';
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
    echo '</table>';
}
?>