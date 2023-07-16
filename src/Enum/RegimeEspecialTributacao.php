<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Enum;

enum RegimeEspecialTributacao: string
{
    case MicroempresaMunicipal = '1';
    case Estimativa = '2';
    case SociedadeDeProfissionais = '3';
    case Cooperativa = '4';
    case MEI = '5';
    case MEEPP = '6';
}
