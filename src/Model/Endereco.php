<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Model;

class Endereco
{
    public function __construct(
        private string $logradouro,
        private string|int $numero,
        private string $uf,
        private ?string $codigoMunicipio = null,
        private ?string $bairro = null,
        private ?string $cep = null
    ) {
    }

    /**
     * @return array<string, string|int>
     */
    public function getData(): array
    {
        $result = [
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'uf' => $this->uf
        ];

        $optionalKeys = [
            'cep' => 'cep',
            'codigo_municipio' => 'codigoMunicipio',
            'bairro' => 'bairro'
        ];

        array_walk($optionalKeys, function ($label, $key) use (&$result)
        {
            if ($this->{$label}) {
                $result[$key] = $this->{$label};
            }
        });


        return $result;
    }
}
