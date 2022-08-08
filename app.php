<?php

declare(strict_types=1);

use App\Core\ServiceContainer;
use App\Domain\Card\Service\CardService;
use App\Domain\Commission\Service\CommissionService;
use App\Domain\ExchangeRate\Service\ExchangeRateService;
use App\Domain\Transaction\Service\TransactionService;
use Symfony\Component\Dotenv\Dotenv;

require_once('./vendor/autoload.php');

(new Dotenv())->bootEnv('.env');

$container = ServiceContainer::buildContainer();

/** @var TransactionService $transactionService */
$transactionService = $container->get('transaction.service');
/** @var CardService $cardService */
$cardService = $container->get('card.service');
/** @var ExchangeRateService $exchangeRateService */
$exchangeRateService = $container->get('exchange_rate.service');
/** @var CommissionService $commissionService */
$commissionService = $container->get('commission.service');

try {
    $rates = $exchangeRateService->getEurRates();

    foreach ($transactionService->getTransactionsFromInput() as $transaction) {
        echo $commissionService->calculateCommission(
                $transaction->amount,
                $transaction->currency,
                (string)$rates[$transaction->currency],
                $cardService->isEuCard($transaction->bin)
            ) . PHP_EOL;
    }
} catch (Throwable $e) {
    echo $e->getMessage();
}