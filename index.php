<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load(); 

$secretKey = $_ENV["STRIPE_SECRET_KEY"];

// echo $secretKey;
// $publicKey = env('STRIPE_PUBLIC_KEY');

$stripe = new \Stripe\StripeClient($secretKey);
// 顧客リストの追加
// $customer = $stripe->customers->create([
//     'description' => 'エストラ customer',
//     'email' => 'email@example.com',
//     'payment_method' => 'pm_card_visa',
// ]);
// echo $customer;


// 支払いの完了
$charge = $stripe->charges->create([
  'amount' => 99000,
  'currency' => 'jpy',
  'source' => 'tok_visa', // obtained with Stripe.js
  'description' => 'エストラCharge (created for API docs)',
], [
  'idempotency_key' => '202112167'
  // 冪等性のためのキー、同一の決済しかない時にひつよう
]);
echo $charge;

// お店の残高の取得
$balance = $stripe->balance->retrieve();
echo $balance;

// 支払いの各データ
// "amount": 合計金額,
// status": "canceled”キャンセル、 "succeeded”支払い成功
// charges: 支払い関係のオブジェクト
// cancellation_reason キャンセル理由
// count($payment_intents->data); 決済回数
// date("Y/m/d",'1638421048'); UNIX時間の変換
// $payment_intents = $stripe->paymentIntents->all();
// echo $payment_intents;
// echo count($payment_intents->data);

// 顧客情報取得
$accounts = $stripe->accounts->retrieve("id情報");
echo $accounts;

// 送金先ようアカウントの作成
// $connenctedAccount = $stripe->accounts->create([
//   'type' => 'custom',
//   'country' => 'US',
//   'business_type' => 'individual',
//   'email' => 'sam.key@example.com',
//   'capabilities' => [
//     'card_payments' => ['requested' => true],
//     'transfers' => ['requested' => true],
//   ],
// ]);
// echo $connenctedAccount;
// 

//顧客情報の更新（利用規約の同意）
// $updateCustomer = $stripe->accounts->update(
//   // '{{CONNECTED_STRIPE_ACCOUNT_ID}}',IDを加える
//   'acct_1K7FcjPEzp542nUz',
//   [
//     'tos_acceptance' => ['date' => 1609798905, 'ip' => '8.8.8.8'],
//     "account" => "acct_18rsqhJ6m0aiknMB",
//     "account_holder_name" => "Jane Austen",
//     "account_holder_type" => "individual",
//     "bank_name" => "STRIPE TEST BANK",
//   ]//customアカウントのみ利用可能
//   // ['tos_acceptance' => ['service_agreement' => 'recipient']],
// );
// echo $updateCustomer;
