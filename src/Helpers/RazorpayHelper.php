<?php

namespace Queenshera\AdminPanel\Helpers;

/**
 * This class is used to integrate Razorpay payment gateway to project with minimal data
 */

class RazorpayHelper
{
    /**
     * @var string|null
     */
    public $authorization = null;

    public function __construct()
    {
        $this->authorization = 'Authorization: Basic ' . base64_encode(config('razorpay.key') . ':' . config('razorpay.secret'));
    }

    /**
     * This function is used to create new order
     *
     * @param $data
     * @return mixed
     */
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

    /**
     * This function is used to get list of all orders
     *
     * @return mixed
     */
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

    /**
     * This function is used to get order details based on order ID
     *
     * @param $orderId
     * @return mixed
     */
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

    /**
     * This function is used to get order payment details based on order ID
     *
     * @param $orderId
     * @return mixed
     */
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

    /**
     * This function is used to capture payment manually
     * @param $paymentId
     * @param $data
     * @return mixed
     */
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

    /**
     * This function is used to get payment details
     *
     * @param $paymentId
     * @return mixed
     */
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

    /**
     * This function is used to get list of all settlements
     *
     * @return mixed
     */
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

    /**
     * This function is used to settlement details using settlement ID
     *
     * @param $settlementId
     * @return mixed
     */
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

    /**
     * This function is used to process refund for specific payment using payment ID
     *
     * @param $paymentId
     * @param $data
     * @return mixed
     */
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

    /**
     * This function is used to process instant refund for specific payment using payment ID
     *
     * @param $paymentId
     * @param $data
     * @return mixed
     */
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

    /**
     * This function is used to get list of all refunds
     *
     * @return mixed
     */
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

    /**
     * This function is used to get refund details
     *
     * @param $refundId
     * @return mixed
     */
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

    /**
     * This function is used to create payment link
     * @param $data
     * @return mixed
     */
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

    /**
     * This function is used to get list of all payment links
     *
     * @return mixed
     */
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

    /**
     * This function is used to get payment link details
     *
     * @param $paymentLinkId
     * @return mixed
     */
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

    /**
     * This function is used to cancel payment link
     *
     * @param $paymentLinkId
     * @return mixed
     */
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

    /**
     * This function is used to create virtual account
     *
     * @param $data
     * @return mixed
     */
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

    /**
     * This function is used to get list of all virtual accounts
     *
     * @return mixed
     */
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

    /**
     * This function is used to fetch details of virtual account
     *
     * @param $virtualAccountId
     * @return mixed
     */
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

    /**
     * This function is used to get list of all payments made to virtual account
     *
     * @param $virtualAccountId
     * @return mixed
     */
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

    /**
     * This function is used to cancel virtual account
     *
     * @param $virtualAccountId
     * @return mixed
     */
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

    /**
     * This function is used to create payout to bank account
     *
     * @param $data
     * @return mixed
     */
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

    /**
     * This function is used to create payout to credit, debit or prepaid card
     *
     * @param $data
     * @return mixed
     */
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

    /**
     * This function is used to create payout to UPI ID
     * @param $data
     * @return mixed
     */
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

    /**
     * This function is used to create payout to amazon wallet
     * @param $data
     * @return mixed
     */
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

    /**
     * This function is used to create payout link
     *
     * @param $data
     * @return mixed
     */
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

    /**
     * This function is used to get list of all payouts
     *
     * @return mixed
     */
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

    /**
     * This function is used to get list of all disputes
     *
     * @return mixed
     */
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

    /**
     * This function is used to get dispute details
     *
     * @param $disputeId
     * @return mixed
     */
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

    /**
     * This function is used to accept a dispute against the payment
     *
     * @param $disputeId
     * @return mixed
     */
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

    /**
     * This function is used to contest dispute with explanations and supporting documents to submit evidences
     *
     * @param $disputeId
     * @param $data
     * @return mixed
     */
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
