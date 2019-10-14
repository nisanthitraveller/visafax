@extends('layouts.ajax')
@section('content')

<?php
$SALT = 'drPHqXTg';
$hash = null;
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email";
$hashVarsSeq = explode('|', $hashSequence);
$hash_string = '';
foreach ($hashVarsSeq as $hash_var) {
    $hash_string .= isset($data[$hash_var]) ? $data[$hash_var] : '';
    $hash_string .= '|';
}
$hash_string .= '||||||||||';
$hash_string .= $SALT;
$hash .= strtolower(hash('sha512', $hash_string));
?>
<form action="https://secure.payu.in/_payment" method="post" id="PayUForm" name="PayUForm">
    @csrf
    <input type="hidden" name="key" value="<?php echo $data['key']; ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
    <input type="hidden" name="txnid" value="<?php echo $data['txnid']; ?>" />
    <input type="hidden" name="amount" value="<?php echo $data['amount']; ?>" />
    <input type="hidden" name="firstname" id="firstname" value="<?php echo $data['firstname']; ?>" />
    <input type="hidden" name="email" id="email" value="<?php echo $data['email']; ?>" />
    <input type="hidden" name="phone" value="<?php echo $data['phone']; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $data['productinfo']; ?>" />
    <input type="hidden" name="surl" value="<?php echo $data['surl']; ?>" />
    <input type="hidden" name="furl" value="<?php echo $data['furl']; ?>" />
    <input type="hidden" name="service_provider" value=" " size="64" />
</form>
@stop