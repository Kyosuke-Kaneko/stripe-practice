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


//支払いの完了
// $charge = $stripe->charges->create([
//   'amount' => 2000,
//   'currency' => 'jpy',
//   'source' => 'tok_visa', // obtained with Stripe.js
//   'description' => 'エストラCharge (created for API docs)'
// ], [
//   // 冪等性のためのキー、同一の商品しかない時にひつよう
//   // 'idempotency_key' => 'szV3elJgDY8cxaHs'
// ]);
// echo $charge;

// お店の残高の取得
// $balance = $stripe->balance->retrieve();
// echo $balance;

// 支払いの各データ
// "amount": 合計金額,
// status": "canceled”キャンセル、 "succeeded”支払い成功
// charges: 支払い関係のオブジェクト
// cancellation_reason キャンセル理由
// count($payment_intents->data); 決済回数
// date("Y/m/d",'1638421048'); UNIX時間の変換
$payment_intents = $stripe->paymentIntents->all();
// echo $payment_intents;
// echo count($payment_intents->data);
