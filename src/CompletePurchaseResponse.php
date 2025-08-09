<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://cms.juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\PayOs;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * Check if the transaction is successful.
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return isset($this->data['status'])
            && $this->data['status'] === 'PAID';
    }

    /**
     * Get the transaction reference (provided by the gateway).
     *
     * @return string|null
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['id'] ?? null;
    }

    /**
     * Get the message returned by the gateway.
     *
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->data['desc'] ?? null;
    }

    /**
     * Get the payment amount.
     *
     * @return string|null
     */
    public function getAmount(): ?string
    {
        return $this->data['data']['amount'] ?? null;

        if ($amount) {
            $amount = route($amount / config('payment.currency_conversion.VND'), 2);
        }

        return $amount;
    }

    /**
     * Check if the transaction is pending.
     *
     * @return bool
     */
    public function isPending(): bool
    {
        return ! isset($this->data['data']);
    }

    /**
     * Check if the transaction is canceled.
     *
     * @return bool
     */
    public function isCancelled(): bool
    {
        return isset($this->data['data']['status']) && $this->data['data']['status'] === 'CANCELLED';
    }
}
