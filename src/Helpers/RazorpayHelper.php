<?php

namespace Queenshera\AdminPanel\Helpers;

class RazorpayHelper
{
    public $authorization = null;

    public function __construct()
    {
        $this->authorization = 'Authorization: Basic ' . base64_encode(config('razorpay.key') . ':' . config('razorpay.secret'));
    }

    public function createOrder($data)
    {
        $curl = curl_init(config('razorpay.url') . 'orders');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function allOrders()
    {
        $curl = curl_init('https://api.razorpay.com/v1/orders');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function fetchOrder($orderId)
    {
        $curl = curl_init('https://api.razorpay.com/v1/orders/' . $orderId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function fetchOrderPayments($orderId)
    {
        $curl = curl_init('https://api.razorpay.com/v1/orders/' . $orderId . '/payments');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function capturePayment($paymentId, $data)
    {
        $curl = curl_init('https://api.razorpay.com/v1/payments/' . $paymentId . '/capture');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function fetchPayment($paymentId)
    {
        $curl = curl_init('https://api.razorpay.com/v1/payments/' . $paymentId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function allSettlements()
    {
        $curl = curl_init('https://api.razorpay.com/v1/settlements');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function fetchSettlement($settlementId)
    {
        $curl = curl_init('https://api.razorpay.com/v1/payments/' . $settlementId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function createRefund($paymentId, $data)
    {
        $curl = curl_init('https://api.razorpay.com/v1/payments/' . $paymentId . '/refund');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function createInstantRefund($paymentId, $data)
    {
        $data['speed'] = 'optimum';

        $curl = curl_init('https://api.razorpay.com/v1/payments/' . $paymentId . '/refund');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function allRefunds()
    {
        $curl = curl_init('https://api.razorpay.com/v1/refunds');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function fetchRefund($refundId)
    {
        $curl = curl_init('https://api.razorpay.com/v1/refunds/' . $refundId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function createPaymentLink($data)
    {
        $curl = curl_init(config('razorpay.url') . 'payment_links');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function allPaymentLinks()
    {
        $curl = curl_init('https://api.razorpay.com/v1/payment_links');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function fetchPaymentLink($paymentLinkId)
    {
        $curl = curl_init('https://api.razorpay.com/v1/payment_links/' . $paymentLinkId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function cancelPaymentLink($paymentLinkId)
    {
        $curl = curl_init('https://api.razorpay.com/v1/payment_links/' . $paymentLinkId . '/cancel');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function createVirtualAccount($data)
    {
        $curl = curl_init(config('razorpay.url') . 'virtual_accounts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function allVirtualAccounts()
    {
        $curl = curl_init('https://api.razorpay.com/v1/virtual_accounts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function fetchVirtualAccount($virtualAccountId)
    {
        $curl = curl_init('https://api.razorpay.com/v1/virtual_accounts/' . $virtualAccountId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function fetchVirtualAccountPayments($virtualAccountId)
    {
        $curl = curl_init('https://api.razorpay.com/v1/virtual_accounts/' . $virtualAccountId . '/payments');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function cancelVirtualAccount($virtualAccountId)
    {
        $curl = curl_init('https://api.razorpay.com/v1/virtual_accounts/' . $virtualAccountId . '/close');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function bankPayout($data)
    {
        $curl = curl_init(config('razorpay.url') . 'payouts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function cardPayout($data)
    {
        $curl = curl_init(config('razorpay.url') . 'payouts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function upiPayout($data)
    {
        $curl = curl_init(config('razorpay.url') . 'payouts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function amazonPayout($data)
    {
        $curl = curl_init(config('razorpay.url') . 'payouts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function payoutLink($data)
    {
        $curl = curl_init(config('razorpay.url') . 'payouts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function allPayoutTransactions()
    {
        $curl = curl_init('https://api.razorpay.com/v1/transactions?account_number=' . config('razorpay.account'));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function allDisputes()
    {
        $curl = curl_init('https://api.razorpay.com/v1/disputes');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function fetchDispute($disputeId)
    {
        $curl = curl_init('https://api.razorpay.com/v1/disputes/' . $disputeId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function acceptDispute($disputeId)
    {
        $curl = curl_init(config('razorpay.url') . 'disputes/'.$disputeId.'/accept');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    public function contestDispute($disputeId,$data)
    {
        $curl = curl_init(config('razorpay.url') . 'disputes/'.$disputeId.'/contest');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }
}
