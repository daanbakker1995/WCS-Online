<?php

session_start();
/**
 * Created by PhpStorm.
 * User: Daan
 * Date: 29-11-2016
 * Time: 11:33
 */
include 'classes/Database.php';


/********* GET FUNCTIONS *********/
/**
 * A function to get all the information pages.
 *
 * @return mixed
 */
function get_info_pages(){
    $db = new Database();
    $db->query('SELECT * FROM content_page');
    $pages = $db->resultset();
    return $pages;
}
/**
 * A function to get all the information pages.
 *
 * @return mixed
 */
function get_company_info(){
    $db = new Database();
    $db->query('SELECT * FROM company');
    $company = $db->single();
    return $company;
}

/**
 * A function to get all the information pages.
 *
 * @return mixed
 */
function get_page_info($id){
    $db = new Database();
    $db->query('SELECT * FROM content_page where page_id=:id');
    $db->bind(':id', $id);
    $pages = $db->single();
    return $pages;
}
/**
 * A function to get all the information pages.
 *
 * @return mixed
 */
function get_homepage_info($id){
    $db = new Database();
    $db->query('SELECT * FROM homepage where homepage_id=:id');
    $db->bind(':id', $id);
    $page = $db->single();
    return $page;
}

/**
 * A function to get all the information pages.
 *
 * @return mixed
 */
function get_customer_info($id){
    $db = new Database();
    $db->query('SELECT * FROM customer WHERE customer_id=:id');
    $db->bind(':id', $id);
    $user = $db->single();
    return $user;
}

/**
 * A function to get all the information pages.
 *
 * @return mixed
 */
function get_product_info($id){
    $db = new Database();
    $db->query('SELECT * FROM product WHERE product_id=:id');
    $db->bind(':id', $id);
    $user = $db->single();
    return $user;
}

/**
 * Select all request with status 0(request).
 *
 * @return mixed
 */
function get_quotation_requests(){
    $db = new Database();
    $db->query('SELECT * FROM quotation_request WHERE request_status=0');
    $requests = $db->resultset();
    return $requests;
}

/**
 * Select all request with status 0(request).
 *
 * @return mixed
 */
function get_single_quotation_requests($id){
    $db = new Database();
    $db->query('SELECT * FROM quotation_request WHERE request_id=:id');
    $db->bind(':id', $id);
    $requests = $db->single();
    return $requests;
}

function get_invoices(){
    $db = new Database();
    $db->query('SELECT * FROM invoice WHERE invoice_status=0 ');
    $requests = $db->resultset();
    return $requests;
}
/**
 * Select all request with status 0(request).
 *
 * @return mixed
 */
function get_quotations(){
    $db = new Database();
    $db->query('SELECT * FROM quotation WHERE quotation_status=0');
    $requests = $db->resultset();
    return $requests;
}
/**
 * Select all request with status 0(request).
 *
 * @return mixed
 */
function get_single_quotation($id){
    $db = new Database();
    $db->query('SELECT * FROM quotation WHERE quotation_id=:id');
    $db->bind(":id", $id);
    $requests = $db->single();
    return $requests;
}
/**
 * Select all request with status 0(request).
 *
 * @return mixed
 */
function get_quotations_archived(){
    $db = new Database();
    $db->query('SELECT * FROM quotation WHERE quotation_status=1');
    $requests = $db->resultset();
    return $requests;
}/**
 * Select all request with status 0(request).
 *
 * @return mixed
 */
function get_quotation_product($id){
    $db = new Database();
    $db->query('SELECT * FROM quotation_information WHERE quotation_id=:id');
    $db->bind(":id", $id);
    $product = $db->single();
    return $product;
}
/**
 * Select all request with status 0(request).
 *
 * @return mixed
 */
function get_quotation_total_price($id){
    $total_price = 0;
    $db = new Database();
    $db->query('SELECT product_net_amount FROM quotation_information WHERE quotation_id=:id');
    $db->bind(':id', $id);
    $products = $db->resultset();
    foreach($products as $product){
        $total_price = $total_price+$product["product_net_amount"];
    }
    return $total_price;
}


function get_quotations_limit_10(){
    $db = new Database();
    $db->query('SELECT * FROM quotation WHERE quotation_status=0 ORDER BY quotation_id DESC LIMIT 10 ');
    $requests = $db->resultset();
    return $requests;
}

function get_invoice_limit_10(){
    $db = new Database();
    $db->query('SELECT * FROM invoice WHERE invoice_status=0 ORDER BY invoice_id DESC LIMIT 10 ');
    $invoice = $db->resultset();
    return $invoice;
}

function get_products_limit_10(){
    $db = new Database();
    $db->query('SELECT * FROM product P JOIN category C WHERE category_name="hardware service" AND P.category_id=C.category_id LIMIT 10');
    $products = $db->resultset();
    return $products;
}

function get_pages_limit_15(){
    $db = new Database();
    $db->query('SELECT * FROM content_page LIMIT 15');
    $products = $db->resultset();
    return $products;
}
/********* END GET FUNCTIONS *********/

/********* INSERT FUNCTIONS *********/

function insert_quotation($product_id,$customer_name ,$customer_email,$customer_address,$customer_zipcode,$customer_company,$customer_location,$specs,$aantal){
    
    $db = new Database();
    
    $db->beginTransaction();
    $db->query('INSERT INTO customer (customer_name,customer_email,customer_address,customer_zipcode,customer_company,customer_location) '
            . 'VALUES (:q_customer_name,:q_customer_email,:q_customer_address,:q_customer_zipcode,:q_customer_company,:q_customer_location)'); 
    $db->bind('q_customer_name', $customer_name);
    $db->bind('q_customer_email', $customer_email);
    $db->bind('q_customer_address', $customer_address);
    $db->bind('q_customer_zipcode', $customer_zipcode);
    $db->bind('q_customer_company', $customer_company);
    $db->bind('q_customer_location', $customer_location);
    $db->execute();
    
    $customer_id = $db->lastInsertId();
    
    $db->query('INSERT INTO quotation_request (customer_id,product_id,request_date,specs,aantal) VALUES (:q_customer_id, :q_product_id,:q_request_date,:q_specs,:q_aantal)');
    $db->bind(':q_customer_id', $customer_id);
    $db->bind(':q_product_id', $product_id);
    $db->bind(':q_request_date', date("Y-m-d H:i:s"));
    $db->bind(':q_specs', $specs);
    $db->bind(':q_aantal', $aantal);
    $db->execute();

    $db->endTransaction();
}
/**
 * @return mixed
 */
function insert_info_page($title, $description, $content, $status, $type, $location){
    $db = new Database();
    $db->query('INSERT INTO content_page (page_title, page_description, page_content, page_status, page_type, page_location) VALUES (:ptitle, :pdescription, :pcontent, :pstatus, :ptype, :plocation)');
    $db->bind(':ptitle', $title);
    $db->bind(':pdescription', $description);
    $db->bind(':pcontent', $content);
    $db->bind(':pstatus', $status);
    $db->bind(':ptype', $type);
    $db->bind(':plocation', $location);
    if($db->execute()){
        return true;
    }
    else{
        return false;
    }

}

function accept_quotation_request($id){
    $quotation_request = get_single_quotation_requests($id);
    $customer = $quotation_request['customer_id'];
    $product_id = $quotation_request['product_id'];
    $product_info = get_product_info($product_id); 
    $product_excl_btw = ((100*$product_info["product_price"])/121 );
    
    $db = new Database();
    $db->beginTransaction();
    $db->query('INSERT INTO quotation (customer_id) VALUES (:customer_id)');
    $db->bind(':customer_id', $customer);
    if($db->execute()){
        $qoutation_info_id = $db->lastInsertId();
        $db->query('INSERT INTO quotation_information (quotation_id, product_id, product_net_amount) VALUES (:qid, :pid, :pprice)');
        $db->bind(':qid', $qoutation_info_id);
        $db->bind(':pid', $product_id);
        $db->bind(':pprice', $product_excl_btw);
        if($db->execute()){
            $db->query('UPDATE quotation_request SET request_status=:status where request_id = :q_id ');
            $db->bind(':q_id', $id);
            $db->bind(':status', 1);
            if($db->execute()){
                $db->endTransaction();
                return true;
            }
            else{
                $db->cancelTransaction();
                return false;
            }
        }
        else{
            $db->cancelTransaction();
            return false;
        }
    }
    else{
        $db->cancelTransaction();
        return false;
    }

}
///comentaar
function quotation_to_invoice($id){
    $db = new Database();
    $db->query('SELECT * FROM quotation WHERE quotation_id =:q_id ');
    $db->bind(':q_id', $id);
    $quotation = $db->single();
    
    
    
    $db->query('INSERT INTO invoice (customer_id,quotation_id,edition) VALUES (:q_customer,:q_quotation,:q_edition)');
    $db->bind(':q_customer',$quotation['customer_id']);
    $db->bind(':q_quotation',$quotation['quotation_id']);
    $db->bind(':q_edition',$quotation['edition']);
    $db->execute();
    $lastinsertid = $db->lastInsertId();
    $db->query('SELECT * from quotation_information WHERE quotation_id =:q_id ');
    $db->bind(':q_id', $id);
    $quotation_info = $db->single();
    
    
    
 
    
    $db->query('INSERT INTO invoice_information(invoice_id,product_id,product_amount,product_net_amount,product_VAT) VALUES (:q_invoice_id,:q_product_id,:q_product_amount,:q_product_net_amount,:q_product_VAT)');
    $db->bind(':q_invoice_id', $lastinsertid);
    $db->bind(':q_product_id',$quotation_info['product_id']);
    $db->bind(':q_product_amount',$quotation_info['product_amount']);
    $db->bind(':q_product_net_amount',$quotation_info['product_net_amount']);
    $db->bind(':q_product_VAT',$quotation_info['product_VAT']);
    $db->execute();
    acrhive_quotation($id);
    return true;
    
     
}

/********* END INSERT FUNCTIONS *********/

/********* UPDATE FUNCTIONS *********/

/**
 * @param $id
 * @return bool
 */
function acrhive_quotation($id){
    $db = new Database();
    $db->query('UPDATE quotation SET quotation_status=:status WHERE quotation_id=:qid');
    $db->bind(':qid', $id);
    $db->bind(':status', 1);
    if($db->execute()){
        return true;
    }
    else{
        return false;
    }
}

function archive_invoice($id){
    $db = new Database();
    $db->query('UPDATE invoice SET invoice_status=:status WHERE invoice_id=:qid');
    $db->bind(':qid', $id);
    $db->bind(':status', 1);
    if($db->execute()){
        return true;
    }
    else{
        return false;
    }
}

/**
 * @return mixed
 */
function update_info_page($values){
    $db = new Database();
    $db->query('UPDATE content_page SET page_title=:ptitle, page_description=:pdescription, page_content=:pcontent, page_status=:pstatus, page_type=:ptype, page_location=:plocation WHERE page_id=:pid');
    $db->bind(':pid', $values['id']);
    $db->bind(':ptitle', $values['title']);
    $db->bind(':pdescription', $values['description']);
    $db->bind(':pcontent', $values['content']);
    $db->bind(':pstatus', $values['status']);
    $db->bind(':ptype', $values['type']);
    $db->bind(':plocation', $values['location']);
    if($db->execute()){
        return true;
    }
    else{
        return false;
    }

}

/**
 * @param $page_info
 * @return bool
 */
function update_homepage($page_info){
    $db = new Database();
    $db->query('
    UPDATE `homepage`
    SET    `homepage_header_title`=:homepage_header_title,
    `homepage_header_content`=:homepage_header_content,
    `homepage_header_button_text`=:homepage_header_button_text,
    `homepage_header_button_link`=:homepage_header_button_link,

    `homepage_service_one_header`=:s_1_header,
    `homepage_service_one_content`=:s_1_content,
    `homepage_service_one_button_text`=:s_1_b_text,
    `homepage_service_one_button_link`=:s_1_b_link,

    `homepage_service_two_header`=:s_2_header,
    `homepage_service_two_content`=:s_2_content,
    `homepage_service_two_button_text`=:s_2_b_text,
    `homepage_service_two_button_link`=:s_2_b_link,

    `homepage_service_three_header`=:s_3_header,
    `homepage_service_three_content`=:s_3_content,
    `homepage_service_three_button_text`=:s_3_b_text,
    `homepage_service_three_button_link`=:s_3_b_link
    WHERE `homepage_id`=:id
    ');
    $db->bind(':id',$page_info["id"]);
    $db->bind(':homepage_header_title', $page_info["homepage_header_title"]);
    $db->bind(':homepage_header_content', $page_info["homepage_header_content"]);
    $db->bind(':homepage_header_button_text', $page_info["homepage_header_button_text"]);
    $db->bind(':homepage_header_button_link', $page_info["homepage_header_button_link"]);

    $db->bind(':s_1_header', $page_info["s_1_header"]);
    $db->bind(':s_1_content', $page_info["s_1_content"]);
    $db->bind(':s_1_b_text', $page_info["s_1_b_text"]);
    $db->bind(':s_1_b_link', $page_info["s_1_b_link"]);

    $db->bind(':s_2_header', $page_info["s_2_header"]);
    $db->bind(':s_2_content', $page_info["s_2_content"]);
    $db->bind(':s_2_b_text', $page_info["s_2_b_text"]);
    $db->bind(':s_2_b_link', $page_info["s_2_b_link"]);

    $db->bind(':s_3_header', $page_info["s_3_header"]);
    $db->bind(':s_3_content', $page_info["s_3_content"]);
    $db->bind(':s_3_b_text', $page_info["s_3_b_text"]);
    $db->bind(':s_3_b_link', $page_info["s_3_b_link"]);

    if($db->execute()){
        return true;
    }
    else{
        return false;
    }
}

function update_homepage_image($file_name,$id){
    $db = new Database();
    $db->query('
    UPDATE `homepage` SET    `homepage_header_image`=:homepage_header_image WHERE `homepage_id`=:id
    ');
    $db->bind(':id', $id);
    $db->bind(':homepage_header_image', $file_name);

    if($db->execute()){
        return true;
    }
    else{
        return false;
    }
}

function decline_quotation_request($id){
    $db = new Database();
    $db->query('UPDATE quotation_request SET request_status=:status WHERE request_id=:id');
    $db->bind(':id', $id);
    $db->bind(':status', 2);

    if($db->execute()){
        return true;
    }
    else{
        return false;
    }
}

/********* END UPDATE FUNCTIONS *********/

/********* COUNT FUNCTIONS *********/
/**
 * @return mixed
 */
function count_requests(){
    $db = new Database();
    $db->query('SELECT COUNT(request_id) as requests FROM quotation_request where request_status=0');
    $count = $db->single();
    return $count['requests'];
}

/**
 * @return mixed
 */
function count_invoices(){
    $db = new Database();
    $db->query('SELECT COUNT(invoice_id) as invoices FROM invoice where invoice_status=0');
    $count = $db->single();
    return $count['invoices'];
}

/**
 * @return mixed
 */
function count_hardware_products(){
    $db = new Database();
    $db->query('SELECT COUNT(product_id) products FROM product P JOIN category C WHERE category_name="hardware service" AND P.category_id=C.category_id');
    $count = $db->single();
    return $count['products'];
}

/**
 * @return mixed
 */
function count_copy_products(){
    $db = new Database();
    $db->query('SELECT COUNT(product_id) products FROM product P JOIN category C WHERE category_name="copy service" AND P.category_id=C.category_id');
    $count = $db->single();
    return $count['products'];
}

/********* END COUNT FUNCTIONS *********/

/********* DELETE FUNCTIONS *********/
/**
 * @param $id
 * @return bool
 */
function delete_info_page($id){
    $db = new Database();
    $db->query('DELETE FROM content_page WHERE page_id=:pid');
    $db->bind(':pid', $id);

    if($db->execute()){
        return true;
    }
    else{
        return false;
    }
}
/********* END DELETE FUNCTIONS *********/

/********* OTHER FUNCTIONS *********/
//add hardware products
function insert_product($category, $price, $name, $description, $image){
    $db = new Database();
    $db->query("INSERT INTO product (category_id, product_price, product_name, product_description, product_image) VALUES (:pcategory_id, :pprice, :pname, :pdescription, :pimage);");
    $db->bind(':pcategory_id', $category);
    $db->bind(':pprice', $price);
    $db->bind(':pname', $name);
    $db->bind(':pdescription', $description);
    $db->bind(':pimage', $image);    
    if($db->execute()){
        return true;
    }
    else{
        return false;
    }

}

//get products
function get_hardware_products(){
    $db = new Database();
    $db->query("SELECT * FROM product p JOIN category c on p.category_id = c.category_id WHERE category_name = 'hardware service' ");
    $products = $db->resultset();
    return $products;
}


// update product
function update_product($values){
    $db = new Database();
    $db->query('UPDATE product SET product_name=:pname, category_id=:pcategory, product_price=:pprice, product_description=:pdescription, product_image=:pimage WHERE product_id=:pid');
    $db->bind(':pid', $values['id']);
    $db->bind(':pname', $values['name']);
    $db->bind(':pcategory', $values['category']);
    $db->bind(':pprice', $values['price']);
    $db->bind(':pdescription', $values['description']);    
    $db->bind(':pimage', $values['image']);
    if($db->execute()){
        return true;
    }
    else{
        return false;
    }

}

// delete product
function delete_product($id){
    $db = new Database();
    $db->query('DELETE FROM product WHERE product_id=:pid');
    $db->bind(':pid', $id);

    if($db->execute()){
        return true;
    }
    else{
        return false;
    }
}

// 
function get_copy_products(){
    $db = new Database();
    $db->query("SELECT * FROM product p JOIN category c on p.category_id = c.category_id WHERE category_name = 'copy service' ");
    $products = $db->resultset();
    return $products;
}

/**
 * @param $size
 * @param $dir
 * @param $file_name
 *
 * Uploads image to given directory with given file_name.
 */
function upload_img($dir,$file_name){

    if (!file_exists($dir.'/')) {
        mkdir($dir.'/', 0777, true);
    }

    if(isset($_FILES["file_upload"])){

        if($_FILES['file_upload']['error'] > 0){
            die('Er iets mis gegaan tijdens het uploaden.');
        }
        if($_FILES['file_upload']['type'] != 'image/png' && $_FILES['file_upload']['type']!= 'image/jpeg'){
            die('Dit bestand wordt niet ondersteund.');
        }

        if($_FILES['file_upload']['size'] > 1000000){
            die('Dit bestand is te groot kies een kleiner bestand.');
        }

        if(move_uploaded_file($_FILES['file_upload']['tmp_name'], $dir.'/' . $file_name)){
            print("upload succesfull");
        }


    }
}

