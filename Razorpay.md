# Razorpay Setup

Read up here for getting started and understanding the setup of Razorpay payment service

## Configuration

- Ensure you have created api key and secret from Razorpay dashboard.
- If you did not create it yet, you can do so by following [this](https://razorpay.com/docs/api/authentication/#generate-api-keys) guide.
- Add your API key details to .env file

## You can call any function of RazorpayHelper class for ordering, payment capture, refund, settlements and many more.

#### Create new order

```
$response = RazorpayHelper::createOrder($data);
```

Request payload

```
{
    "amount":100,
    "receipt":"receipt#1",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    }
}
```

Amount provided in request payload should be in paise only.

e.g. for Rs. 250 amount should be 25000, for Rs.100.56 amount will be 10056 and for Rs. 23.5 amount will be 2350

Response data

```
{
    "id":"order_LiP3BRCNF4ztOB",
    "entity":"order",
    "amount":100,
    "amount_paid":0,
    "amount_due":100,
    "currency":"INR",
    "receipt":"",
    "offer_id":null,
    "status":"created",
    "attempts":0,
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "created_at":1682508403
}
```

#### Get list of all orders

```
$response = RazorpayHelper::allOrders();
```

Response data

```
[
    {
        "id":"order_LiP3ORSPcCvMNp",
        "entity":"order",
        "amount":100,
        "amount_paid":0,
        "amount_due":100,
        "currency":"INR",
        "receipt":"",
        "offer_id":null,
        "status":"created",
        "attempts":0,
        "notes":{
            "key1":"value1",
            "key2":"value2"
        },
        "created_at":1682508415
    },
    {
        "id":"order_LiP3BRCNF4ztOB",
        "entity":"order",
        "amount":100,
        "amount_paid":0,
        "amount_due":100,
        "currency":"INR",
        "receipt":"",
        "offer_id":null,
        "status":"created",
        "attempts":0,
        "notes":{
            "key1":"value1",
            "key2":"value2"
        },
        "created_at":1682508403
    }
]
```

#### Fetch order details using orderId

```
$response = RazorpayHelper::fetchOrder($orderId);
```

Response data

```
{
    "id":"order_LiP3BRCNF4ztOB",
    "entity":"order",
    "amount":100,
    "amount_paid":0,
    "amount_due":100,
    "currency":"INR",
    "receipt":"",
    "offer_id":null,
    "status":"created",
    "attempts":0,
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "created_at":1682508403
}
```

#### Get all payments made for a specific order

```
$response = RazorpayHelper::fetchOrderPayments($orderId);
```

Response data

```
[
    {
        "id":"pay_L6n59OdRkSR0mc",
        "entity":"payment",
        "amount":100,
        "currency":"INR",
        "status":"captured",
        "order_id":"order_L6n4vJmCesAjEk",
        "invoice_id":null,
        "international":false,
        "method":"netbanking",
        "amount_refunded":0,
        "refund_status":null,
        "captured":true,
        "description":"Order #EAD9D8B88B",
        "card_id":null,
        "bank":"KKBK",
        "wallet":null,
        "vpa":null,
        "email":"test@payment.com",
        "contact":"+919876543210",
        "notes":[],
        "fee":0,
        "tax":0,
        "error_code":null,
        "error_description":null,
        "error_source":null,
        "error_step":null,
        "error_reason":null,
        "acquirer_data":{
            "bank_transaction_id":"1234567"
        },
        "created_at":1682509452
    }
]
```

#### Capture payment manually

```
$response = RazorpayHelper::capturePayment($paymentId, $data);
```

Request payload

```
{
    "amount":100,
}
```

Response data

```

```

#### Fetch payment details

```
$response = RazorpayHelper::fetchPayment($paymentId);
```

Response data

```
{
    "id":"pay_L6n59OdRkSR0mc",
    "entity":"payment",
    "amount":100,
    "currency":"INR",
    "status":"captured",
    "order_id":"order_L6n4vJmCesAjEk",
    "invoice_id":null,
    "international":false,
    "method":"netbanking",
    "amount_refunded":0,
    "refund_status":null,
    "captured":true,
    "description":"Order #EAD9D8B88B",
    "card_id":null,
    "bank":"KKBK",
    "wallet":null,
    "vpa":null,
    "email":"test@payment.com",
    "contact":"+919876543210",
    "notes":[],
    "fee":0,
    "tax":0,
    "error_code":null,
    "error_description":null,
    "error_source":null,
    "error_step":null,
    "error_reason":null,
    "acquirer_data":{
        "bank_transaction_id":"1234567"
    },
    "created_at":1682509452
}
```

#### Get list of all settlements

```
$response = RazorpayHelper::allSettlements();
```

Response data

```
[
    {
        "id":"setl_LFmTO4e2eTRdxB",
        "entity":"settlement",
        "amount":97400,
        "status":"processed",
        "fees":0,
        "tax":0,
        "utr":"cfkqujvljiqdbhc7qee0",
        "created_at":1676259026
    },
    {
        "id":"setl_LEj39VjsncjrFy",
        "entity":"settlement",
        "amount":97400,
        "status":"processed",
        "fees":0,
        "tax":0,
        "utr":"cfj2mlrlurf981e54e60",
        "created_at":1676028631
    },
    {
        "id":"setl_LCDfJxOH8iFPQn",
        "entity":"settlement",
        "amount":194800,
        "status":"processed",
        "fees":0,
        "tax":0,
        "utr":"cfet3ivmfudb48gpk37g",
        "created_at":1675481427
    }
]
```

#### Fetch settlement details using settlementId

```
$response = RazorpayHelper::fetchSettlement($settlementId);
```

Response data

```
{
    "id":"setl_LFmTO4e2eTRdxB",
    "entity":"settlement",
    "amount":97400,
    "status":"processed",
    "fees":0,
    "tax":0,
    "utr":"cfkqujvljiqdbhc7qee0",
    "created_at":1676259026
}
```

#### Refund payment amount to customer with normal flow (5-7 working days)

```
$response = RazorpayHelper::createRefund($paymentId, $data);
```

Request payload

```
{
    "amount":100,
}
```

Response data

```

```

#### Refund payment amount to customer with instant flow

```
$response = RazorpayHelper::createInstantRefund($paymentId, $data);
```

Request payload

```
{
    "amount":100,
}
```

Response data

```

```

#### Get list all refunds

```
$response = RazorpayHelper::allRefunds();
```

Response data

```
[
    {
        "id":"rfnd_L3YqPCbLFPx8fq",
        "entity":"refund",
        "amount":100,
        "currency":"INR",
        "payment_id":"pay_L1ZydpfWbzDDh5",
        "notes":[],
        "receipt":null,
        "acquirer_data":{
            "arn":"10000000000000"
        },
        "created_at":1673590949,
        "batch_id":null,
        "status":"processed",
        "speed_processed":"normal",
        "speed_requested":"normal"
    },
    {
        "id":"rfnd_L3YpcoVWUSXMvU",
        "entity":"refund",
        "amount":100,
        "currency":"INR",
        "payment_id":"pay_L1a09Cjsek9Ouw",
        "notes":[],
        "receipt":null,
        "acquirer_data":{
            "arn":"10000000000000"
        },
        "created_at":1673590905,
        "batch_id":null,
        "status":"processed",
        "speed_processed":"normal",
        "speed_requested":"normal"
    }
]
```

#### Fetch refund details

```
$response = RazorpayHelper::fetchRefund($refundId);
```

Response data

```
{
    "id":"rfnd_L3YpcoVWUSXMvU",
    "entity":"refund",
    "amount":100,
    "currency":"INR",
    "payment_id":"pay_L1a09Cjsek9Ouw",
    "notes":[],
    "receipt":null,
    "acquirer_data":{
        "arn":"10000000000000"
    },
    "created_at":1673590905,
    "batch_id":null,
    "status":"processed",
    "speed_processed":"normal",
    "speed_requested":"normal"
}
```

#### Create payment link

```
$response = RazorpayHelper::createPaymentLink($data);
```

Request payload

```
{
    "name":"Test User",
    "email":"test@gmail.com",
    "mobile":"919876543210",
    "amount":100,
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "description":"Test transaction"
}
```

Response data

```
{
    "accept_partial":false,
    "amount":100,
    "amount_paid":0,
    "cancelled_at":0,
    "created_at":1682778028,
    "currency":"INR",
    "customer":{
        "contact":"919876543210",
        "email":"test@gmail.com",
        "name":"Test User",
    },
    "description":"Test transaction"
    "expire_by":0,
    "expired_at":0,
    "first_min_partial_amount":0,
    "id":"plink_Ljdc56paDHMPqY",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "notify":{
        "email":true,
        "sms":true,
        "whatsapp":false
    },
    "payments":null,
    "reference_id":"",
    "reminder_enable":true,
    "reminders":[],
    "short_url":"https:\/\/rzp.io\/i\/et05INn",
    "status":"created",
    "updated_at":1682778028,
    "upi_link":false,
    "user_id":""
}
```

#### Get list of all payment links

```
$response = RazorpayHelper::allPaymentLinks();
```

Response data

```
[
    {
        "accept_partial":false,
        "amount":100,
        "amount_paid":0,
        "cancelled_at":0,
        "created_at":1682778094,
        "currency":"INR",
        "customer":{
            "contact":"919876543210",
            "email":"test@gmail.com",
            "name":"Test User",
        },
        "description":"Test transaction"
        "expire_by":0,
        "expired_at":0,
        "first_min_partial_amount":0,
        "id":"plink_LjddFPfzj35kzO",
        "notes":{
            "key1":"value1",
            "key2":"value2"
        },
        "notify":{
            "email":true,
            "sms":true,
            "whatsapp":false
        },
        "payments":null,
        "reference_id":"",
        "reminder_enable":true,
        "reminders":[],
        "short_url":"https:\/\/rzp.io\/i\/xfVBP7r",
        "status":"created",
        "updated_at":1682778094,
        "upi_link":false,
        "user_id":""
    },
    {
        "accept_partial":false,
        "amount":100,
        "amount_paid":0,
        "cancelled_at":0,
        "created_at":1682778028,
        "currency":"INR",
        "customer":{
            "contact":"919876543210",
            "email":"test@gmail.com",
            "name":"Test User",
        },
        "description":"Test transaction"
        "expire_by":0,
        "expired_at":0,
        "first_min_partial_amount":0,
        "id":"plink_Ljdc56paDHMPqY",
        "notes":{
            "key1":"value1",
            "key2":"value2"
        },
        "notify":{
            "email":true,
            "sms":true,
            "whatsapp":false
        },
        "payments":null,
        "reference_id":"",
        "reminder_enable":true,
        "reminders":[],
        "short_url":"https:\/\/rzp.io\/i\/et05INn",
        "status":"created",
        "updated_at":1682778028,
        "upi_link":false,
        "user_id":""
    }
]
```

#### Fetch payment link details

```
$response = RazorpayHelper::fetchPaymentLink($paymentLinkId);
```

Response data

```
{
    "accept_partial":false,
    "amount":100,
    "amount_paid":0,
    "cancelled_at":0,
    "created_at":1682778028,
    "currency":"INR",
    "customer":{
        "contact":"919876543210",
        "email":"test@gmail.com",
        "name":"Test User",
    },
    "description":"Test transaction"
    "expire_by":0,
    "expired_at":0,
    "first_min_partial_amount":0,
    "id":"plink_Ljdc56paDHMPqY",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "notify":{
        "email":true,
        "sms":true,
        "whatsapp":false
    },
    "payments":null,
    "reference_id":"",
    "reminder_enable":true,
    "reminders":[],
    "short_url":"https:\/\/rzp.io\/i\/et05INn",
    "status":"created",
    "updated_at":1682778028,
    "upi_link":false,
    "user_id":""
}
```

#### Cancel payment link

```
$response = RazorpayHelper::cancelPaymentLink($paymentLinkId);
```

Response data

```
{
    "accept_partial":false,
    "amount":100,
    "amount_paid":0,
    "cancelled_at":1682782319,
    "created_at":1682776841,
    "currency":"INR",
    "customer":{
        "contact":"919876543210",
        "email":"test@gmail.com",
        "name":"Test User",
    },
    "description":"",
    "expire_by":0,
    "expired_at":0,
    "first_min_partial_amount":0,
    "id":"plink_LjdHBacjjpEdEQ",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "notify":{
        "email":true,
        "sms":true,
        "whatsapp":false
    },
    "payments":[],
    "reference_id":"",
    "reminder_enable":false,
    "reminders":[],
    "short_url":"https:\/\/rzp.io\/i\/kHosdiCB",
    "status":"cancelled",
    "updated_at":1682782319,
    "upi_link":false,
    "user_id":""
}
```

#### Create virtual account

```
$response = RazorpayHelper::createVirtualAccount($data);
```

Request payload

```
{
    "name":"Test User",
    "email":"test@gmail.com",
    "mobile":"919876543210",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "description":"Test transaction"
}
```

Response data

```
{
    "id":"va_LjgEnVJWjcDpOr",
    "name":"Queenshera Infotech",
    "entity":"virtual_account",
    "status":"active",
    "description":"Test transaction",
    "amount_expected":null,
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "amount_paid":0,
    "customer_id":"cust_LjgEnSSFghkK0B",
    "receivers":[
        {
            "id":"ba_LjgEnkSJNJGyWM",
            "entity":"bank_account",
            "ifsc":"RAZR0000001",
            "bank_name":null,
            "name":"Queenshera Infotech",
            "notes":[],
            "account_number":"1112220021711239"
        },
        {
            "id":"vpa_LjgEnamhywDX1b",
            "entity":"vpa",
            "username":"rzr.payto000003384477265",
            "handle":"icic",
            "address":"rzr.payto000003384477265@icic"
        }
    ],
    "close_by":null,
    "closed_at":null,
    "created_at":1682787270
}
```

#### Get list of all virtual accounts

```
$response = RazorpayHelper::allVirtualAccounts();
```

Response data

```
[
    {
        "id":"va_LjgEnVJWjcDpOr",
        "name":"Queenshera Infotech",
        "entity":"virtual_account",
        "status":"active",
        "description":"Test transaction",
        "amount_expected":null,
        "notes":{
            "key1":"value1",
            "key2":"value2"
        },
        "amount_paid":0,
        "customer_id":"cust_LjgEnSSFghkK0B",
        "receivers":[
            {
                "id":"ba_LjgEnkSJNJGyWM",
                "entity":"bank_account",
                "ifsc":"RAZR0000001",
                "bank_name":null,
                "name":"Queenshera Infotech",
                "notes":[],
                "account_number":"1112220021711239"
            },
            {
                "id":"vpa_LjgEnamhywDX1b",
                "entity":"vpa",
                "username":"rzr.payto000003384477265",
                "handle":"icic",
                "address":"rzr.payto000003384477265@icic"
            }
        ],
        "close_by":null,
        "closed_at":null,
        "created_at":1682787270
    },
    {
        "id":"va_LjgERqBuktLxJQ",
        "name":"Queenshera Infotech",
        "entity":"virtual_account",
        "status":"active",
        "description":"Test transaction",
        "amount_expected":null,
        "notes":{
            "key1":"value1",
            "key2":"value2"
        },
        "amount_paid":0,
        "customer_id":"cust_LjfyvzN39Vy21j",
        "receivers":[
            {
                "id":"ba_LjgES6KPw4pvXp",
                "entity":"bank_account",
                "ifsc":"RAZR0000001",
                "bank_name":null,
                "name":"Queenshera Infotech",
                "notes":[],
                "account_number":"1112220013503579"
            },
            {
                "id":"vpa_LjgERwp8ItEkbT",
                "entity":"vpa",
                "username":"rzr.payto000005025309598",
                "handle":"icic",
                "address":"rzr.payto000005025309598@icic"
            }
        ],
        "close_by":null,
        "closed_at":null,
        "created_at":1682787251
    }
]
```

#### Fetch virtual account details

```
$response = RazorpayHelper::fetchVirtualAccount($virtualAccountId);
```

Response data

```
{
    "id":"va_LjgERqBuktLxJQ",
    "name":"Queenshera Infotech",
    "entity":"virtual_account",
    "status":"active",
    "description":"Test transaction",
    "amount_expected":null,
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "amount_paid":0,
    "customer_id":"cust_LjfyvzN39Vy21j",
    "receivers":[
        {
            "id":"ba_LjgES6KPw4pvXp",
            "entity":"bank_account",
            "ifsc":"RAZR0000001",
            "bank_name":null,
            "name":"Queenshera Infotech",
            "notes":[],
            "account_number":"1112220013503579"
        },
        {
            "id":"vpa_LjgERwp8ItEkbT",
            "entity":"vpa",
            "username":"rzr.payto000005025309598",
            "handle":"icic",
            "address":"rzr.payto000005025309598@icic"
        }
    ],
    "close_by":null,
    "closed_at":null,
    "created_at":1682787251
}
```

#### Fetch payments to virtual account

```
$response = RazorpayHelper::fetchVirtualAccountPayments($virtualAccountId);
```

Response data

```
[
    {
        "id":"pay_LjkptKYpLTgAVY",
        "entity":"payment",
        "amount":200,
        "currency":"INR",
        "status":"captured",
        "order_id":null,
        "invoice_id":null,
        "international":false,
        "method":"bank_transfer",
        "amount_refunded":0,
        "refund_status":null,
        "captured":true,
        "description":"",
        "card_id":null,
        "bank":null,
        "wallet":null,
        "vpa":null,
        "email":"test@gmail.com",
        "contact":"+919876543210",
        "customer_id":"cust_LjgEnSSFghkK0B",
        "notes":[],
        "fee":2,
        "tax":0,
        "error_code":null,
        "error_description":null,
        "error_source":null,
        "error_step":null,
        "error_reason":null,
        "acquirer_data":[],
        "created_at":1682803464
    },
    {
        "id":"pay_Ljkphfz3OJ224A",
        "entity":"payment",
        "amount":100,
        "currency":"INR",
        "status":"captured",
        "order_id":null,
        "invoice_id":null,
        "international":false,
        "method":"bank_transfer",
        "amount_refunded":0,
        "refund_status":null,
        "captured":true,
        "description":"",
        "card_id":null,
        "bank":null,
        "wallet":null,
        "vpa":null,
        "email":"test@gmail.com",
        "contact":"+919876543210",
        "customer_id":"cust_LjgEnSSFghkK0B",
        "notes":[],
        "fee":1,
        "tax":0,
        "error_code":null,
        "error_description":null,
        "error_source":null,
        "error_step":null,
        "error_reason":null,
        "acquirer_data":[],
        "created_at":1682803453
    }
]
```

#### close virtual account

```
$response = RazorpayHelper::closeVirtualAccount($virtualAccountId);
```

Response data

```
{
    "id":"va_LjgERqBuktLxJQ",
    "name":"Queenshera Infotech",
    "entity":"virtual_account",
    "status":"closed",
    "description":"Test transaction",
    "amount_expected":null,
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "amount_paid":0,
    "customer_id":"cust_LjfyvzN39Vy21j",
    "receivers":[
        {
            "id":"ba_LjgES6KPw4pvXp",
            "entity":"bank_account",
            "ifsc":"RAZR0000001",
            "bank_name":null,
            "name":"Queenshera Infotech",
            "notes":[],
            "account_number":"1112220013503579"
        },
        {
            "id":"vpa_LjgERwp8ItEkbT",
            "entity":"vpa",
            "username":"rzr.payto000005025309598",
            "handle":"icic",
            "address":"rzr.payto000005025309598@icic"
        }
    ],
    "close_by":null,
    "closed_at":1682793596,
    "created_at":1682787251
}
```

#### Create bank account payout

```
$response = RazorpayHelper::createBankPayout($data);
```

Request payload

```
{
    "name":"Test User",
    "email":"test@gmail.com",
    "mobile":"919876543210",
    "amount":100,
    "bankIfscNo":"SBIN0001234",
    "bankAcctNo":"112233445566",
    "paymentMode":"IMPS",
    "paymentPurpose":"payout",
    "referenceId":"#12345",
    "narration":"Test payment",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    }
}
```

Response Data

```
{
    "id":"pout_LjtUK5sVswMQH6",
    "entity":"payout",
    "fund_account_id":"fa_LjtPacwkE33zve",
    "fund_account":{
        "id":"fa_LjtPacwkE33zve",
        "entity":"fund_account",
        "contact_id":"cont_LjtP87KB5WZD6x",
        "contact":{
            "id":"cont_LjtP87KB5WZD6x",
            "entity":"contact",
            "name":"Test User",
            "contact":"919876543210",
            "email":"test@gmail.com",
            "type":null,
            "reference_id":null,
            "batch_id":null,
            "active":true,
            "notes":[],
            "created_at":1682833638
        },
        "account_type":"bank_account",
        "bank_account":{
            "ifsc":"SBIN0001234",
            "bank_name":"State Bank of India",
            "name":"Test User",
            "notes":[],
            "account_number":"112233445566"
        },
        "batch_id":null,
        "active":true,
        "created_at":1682833664
    },
    "amount":100,
    "currency":"INR",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "fees":0,
    "tax":0,
    "status":"processing",
    "purpose":"payout",
    "utr":null,
    "mode":"IMPS",
    "reference_id":"#12345",
    "narration":"Test payment",
    "batch_id":null,
    "failure_reason":null,
    "created_at":1682833933,
    "fee_type":"free_payout",
    "status_details":{
        "reason":null,
        "description":null,
        "source":null
    },
    "merchant_id":"DgbhL0vZrbseAi",
    "status_details_id":null
}
```

#### Create UPI payout

```
$response = RazorpayHelper::createUpiPayout($data);
```

Request payload

```
{
    "name":"Test User",
    "email":"test@gmail.com",
    "mobile":"919876543210",
    "amount":100,
    "vpaAddress":"queenshera@paytm"
    "paymentPurpose":"payout",
    "referenceId":"#12345",
    "narration":"Test payment",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    }
    
}
```

Response Data

```
{
    "id":"pout_LjtyoMCHVARKjw",
    "entity":"payout",
    "fund_account_id":"fa_LjtyoDJd8twUIp",
    "fund_account":{
        "id":"fa_LjtyoDJd8twUIp",
        "entity":"fund_account",
        "contact_id":"cont_LjtP87KB5WZD6x",
        "contact":{
            "id":"cont_LjtP87KB5WZD6x",
            "entity":"contact",
            "name":"Test User",
            "contact":"919876543210",
            "email":"test@gmail.com",
            "type":null,
            "reference_id":null,
            "batch_id":null,
            "active":true,
            "notes":[],
            "created_at":1682833638
        },
        "account_type":"vpa",
        "batch_id":null,
        "vpa":{
            "username":"queenshera",
            "handle":"paytm",
            "address":"queenshera@paytm"
        },
        "active":true,
        "created_at":1682835665
    },
    "amount":100,
    "currency":"INR",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "fees":0,
    "tax":0,
    "status":"processing",
    "purpose":"refund",
    "utr":null,
    "mode":"UPI",
    "reference_id":"#12345",
    "narration":"Test payment",
    "batch_id":null,
    "failure_reason":null,
    "created_at":1682835665,
    "fee_type":"free_payout",
    "status_details":{
        "reason":null,
        "description":null,
        "source":null
    },
    "merchant_id":"DgbhL0vZrbseAi",
    "status_details_id":null
}
```

#### Create Amazon wallet payout

```
$response = RazorpayHelper::createAmazonWalletPayout($data);
```

Request payload

```
{
    "name":"Test User",
    "email":"test@gmail.com",
    "mobile":"+919876543210",
    "amount":100,
    "paymentPurpose":"payout",
    "referenceId":"#12345",
    "narration":"Test payment",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    }
}
```

Response Data

```
{
    "id":"pout_LjunhK4fFiOQlG",
    "entity":"payout",
    "fund_account_id":"fa_LjunhBTOwk1KGy",
    "fund_account":{
        "id":"fa_LjunhBTOwk1KGy",
        "entity":"fund_account",
        "contact_id":"cont_Ljunh6ayYNQpYw",
        "contact":{
            "id":"cont_Ljunh6ayYNQpYw",
            "entity":"contact",
            "name":"Test User",
            "contact":"+919876543210",
            "email":"test@gmail.com",
            "type":null,
            "reference_id":null,
            "batch_id":null,
            "active":true,
            "notes":[],
            "created_at":1682838555
        },
        "account_type":"wallet",
        "batch_id":null,
        "active":true,
        "created_at":1682838555,
        "wallet":{
            "phone":"+919876543210",
            "provider":"amazonpay",
            "email":"test@gmail.com",
            "name":"Test User"
        }
    },
    "amount":100,"currency":"INR",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    },
    "fees":0,
    "tax":0,
    "status":"processing",
    "purpose":"refund",
    "utr":null,
    "mode":"amazonpay",
    "reference_id":"#12345",
    "narration":"Test payment",
    "batch_id":null,
    "failure_reason":null,
    "created_at":1682838555,
    "fee_type":null,
    "status_details":{
        "reason":null,
        "description":null,
        "source":null
    },
    "merchant_id":"DgbhL0vZrbseAi",
    "status_details_id":null
}
```

#### Get all payout transactions

Response Data

```
[
    {
        "id":"txn_Ljunhfj4GnCKBj",
        "entity":"transaction",
        "account_number":"2323230007396294",
        "amount":100,
        "currency":"INR",
        "credit":0,
        "debit":100,
        "balance":209600,
        "created_at":1682838555,
        "source":{
            "id":"pout_LjunhK4fFiOQlG",
            "entity":"payout",
            "fund_account_id":"fa_LjunhBTOwk1KGy",
            "amount":100,
            "notes":{
                "key1":"value1",
                "key2":"value2"
            },
            "fees":0,
            "tax":0,
            "status":"processing",
            "utr":null,
            "mode":"amazonpay",
            "created_at":1682838555,
            "fee_type":null
        }
    },
    {
        "id":"txn_LjtPb0lJcmZpYx",
        "entity":"transaction",
        "account_number":"2323230007396294",
        "amount":100,
        "currency":"INR",
        "credit":0,
        "debit":100,
        "balance":209700,
        "created_at":1682833664,
        "source":{
            "id":"pout_LjtPak9mzBe0l5",
            "entity":"payout",
            "fund_account_id":"fa_LjtPacwkE33zve",
            "amount":100,
            "notes":{
                "key1":"value1",
                "key2":"value2"
            },
            "fees":0,
            "tax":0,
            "status":"processed",
            "utr":"LjtPak9mzBe0l5",
            "mode":"NEFT",
            "created_at":1682833664,
            "fee_type":"free_payout"
        }
    }
]
```

#### Create payout link

```
$response = RazorpayHelper::createPayoutLink($data);
```

Request payload

```
{
    "name":"Test User",
    "email":"test@gmail.com",
    "mobile":"+919876543210",
    "amount":100,
    "paymentPurpose":"cashback",
    "description":"Test payment",
    "receipt":"#12345"
    "notes":{
        "key1":"value1",
        "key2":"value2"
    }
}
```

Response Data

```
{
    "id":"poutlk_4Evg20JQGuZx8S",
    "entity":"payout_link",
    "contact":{
        "name":"Test User",
        "contact":"+919876543210",
        "email":"test@gmail.com"
    },
    "purpose":"cashback",
    "status":"issued",
    "amount":100,
    "currency":"INR",
    "description":"Test payment",
    "short_url":"https:\/\/rzp.io\/i\/EBdSDykG9c",
    "created_at":1682839716,
    "contact_id":"cont_Ljv88MRbiLMDBZ",
    "send_sms":true,
    "send_email":true,
    "fund_account_id":null,
    "cancelled_at":null,
    "attempt_count":0,
    "user":null,
    "user_id":null,
    "receipt":"#12345",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    }
}
```

#### Get all payout links

```
$response = RazorpayHelper::allPayoutLinks();
```

Response Data

```
[
    {
        "id":"poutlk_8m1m20JSI0Eeng",
        "entity":"payout_link",
        "contact":{
            "name":"Test User",
            "contact":"+919876543210",
            "email":"test@gmail.com"
        },
        "purpose":"cashback",
        "status":"issued",
        "amount":100,
        "currency":"INR",
        "description":"Test payment",
        "short_url":"https:\/\/rzp.io\/i\/VC29V8w",
        "created_at":1682846821,
        "contact_id":"cont_Ljx9Dzw8kg2BrW",
        "send_sms":true,
        "send_email":true,
        "fund_account_id":null,
        "cancelled_at":null,
        "attempt_count":0,
        "user_id":null,
        "receipt":"#12345",
        "notes":{
            "key1":"value1",
            "key2":"value2"
        }
    },
    {
        "id":"poutlk_4Evg20JQGuZx8S",
        "entity":"payout_link",
        "contact":{
            "name":"Test User",
            "contact":"+919876543210",
            "email":"test@gmail.com"
        },
        "purpose":"cashback",
        "status":"issued",
        "amount":100,
        "currency":"INR",
        "description":"Test payment",
        "short_url":"https:\/\/rzp.io\/i\/EBdSDykG9c",
        "created_at":1682839716,
        "contact_id":"cont_Ljv88MRbiLMDBZ",
        "send_sms":true,
        "send_email":true,
        "fund_account_id":null,
        "cancelled_at":null,
        "attempt_count":0,
        "user_id":null,
        "receipt":"#12345",
        "notes":{
            "key1":"value1",
            "key2":"value2"
        }
    }
]
```

#### Fetch payout link details

```
$response = RazorpayHelper::fetchPayoutLink($payoutLinkId);
```

Response data

```
{
    "id":"poutlk_8m1m20JSI0Eeng",
    "entity":"payout_link",
    "contact":{
        "name":"Test User",
        "contact":"+919876543210",
        "email":"test@gmail.com"
    },
    "purpose":"cashback",
    "status":"issued",
    "amount":100,
    "currency":"INR",
    "description":"Test payment",
    "short_url":"https:\/\/rzp.io\/i\/VC29V8w",
    "created_at":1682846821,
    "contact_id":"cont_Ljx9Dzw8kg2BrW",
    "send_sms":true,
    "send_email":true,
    "fund_account_id":null,
    "cancelled_at":null,
    "attempt_count":0,
    "user_id":null,
    "receipt":"#12345",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    }
}
```

#### Cancel payout link

```
$response = RazorpayHelper::cancelPayoutLink($paymentLinkId);
```

Response data

```
{
    "id":"poutlk_8m1m20JSI0Eeng",
    "entity":"payout_link",
    "contact":{
        "name":"Test User",
        "contact":"+919876543210",
        "email":"test@gmail.com"
    },
    "purpose":"cashback",
    "status":"cancelled",
    "amount":100,
    "currency":"INR",
    "description":"Test payment",
    "short_url":"https:\/\/rzp.io\/i\/VC29V8w",
    "created_at":1682846821,
    "contact_id":"cont_Ljx9Dzw8kg2BrW",
    "send_sms":true,
    "send_email":true,
    "fund_account_id":null,
    "cancelled_at":1682847474,
    "attempt_count":0,
    "user_id":null,
    "receipt":"#12345",
    "notes":{
        "key1":"value1",
        "key2":"value2"
    }
}
```
