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

class CompletePurchaseRequest extends AbstractRequest
{
    public function getData(): array
    {
        $this->validate('code');
        $data = $this->getParameter('data');

        $id = $this->getId() ?? $data['paymentLinkId'];

        return [
            'id' => $id,
        ];
    }

    public function sendData($data): CompletePurchaseResponse
    {
        $payOSClientId = $this->getParameter('clientId');
        $payOSApiKey = $this->getParameter('key');
        $payOSChecksumKey = $this->getParameter('checksumKey');

        $payOS = new PayOS($payOSClientId, $payOSApiKey, $payOSChecksumKey);
        $paymentInfo = $payOS->getPaymentLinkInformation($data['id']);

        return $this->response = new CompletePurchaseResponse($this, $paymentInfo);
    }

    public function setClientId($value): static
    {
        return $this->setParameter('clientId', $value);
    }

    public function getClientId()
    {
        return $this->getParameter('clientId');
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

    public function setCode($value): static
    {
        return $this->setParameter('code', $value);
    }

    public function getCode()
    {
        return $this->getParameter('code');
    }

    public function setId($value): static
    {
        return $this->setParameter('id', $value);
    }

    public function getId()
    {
        return $this->getParameter('id');
    }

    public function setData($value): static
    {
        return $this->setParameter('data', $value);
    }
}
