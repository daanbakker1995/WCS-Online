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
function get_quotations_archived(){
    $db = new Database();
    $db->query('SELECT * FROM quotation WHERE quotation_status=1');
    $requests = $db->resultset();
    return $requests;
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
/********* END GET FUNCTIONS *********/

/********* INSERT FUNCTIONS *********/

function insert_quotation($product_id,$customer_name ,$customer_email){
    
    $db = new Database();
    
    $db->beginTransaction();
    $db->query('INSERT INTO customer (customer_name,customer_email) VALUES (:q_customer_name,:q_customer_email)'); 
    $db->bind('q_customer_name', $customer_name);
    $db->bind('q_customer_email', $customer_email);
    $db->execute();
    
    $customer_id = $db->lastInsertId();
    
    $db->query('INSERT INTO quotation_request (customer_id,product_id,request_date) VALUES (:q_customer_id, :q_product_id,:q_request_date)');
    $db->bind(':q_customer_id', $customer_id);
    $db->bind(':q_product_id', $product_id);
    $db->bind(':q_request_date', date("Y-m-d H:i:s"));
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
    $btw = 0.21;
    $product_excl_btw = ($product_info["product_price"] - ($product_info["product_price"]  * $btw) );
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
            $db->query('UPDATE quotation_request SET request_status=:status');
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
function upload_img($size,$dir){
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

        if($_FILES['file_upload']['size'] > $size*1000000){
            die('Dit bestand is te groot kies een kleiner bestand.');
        }

        if(move_uploaded_file($_FILES['file_upload']['tmp_name'], 'offerte/' . $_FILES['file_upload']['name'])){
            print("upload succesfull");
        }


    }
}
