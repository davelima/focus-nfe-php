<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Enum;

enum Status: string
{
    case Pendente = 'pendente';
    case Autorizado = 'autorizado';
    case ErroAutorizacao = 'erro_autorizacao';
    case ProcessandoAutorizacao = 'processando_autorizacao';
    case Substituido = 'substituido';
}
