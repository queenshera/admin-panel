<?php

namespace Queenshera\AdminPanel\Helpers;

use Carbon\Carbon;

/**
 * This class is used to integrate Razorpay payment gateway to project with minimal data
 */
class RazorpayHelper
{
    /**
     * @var string|null
     */
    private static $authorization = null;

    public function __construct()
    {
        RazorpayHelper::$authorization = 'Authorization: Basic ' . base64_encode(config('razorpay.key') . ':' . config('razorpay.secret'));
    }

    /**
     * This function is used to create new order
     *
     * @param $data
     * @return mixed
     */
    public static function createOrder($data)
    {
        $apiData['amount'] = $data['amount'];
        $apiData['currency'] = 'INR';
        $apiData['receipt'] = $data['receipt'] ?? '';
        $apiData['notes'] = $data['notes'] ?? json_decode('{}');

        $curl = curl_init(config('razorpay.url') . 'orders');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($apiData, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        return $result;
    }

    /**
     * This function is used to get list of all orders
     *
     * @return mixed
     */
    public static function allOrders()
    {
        $curl = curl_init(config('razorpay.url') . 'orders');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        $orders = $result['items'];

        return $orders;
    }

    /**
     * This function is used to get order details based on order ID
     *
     * @param $orderId
     * @return mixed
     */
    public static function fetchOrder($orderId)
    {
        $curl = curl_init(config('razorpay.url') . 'orders/' . $orderId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
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
    public static function fetchOrderPayments($orderId)
    {
        $curl = curl_init(config('razorpay.url') . 'orders/' . $orderId . '/payments');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        $payments = $result['items'];

        return $payments;
    }

    /**
     * This function is used to capture payment manually
     * @param $paymentId
     * @param $data
     * @return mixed
     */
    public static function capturePayment($paymentId, $data)
    {
        $data['currency'] = 'INR';

        $curl = curl_init(config('razorpay.url') . 'payments/' . $paymentId . '/capture');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
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
    public static function fetchPayment($paymentId)
    {
        $curl = curl_init(config('razorpay.url') . 'payments/' . $paymentId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
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
    public static function allSettlements()
    {
        $curl = curl_init(config('razorpay.url') . 'settlements');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        $settlements = $result['items'];

        return $settlements;
    }

    /**
     * This function is used to settlement details using settlement ID
     *
     * @param $settlementId
     * @return mixed
     */
    public static function fetchSettlement($settlementId)
    {
        $curl = curl_init(config('razorpay.url') . 'settlements/' . $settlementId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
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
    public static function createRefund($paymentId, $data)
    {
        $curl = curl_init(config('razorpay.url') . 'payments/' . $paymentId . '/refund');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
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
    public static function createInstantRefund($paymentId, $data)
    {
        $data['speed'] = 'optimum';

        $curl = curl_init(config('razorpay.url') . 'payments/' . $paymentId . '/refund');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
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
    public static function allRefunds()
    {
        $curl = curl_init(config('razorpay.url') . 'refunds');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        $refunds = $result['items'];

        return $refunds;
    }

    /**
     * This function is used to get refund details
     *
     * @param $refundId
     * @return mixed
     */
    public static function fetchRefund($refundId)
    {
        $curl = curl_init(config('razorpay.url') . 'refunds/' . $refundId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
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
    public static function createPaymentLink($data)
    {
        $customer['name'] = $data['name'] ?? '';
        $customer['email'] = $data['email'] ?? '';
        $customer['contact'] = $data['mobile'] ?? '';

        $notify['sms'] = true;
        $notify['email'] = true;

        $requestData['amount'] = $data['amount'];
        $requestData['notes'] = $data['notes'] ?? json_decode('{}');
        $requestData['customer'] = $customer;
        $requestData['notify'] = $notify;
        $requestData['reminder_enable'] = true;
        $requestData['description'] = $data['description'];

        $curl = curl_init(config('razorpay.url') . 'payment_links');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData, false));
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
    public static function allPaymentLinks()
    {
        $curl = curl_init(config('razorpay.url') . 'payment_links');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        $links = $result['payment_links'];

        return $links;
    }

    /**
     * This function is used to get payment link details
     *
     * @param $paymentLinkId
     * @return mixed
     */
    public static function fetchPaymentLink($paymentLinkId)
    {
        $curl = curl_init(config('razorpay.url') . 'payment_links/' . $paymentLinkId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
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
    public static function cancelPaymentLink($paymentLinkId)
    {
        $curl = curl_init(config('razorpay.url') . 'payment_links/' . $paymentLinkId . '/cancel');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
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
    public static function createVirtualAccount($data)
    {
        $requestData['receivers']['types'] = ['vpa', 'bank_account'];
        $requestData['description'] = $data['description'] ?? '';
        $requestData['notes'] = $data['notes'] ?? json_decode('{}');

        $customer['name'] = $data['name'] ?? '';
        $customer['email'] = $data['email'] ?? '';
        $customer['contact'] = $data['mobile'] ?? '';

        $requestData['customer'] = $customer;

        $curl = curl_init(config('razorpay.url') . 'virtual_accounts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData, false));
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
    public static function allVirtualAccounts()
    {
        $curl = curl_init(config('razorpay.url') . 'virtual_accounts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        $accounts = $result['items'];

        return $accounts;
    }

    /**
     * This function is used to fetch details of virtual account
     *
     * @param $virtualAccountId
     * @return mixed
     */
    public static function fetchVirtualAccount($virtualAccountId)
    {
        $curl = curl_init(config('razorpay.url') . 'virtual_accounts/' . $virtualAccountId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
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
    public static function fetchVirtualAccountPayments($virtualAccountId)
    {
        $curl = curl_init(config('razorpay.url') . 'virtual_accounts/' . $virtualAccountId . '/payments');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        $payments = $result['items'];

        return $payments;
    }

    /**
     * This function is used to cancel virtual account
     *
     * @param $virtualAccountId
     * @return mixed
     */
    public static function closeVirtualAccount($virtualAccountId)
    {
        $curl = curl_init(config('razorpay.url') . 'virtual_accounts/' . $virtualAccountId . '/close');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
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
    public static function createBankPayout($data)
    {
        $bankAccount['name'] = $data['name'];
        $bankAccount['ifsc'] = $data['bankIfscNo'];
        $bankAccount['account_number'] = $data['bankAcctNo'];

        $contact['name'] = $data['name'];
        $contact['email'] = $data['email'];
        $contact['contact'] = $data['mobile'];

        $fundAccount['account_type'] = 'bank_account';
        $fundAccount['bank_account'] = $bankAccount;
        $fundAccount['contact'] = $contact;

        $requestData['account_number'] = config('razorpay.account');
        $requestData['amount'] = $data['amount'];
        $requestData['currency'] = 'INR';
        $requestData['mode'] = $data['paymentMode'] ?? 'NEFT';
        $requestData['purpose'] = $data['paymentPurpose'] ?? 'payout';
        $requestData['fund_account'] = $fundAccount;
        $requestData['queue_if_low_balance'] = true;
        $requestData['reference_id'] = $data['referenceId'] ?? '';
        $requestData['narration'] = $data['narration'] ?? '';
        $requestData['notes'] = $data['notes'] ?? json_decode('{}');

        $curl = curl_init(config('razorpay.url') . 'payouts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData, false));
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
    public static function createUpiPayout($data)
    {
        $vpa['address'] = $data['vpaAddress'];

        $contact['name'] = $data['name'];
        $contact['email'] = $data['email'];
        $contact['contact'] = $data['mobile'];

        $fundAccount['account_type'] = 'vpa';
        $fundAccount['vpa'] = $vpa;
        $fundAccount['contact'] = $contact;

        $requestData['account_number'] = config('razorpay.account');
        $requestData['amount'] = $data['amount'];
        $requestData['currency'] = 'INR';
        $requestData['mode'] = 'UPI';
        $requestData['purpose'] = $data['paymentPurpose'] ?? 'payout';
        $requestData['fund_account'] = $fundAccount;
        $requestData['queue_if_low_balance'] = true;
        $requestData['reference_id'] = $data['referenceId'] ?? '';
        $requestData['narration'] = $data['narration'] ?? '';
        $requestData['notes'] = $data['notes'] ?? json_decode('{}');

        $curl = curl_init(config('razorpay.url') . 'payouts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData, false));
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
    public static function createAmazonWalletPayout($data)
    {
        $wallet['provider'] = 'amazonpay';
        $wallet['name'] = $data['name'];
        $wallet['email'] = $data['email'];
        $wallet['phone'] = $data['mobile'];

        $contact['name'] = $data['name'];
        $contact['email'] = $data['email'];
        $contact['contact'] = $data['mobile'];

        $fundAccount['account_type'] = 'wallet';
        $fundAccount['wallet'] = $wallet;
        $fundAccount['contact'] = $contact;

        $requestData['account_number'] = config('razorpay.account');
        $requestData['amount'] = $data['amount'];
        $requestData['currency'] = 'INR';
        $requestData['mode'] = 'amazonpay';
        $requestData['purpose'] = $data['paymentPurpose'] ?? 'payout';
        $requestData['fund_account'] = $fundAccount;
        $requestData['queue_if_low_balance'] = true;
        $requestData['reference_id'] = $data['referenceId'] ?? '';
        $requestData['narration'] = $data['narration'] ?? '';
        $requestData['notes'] = $data['notes'] ?? json_decode('{}');

        $curl = curl_init(config('razorpay.url') . 'payouts');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    /**
     * This function is used to get list of all payouts transactions
     *
     * @return mixed
     */
    public static function allPayoutTransactions()
    {
        $curl = curl_init(config('razorpay.url') . 'transactions?account_number=' . config('razorpay.account'));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        $transactions = $result['items'];

        return $transactions;
    }

    /**
     * This function is used to create payout link
     *
     * @param $data
     * @return mixed
     */
    public static function createPayoutLink($data)
    {
        $contact['name'] = $data['name'];
        $contact['email'] = $data['email'];
        $contact['contact'] = $data['mobile'];

        $requestData['account_number'] = config('razorpay.account');
        $requestData['contact'] = $contact;
        $requestData['amount'] = $data['amount'];
        $requestData['currency'] = 'INR';
        $requestData['purpose'] = $data['paymentPurpose'] ?? 'payout';
        $requestData['description'] = $data['description'] ?? '';
        $requestData['receipt'] = $data['receipt'] ?? '';
        $requestData['send_sms'] = true;
        $requestData['send_email'] = true;
        $requestData['notes'] = $data['notes'] ?? json_decode('{}');

        $curl = curl_init(config('razorpay.url') . 'payout-links');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData, false));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    /**
     * This function is used to get list of all payout links
     *
     * @return mixed
     */
    public static function allPayoutLinks()
    {
        $curl = curl_init(config('razorpay.url') . 'payout-links');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        $links = $result['items'];

        return $links;
    }

    /**
     * This function is used to get payout link details
     *
     * @param $payoutLinkId
     * @return mixed
     */
    public static function fetchPayoutLink($payoutLinkId)
    {
        $curl = curl_init(config('razorpay.url') . 'payout-links/' . $payoutLinkId);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    /**
     * This function is used to cancel payout link
     *
     * @param $payoutLinkId
     * @return mixed
     */
    public static function cancelPayoutLink($payoutLinkId)
    {
        $curl = curl_init(config('razorpay.url') . 'payout-links/' . $payoutLinkId . '/cancel');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', RazorpayHelper::$authorization));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }
}
