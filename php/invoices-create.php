<?php

include_once('lib/spyc.php');
$APP_CONFIG = spyc_load_file('../config/config.yaml');

$screenname = $APP_CONFIG['screen_name'];
$api_key = $APP_CONFIG['api_key'];
$host = $APP_CONFIG['host'];

ob_start(); 

$invoice_data = '
  <?xml version="1.0" encoding="UTF-8"?>
  <invoice>
   <date>23/8/2010</date>
   <due_date>23/8/2010</due_date>
   <reference>123456</reference>
   <observations>Computer processed</observations>
   <retention>5</retention>
   <client>
    <name>XX Bruce Norris</name>
    <email>foo@s@bar.com</email>
    <address>Badgad</address>
    <postal_code>120213920139</postal_code>
    <country>Germany</country>
    <fiscal_id>12</fiscal_id>
    <website>www.brucenorris.com</website>
    <phone>2313423424</phone>
    <fax>2313423425</fax>
    <observations>Computer Processed</observations>
   </client>
   <items type="array">
    <item>
     <name>Product 1</name>
     <description>Cleaning product</description>
     <unit_price>10.0</unit_price>
     <quantity>1.0</quantity>
     <unit>unit</unit>
     <discount>10.0</discount>
    </item>
   </items>
  </invoice>';
   


$endpoint = "https://".$screenname.".".$host."/invoices.xml?api_key=".$api_key;


// Initialize handle and set options
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($ch, CURLOPT_POSTFIELDS, $invoice_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));

// Execute the request
$result = curl_exec($ch);

// Close the handle
curl_close($ch);

echo $result;

