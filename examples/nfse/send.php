<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use Davelima\FocusNfePhp\Client\FocusClient;
use Davelima\FocusNfePhp\Document\Nfse;


$client = new FocusClient(
    environment: FocusClient::ENV_HOMOLOG,
    login:       'aaa',
    password:    'bbb'
);

$nfse = new Nfse(
    referencia: 'REF_TEST',
);


try {
    $emails = [
        'jimmy@johnson.com',
    ];
    $response = $client->send($nfse, $emails);
} catch (\Davelima\FocusNfePhp\Exception\InvalidDocumentException $e) {
    $violations = json_decode($e->getMessage());
    foreach ($violations as $violation) {
        echo $violation . PHP_EOL;
    }
} catch (\Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface $e) {
    print_r($e->getResponse()->getContent(false));
}
