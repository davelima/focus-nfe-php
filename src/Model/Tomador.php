<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Model;

class Tomador
{
    public function __construct(
        private string $razaoSocial,
        private string $email,
        private Endereco $endereco,
        private ?string $cnpj = null,
        private ?string $cpf = null
    ) {
    }

    /**
     * @return array<string, string|array<string|int>>
     */
    public function getData(): array
    {
        $data = [
            'razao_social' => $this->razaoSocial,
            'email' => $this->email,
            'endereco' => $this->endereco->getData()
        ];

        if ($this->cnpj) {
            $data['cnpj'] = $this->cnpj;
        }

        if ($this->cpf) {
            $data['cpf'] = $this->cpf;
        }

        return $data;
    }
}
