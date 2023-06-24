<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Enum;

enum NaturezaOperacao: int
{
    case TRIBUTACAO_NO_MUNICIPIO = 1;
    case TRIBUTACAO_FORA_DO_MUNICIPIO = 2;
    case ISENCAO = 3;
    case IMUNE = 4;
    case EXIGIBILIDADE_SUSPENSA_POR_DECISAO_JUDICIAL = 5;
    case EXIGIBILIDATE_SUSPENSA_POR_PROCEDIMENTO_ADMINISTRATIVO = 6;
}
