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

class PurchaseResponse extends AbstractResponse
{
    public function isSuccessful(): bool
    {
        return isset($this->data['code']) && $this->data['code'] === '00';
    }

    public function isRedirect(): true
    {
        return true;
    }

    /**
     * Gets the redirect target url.
     *
     * @return string
     */
    public function getRedirectUrl(): ?string
    {
        return $this->data['checkoutUrl'] ?? null;
    }

    /**
     * Get the redirect URL for the payment.
     *
     * @return string|null
     */
    public function getEmbedUrl(): ?string
    {
        if (! isset($this->data['checkoutUrl'])) {
            return null;
        }

        return $this->data['checkoutUrl'] . '/?embedded=true';
    }
}
