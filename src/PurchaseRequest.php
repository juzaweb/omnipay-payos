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

use Omnipay\Common\Message\AbstractRequest;
use PayOS\PayOS;

class PurchaseRequest extends AbstractRequest
{
    public function getData(): array
    {
        $this->validate('amount', 'orderCode');

        $orderCode = (int) $this->getOrderCode();
        $amount = $this->getParameter('amount') * 1;

        return [
            'orderCode' => $orderCode,
            'amount' => $amount,
            'returnUrl' => $this->getReturnUrl(),
            'cancelUrl' => $this->getCancelUrl(),
            'description' => sub_char($this->getDescription(), 25),
        ];
    }

    public function sendData($data): PurchaseResponse
    {
        $payOSClientId = $this->getClientId();
        $payOSApiKey = $this->getKey();
        $payOSChecksumKey = $this->getChecksumKey();

        $payOS = new PayOS($payOSClientId, $payOSApiKey, $payOSChecksumKey);
        $response = $payOS->createPaymentLink($data);

        return $this->response = new PurchaseResponse($this, $response);
    }

    public function setOrderCode($value)
    {
        return $this->setParameter('orderCode', $value);
    }

    public function getOrderCode()
    {
        return $this->getParameter('orderCode');
    }

    public function getClientId()
    {
        return $this->getParameter('clientId');
    }

    public function setClientId($value)
    {
        return $this->setParameter('clientId', $value);
    }

    public function setKey($value): static
    {
        return $this->setParameter('key', $value);
    }

    public function getKey()
    {
        return $this->getParameter('key');
    }

    public function setChecksumKey($value): static
    {
        return $this->setParameter('checksumKey', $value);
    }

    public function getChecksumKey()
    {
        return $this->getParameter('checksumKey');
    }
}
