<?php

session_start();
/**
 * Created by PhpStorm.
 * User: Daan
 * Date: 29-11-2016
 * Time: 11:33
 */
include 'classes/Database.php';

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