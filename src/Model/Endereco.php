<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Model;

class Endereco
{
    public function __construct(
        private string $bairro,
        private string $cep,
        private string $codigoMunicipio,
        private string $logradouro,
        private string|int $numero,
        private string $uf
    ) {
    }

    /**
     * @return array<string, string|int>
     */
    public function getData(): array
    {
        return [
            'bairro' => $this->bairro,
            'cep' => $this->cep,
            'codigo_municipio' => $this->codigoMunicipio,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'uf' => $this->uf
        ];
    }
}
