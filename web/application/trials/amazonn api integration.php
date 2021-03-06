<?php
// Your AWS Access Key ID, as taken from the AWS Your Account page
$aws_access_key_id = "AKIAJ3HNWZWGDCWCAJAQ";

// Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
$aws_secret_key = "GRbrardcjizFVJ+6mFZ7nbGmHWOT3C7O2T0//JDo";

// The region you are interested in
$endpoint = "webservices.amazon.in";

$uri = "/onca/xml";

$params = array(
    "Service" => "AWSECommerceService",
    "Operation" => "ItemLookup",
    "AWSAccessKeyId" => "AKIAJ3HNWZWGDCWCAJAQ",
    "AssociateTag" => "product marketing",
    "ItemId" => "B01618MY62",
    "IdType" => "ASIN",
    "ResponseGroup" => "Offers,Reviews",
    "Version" => "2015-10-01"
);

// Set current timestamp if not set
if (!isset($params["Timestamp"])) {
    $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
}

// Sort the parameters by key
ksort($params);

$pairs = array();

foreach ($params as $key => $value) {
    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
}

// Generate the canonical query
$canonical_query_string = join("&", $pairs);

// Generate the string to be signed
$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

// Generate the signature required by the Product Advertising API
$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

// Generate the signed URL
$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

echo "Signed URL: \"".$request_url."\"";

?>
