<?php
namespace Commissions;

use Commissions\{Transaction, TransactionCollection, NotFoundException, MalformatException};

class TransactionsReader
{
    /**
     * @throws NotFoundException if transactions path does not exist 
     * @throws MalformatException if transactions are not in JSON format 
     */
	public function read(string $transactionsPath): TransactionCollection
	{
        $transactionsJson = [];
        $content =  @file_get_contents($transactionsPath);
        if ($content === false) {
            throw new NotFoundException("Transactions file path does not exist. Path: {$transactionsPath}");
        }
        $transactionsJson = explode("\n",$content);

        $transactions = new TransactionCollection();
        foreach($transactionsJson as $transactionJson) {
            try {
                $transaction = json_decode($transactionJson, false, 512, JSON_THROW_ON_ERROR);
                $transactions->append(new Transaction($transaction->bin, $transaction->amount, $transaction->currency));
            } catch (\Exception $exception) {
                throw new MalformatException("Malformat transactions");
            }
        }
        
        return $transactions;
	}
}
