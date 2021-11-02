<?php

$listServices = array();

foreach ($services as $serviceSingle) {

    switch ($serviceSingle['situation_id']) {

        case 1: $color = '#c39300'; break; // Agendado - Amarelo

        case 2: $color = '#acacac'; break; // Cancelado - Cinza

        case 3: $color = '#28a745'; break; // Faturado - Verde

        case 4: $color = '#acacac'; break; // Reprovado - Cinza

        case 5: $color = '#c39300'; break; // Em Contato - Amarelo

        case 6: $color = '#c39300'; break; // Em Andamento - Amarelo

        case 7: $color = '#007bff'; break; // Concluído - Azul

        case 8: $color = 'black'; break; // Retorno - Preto
        
        case 9: $color = '#dc3545'; break; // Retorno Emergencial - Vermelho
        
        case 10: $color = '#A500A8'; break; // Resgate - Roxo
        
        case 11: $color = '#FF0095'; break; // Reagendado (Aviso ao Cliente) - Rosa

        case 12: $color = '#ec5d00'; break; // Reagendado - Laranja

        default; $color = '#73E9FF'; break; // Sem Definição - Azul piscina

    }

    $district = ($serviceSingle->client->district) ? '' . $serviceSingle->client->district . ' - ': '';

    $listServices[] = array(

        'id' => $serviceSingle['id'],

        'title' => $district . $serviceSingle['title'],

        'start' => $serviceSingle['date'],

        'end' => $serviceSingle['date_end'],

        'color' => $color,

        'title_popup' => $district . $serviceSingle['title'],

        'client' => 'teste',

        'responsible' => 'Fábio Freitas',

        'type' => 'order',

        'resourceId' => $serviceSingle['technician_id'],

        'recurrent' => false

    );

}

echo json_encode($listServices);

?>