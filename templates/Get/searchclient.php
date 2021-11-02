<?php

$listClients = array();

foreach ($clients as $clientsSingle) {

    $district = ($clientsSingle->district) ? '' . $clientsSingle->district . ' - ': '';

    $listClients['results'][] = array(

        'id' => $clientsSingle['id'],

        'text' => $clientsSingle['nome'],

    );

}

echo json_encode($listClients);

?>