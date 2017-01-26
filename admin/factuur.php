<!--gemaakt door Daan bakker, aangepast door jan kaptijn-->
<?php
$admin_rights = true; // Page is only for admins.
session_start();
include "check_login.php";
ob_start();
	

	
    if(isset($_GET["id"])){


        include "functions.php";
        $id = $_GET["id"];
        $invoice = get_single_invoice($id);
        $user = get_customer_info($invoice["customer_id"]);
        $company = get_company_info();
        $invoice_product = get_invoice_product($invoice["invoice_id"]);
        $product = get_product_info($invoice_product["product_id"]);

        $product_amount = $invoice_product["product_amount"]; //product amount
        $product_single_price = $invoice_product["product_net_amount"]; //product price for each item
        $product_sub_total = $product_amount * $product_single_price; //product total price
        $VAT = $invoice_product["product_VAT"];
        $product_total = $product_sub_total+($product_sub_total * ($VAT / 121)); //product total price



    }
    else{
        header("location: ./");
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">


    <title>factuur </title>

</head>
<body style="border-top: 20px solid #ef4035;border-bottom: 20px solid #48a942;margin: 0;">
    <div style="width: 350px;margin: 20px auto;">
<!--        <img src="../images/logo.png" width="100%">-->
    </div>
    <div style="margin: 10px 20%; font-size: 18px;">
        <?= $user["customer_name"] ?><br>
        <?= $user["customer_email"] ?><br>
        <?= $user["customer_address"] ?><br>
        <?= $user["customer_zipcode"].", ".$user["customer_location"] ?><br>
        <?php if($user["customer_company"] != ""){ echo $user["customer_company"]; } ?>
    </div>
    <br>
    <div style="margin: 10px 20%; font-size: 18px;">
        <?= $company["company_location"].", ".date("d-m-Y") ?>
    </div>
    <br>
    <div style="margin: 10px 20%; font-size: 18px;">
        offertenr.: <?= $invoice["invoice_id"]?><br>
        betreft: <?= $product["product_name"] ?>
    </div><br>
    <div style="margin: 10px 20%; font-size: 18px;">
        Geachte mevrouw/heer,
    </div>
    <div style="margin: 10px 20%; font-size: 18px;">
        In aansluiting op uw prijsaanvraag bieden wij u uiteraard geheel vrijblijvend het volgende aan:
    </div>
    <div style="margin: 15px 20%; font-size: 18px;">
        <table width="100%" style="text-align: left;">
            <tr>
<!--                <th style="border-bottom: 1px solid #000">Afbeelding</th>-->
                <th style="border-bottom: 1px solid #000">Naam</th>
                <th style="border-bottom: 1px solid #000">Omschrijving</th>
                <th style="border-bottom: 1px solid #000">Aantal</th>
                <th style="border-bottom: 1px solid #000">Stukprijs(&euro;)</th>
                <th style="border-bottom: 1px solid #000">Totaal(&euro;)</th>
            </tr>
            <tr>
<!--                <td style="border-bottom: 1px solid #000"><img width="100px" src="?= "../".$product["product_image"] ?>" /></td>-->
                <td style="border-bottom: 1px solid #000"><?= $product["product_name"] ?></td>
                <td style="border-bottom: 1px solid #000"><?= $product["product_description"] ?></td>
                <td style="border-bottom: 1px solid #000"><?= $product_amount ?></td>
                <td style="text-align: right;border-bottom: 1px solid #000"><?= $product_single_price  ?></td>
                <td style="text-align: right;border-bottom: 1px solid #000"><?= $product_sub_total ?></td>
            </tr>
        </table>
        <table style="width:25%;margin: 0 0 0 auto;">
            <tr>
                <td style="text-align: right;border-bottom: 1px solid #000">BTW(&#37;)</td>
                <td style="text-align: right;border-bottom: 1px solid #000"><?=  $VAT ?></td>
            </tr>
            <tr>
                <td style="text-align: right;"><b>Totaal(&euro;)</b></td>
                <td style="text-align: right;"><?= $product_total ?></td>
            </tr>
        </table>
    </div>
    <div style="margin: 10px 20%; font-size: 18px;">
        Wij zijn gaarne bereid een en ander nader toe te lichten. Uw eventuele opdracht zullen wij met de meest mogelijke<br>
        zorg uitvoeren. Bovenstaande prijzen zijn gebaseerd op het huidige kostenpeil van lonen en materialen.
    </div>
    <div style="margin: 10px 20%; font-size: 18px;">
        In afwachting van uw antwoord,
    </div>
    <div style="margin: 10px 20%; font-size: 18px;">
        Met vriendelijke groeten,
    </div>

    <div style="margin: 10px 20%; font-size: 18px;">
        E. Weiss.
    </div>
</body>
</html>

<?php
$content = ob_get_contents();
$open = fopen("factuur/".$_GET["id"].".html", "w");
fwrite($open, $content);
fclose($open); 

?>


<a href="factuur/<?= $_GET['id']?>.html" download>DOWNLOAD</a>

