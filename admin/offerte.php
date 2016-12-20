<?php
    if(isset($_GET['id'])){
        include 'functions.php';
        $id = $_GET['id'];
        $quotation = get_single_quotation($id);
        $user = get_customer_info($quotation["customer_id"]);
        $total_price = get_quotation_total_price($quotation["quotation_id"]);
        $company = get_company_info();
        $product_id = get_quotation_product($quotation["quotation_id"]);
        $product = get_product_info($product_id);
    }
    else{
        header('location: ./');
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body style="border-top: 20px solid #ef4035;border-bottom: 20px solid #48a942;margin: 0;">
    <div style="width: 350px;margin: 20px auto;">
        <img src="../images/logo.png" width="100%">
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
        offertenr.: <?= $quotation["quotation_id"]?><br>
        betreft: <?= $product["product_name"] ?>
    </div><br>
    <div style="margin: 10px 20%; font-size: 18px;">
        Geachte mevrouw/heer,
    </div>
    <div style="margin: 10px 20%; font-size: 18px;">
        In aansluiting op uw prijsaanvraag bieden wij u uiteraard geheel vrijblijvend het volgende aan:
    </div>
    <div style="margin: 10px 20%; font-size: 18px;">
        <table>
            <tr>
                <th>Product nr.</th>
                <th>Product afbeelding</th>
                <th>Product naam</th>
                <th>Product omschrijving</th>
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
    <div style="margin: 10px 20%;">
        <img src="../images/signature.png" >
    </div>
    <div style="margin: 10px 20%; font-size: 18px;">
        E. Weiss.
    </div>
</body>
</html>