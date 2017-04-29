{if $receipt_text}
{$receipt_text}
{else}{ts}Thank you for your support.{/ts}{/if}

{ts}Please print this receipt for your records.{/ts}


===========================================================
{ts}Contribution Information{/ts}

===========================================================
{ts}Contribution Type{/ts}: {$contributionTypeName}
{if $lineItem}
{foreach from=$lineItem item=value key=priceset}
---------------------------------------------------------
{capture assign=ts_item}{ts}Item{/ts}{/capture}
{capture assign=ts_qty}{ts}Qty{/ts}{/capture}
{capture assign=ts_each}{ts}Each{/ts}{/capture}
{if $getTaxDetails}
{capture assign=ts_subtotal}{ts}Subtotal{/ts}{/capture}
{capture assign=ts_taxRate}{ts}Tax Rate{/ts}{/capture}
{capture assign=ts_taxAmount}{ts}Tax Amount{/ts}{/capture}
{/if}
{capture assign=ts_total}{ts}Total{/ts}{/capture}
{$ts_item|string_format:"%-30s"} {$ts_qty|string_format:"%5s"} {$ts_each|string_format:"%10s"} {if $getTaxDetails} {$ts_subtotal|string_format:"%10s"} {$ts_taxRate} {$ts_taxAmount|string_format:"%10s"} {/if} {$ts_total|string_format:"%10s"}
----------------------------------------------------------
{foreach from=$value item=line}
{capture assign=ts_item}{if $line.html_type eq 'Text'}{$line.label}{else}{$line.field_title} - {$line.label}{/if} {if $line.description} {$line.description}{/if}{/capture}{$ts_item|truncate:30:"..."|string_format:"%-30s"} {$line.qty|string_format:"%5s"} {$line.unit_price|crmMoney:$currency|string_format:"%10s"} {if $getTaxDetails}{$line.unit_price*$line.qty|crmMoney:$currency|string_format:"%10s"} {if $line.tax_rate != "" || $line.tax_amount != ""} {$line.tax_rate|string_format:"%.2f"} %   {$line.tax_amount|crmMoney:$currency|string_format:"%10s"} {else}                  {/if} {/if}   {$line.line_total+$line.tax_amount|crmMoney:$currency|string_format:"%10s"}
{/foreach}
{/foreach}
{/if}

{if $getTaxDetails && $dataArray}
{ts}Amount before Tax{/ts} : {$amount-$totalTaxAmount|crmMoney:$currency}

{foreach from=$dataArray item=value key=priceset}
{if $priceset ||  $priceset == 0 || $value != ''}
{$taxTerm} {$priceset|string_format:"%.2f"}% : {$value|crmMoney:$currency}
{else}
{ts}No{/ts} {$taxTerm} : {$value|crmMoney:$currency}
{/if}
{/foreach}
{/if}

{if isset($totalTaxAmount) && $totalTaxAmount !== 'null'}
{ts}Total Tax Amount{/ts} : {$totalTaxAmount|crmMoney:$currency}
{/if}
{ts}Total Amount{/ts} : {$amount|crmMoney:$currency}
{if $receive_date}
{ts}Received Date{/ts}: {$receive_date|truncate:10:''|crmDate}
{/if}
{if $receipt_date}
{ts}Receipt Date{/ts}: {$receipt_date|truncate:10:''|crmDate}
{/if}
{if $paidBy and !$hidden_CreditCard}
{ts}Paid By{/ts}: {$paidBy}
{if $check_number}
{ts}Check Number{/ts}: {$check_number}
{/if}
{/if}
{if $trxn_id}
{ts}Transaction ID{/ts}: {$trxn_id}
{/if}

{* if $ccContribution *}
===========================================================
{ts}Billing Name and Address{/ts}

===========================================================
{$billingName}
{$address}

{if $credit_card_type || $credit_card_number || $credit_card_exp_date}
===========================================================
{ts}Credit Card Information{/ts}

===========================================================
{if $credit_card_type}
{$credit_card_type}
{/if}
{if $credit_card_number}
{$credit_card_number}
{/if}
{if $credit_card_exp_date}{ts}Expires{/ts}: {$credit_card_exp_date|truncate:7:''|crmDate}{/if}
{/if}

{* ************* START profile fields ********* *}
{if $customGroup}
{foreach from=$customGroup item=value key=customName}
{assign var=showHeader value=0}
{capture name=customGroupRows}
{foreach from=$value item=v key=n}
{if $v}
{assign var=showHeader value=1}
{$n}: {$v}
{/if}
{/foreach}
{/capture}
{if $showHeader eq 1}

===========================================================
{$customName}
===========================================================
{$smarty.capture.customGroupRows}
{/if}
{/foreach}
{/if}
{* ************* END profile fields ********* *}

{if $softCreditTypes and $softCredits}
{foreach from=$softCreditTypes item=softCreditType key=n}
===========================================================
{$softCreditType}
===========================================================
{foreach from=$softCredits.$n item=value key=label}
{$label}: {$value}
{/foreach}
{/foreach}
{/if}

{if $product_name}
===========================================================
{ts}Premium Information{/ts}

===========================================================
{$product_name}
{if $product_option}
{ts}Option{/ts}: {$product_option}
{/if}
{if $product_sku}
{ts}SKU{/ts}: {$product_sku}
{/if}
{if $fulfilled_date}
{ts}Sent{/ts}: {$fulfilled_date|crmDate}
{/if}
{/if}


Docref.onltxt