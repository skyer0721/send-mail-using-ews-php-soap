<?php

$url = "https://staff.kugou.com/ews/exchange.asmx";
$soapMsg = <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
               xmlns:m="http://schemas.microsoft.com/exchange/services/2006/messages" 
               xmlns:t="http://schemas.microsoft.com/exchange/services/2006/types" 
               xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Header>
    <t:RequestServerVersion Version="Exchange2013" />
  </soap:Header>
  <soap:Body>
    <m:CreateItem MessageDisposition="SendAndSaveCopy">
      <m:SavedItemFolderId>
        <t:DistinguishedFolderId Id="sentitems" />
      </m:SavedItemFolderId>
      <m:Items>
        <t:Message>
          <t:Subject>Company Soccer Team</t:Subject>
          <t:Body BodyType="HTML">Are you interested in joining?</t:Body>
          <t:ToRecipients>
            <t:Mailbox>
              <t:EmailAddress>someone@staff.kugou.com</t:EmailAddress>
              </t:Mailbox>
          </t:ToRecipients>
        </t:Message>
      </m:Items>
    </m:CreateItem>
  </soap:Body>
</soap:Envelope>
EOF;
$header[] = "Content-type: text/xml"; 
$header[] = "Connection: KEEP-Alive";
$header[] = "User-Agent: PHP-SOAP-CURL";
$header[] = "Method: POST";
$user = "******";
$pw = "****";
$domain = "*****";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 900); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
curl_setopt($ch, CURLOPT_USERPWD, $domain . "\\".  $user . ":" . $pw);
curl_setopt($ch, CURLOPT_POSTFIELDS, $soapMsg);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);

$info = curl_getinfo($ch);

if(curl_errno($ch))
{
    echo 'Curl error: ' . curl_error($ch);
	echo "\n";
}

// 关闭句柄
curl_close($ch);
