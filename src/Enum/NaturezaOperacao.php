<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Enum;

enum NaturezaOperacao: int
{
    case TributacaoNoMunicipio = 1;
    case TributacaoForaDoMunicipio = 2;
    case Isencao = 3;
    case Imune = 4;
    case ExigibilidadeSuspensaPorDecisaoJudicial = 5;
    case ExigibilidateSuspensaPorProcedimentoAdministrativo = 6;
}
