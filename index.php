<?php  
      
    use \Psr\Http\Message\ServerRequestInterface as Request;  
    use \Psr\Http\Message\ResponseInterface as Response;  
      
    require './vendor/autoload.php';  
    require './mysql.php';  
    //echo "test";
    $app = new Slim\App();  
    // get user list
    $app->get('/user', 'get_user'); 

    //get company list 
    $app->get('/company', 'get_company');

    //get single user
    $app->get('/user/{id}', function($request, $response, $args) {  
         get_user_id($args['id']);

    });

    //get single company
    $app->get('/company/{id}', function($request, $response, $args) {  
         get_company_id($args['id']);

    });

    //add user
    $app->post('/add_user', function($request, $response, $args) {  
        add_user($request->getParsedBody());//Request object’s <code>getParsedBody()</code> method to parse the HTTP request  
    });

    //add commpany
    $app->post('/add_company', function($request, $response, $args) {  
        add_company($request->getParsedBody());//Request object’s <code>getParsedBody()</code> method to parse the HTTP request  
    });

    //update user   
    $app->put('/update_user', function($request, $response, $args) {  
        update_user($request->getParsedBody());  
    });

    //update company   
    $app->put('/update_company', function($request, $response, $args) {  
        update_company($request->getParsedBody());  
    }); 

    //delete user 
    $app->delete('/delete_user', function($request, $response, $args) {  
        delete_user($request->getParsedBody());  
    }); 

    //delete company
    $app->delete('/delete_company', function($request, $response, $args) {  
        delete_company($request->getParsedBody());  
    }); 
    
    $app->run();  
     // get user list  
    function get_user() {  
        $db = connect_db();  
        $sql = "SELECT * FROM user ORDER BY `user_id`";  
        $exe = $db->query($sql);  
        $data = $exe->fetch_all(MYSQLI_ASSOC);  
        $db = null;  
        echo json_encode($data); exit;
    }  

    //get sigle user 
    function get_user_id($user_id) {  
        $db = connect_db();  
        $sql = "SELECT * FROM user WHERE `user_id` = '$user_id'";  
        $exe = $db->query($sql);  
        $data = $exe->fetch_all(MYSQLI_ASSOC);  
        $db = null;  
        echo json_encode($data); exit;
    } 

    // get company list  
    function get_company() {  
        $db = connect_db();  
        $sql = "SELECT * FROM company ORDER BY `company_id`";  
        $exe = $db->query($sql);  
        $data = $exe->fetch_all(MYSQLI_ASSOC);  
        $db = null;  
        echo json_encode($data); exit;
    }

    //get sigle company information
    function get_company_id($company_id) {  
        $db = connect_db();  
        $sql = "SELECT * FROM company WHERE `company_id` = '$company_id'";;  
        $exe = $db->query($sql);  
        $data = $exe->fetch_all(MYSQLI_ASSOC);  
        $db = null;  
        echo json_encode($data); exit;
    } 

     //add user
    function add_user($data) {  
        $db = connect_db();  
        $sql = "insert into user (user_name,birth,country,region,company)"  
                . " VALUES('$data[user_name]','$data[birth]','$data[country]','$data[region]','$data[company]')";  
        $exe = $db->query($sql);
        $last_id = $db->insert_id;  
        $db = null;  
        if (!empty($last_id))  
            echo "Add user success, userid is ". $last_id;  
            exit;
    }

    //add company
    function add_company($data) {  
        $db = connect_db();  
        $sql = "insert into company (company_name,country,industry)"  
                . " VALUES('$data[company_name]','$data[country]','$data[industry]')";  
        $exe = $db->query($sql);
        $last_id = $db->insert_id;  
        $db = null;  
        if (!empty($last_id))  
            echo "Add company success, companyid is ". $last_id;  
            exit;
    } 

     // update user  
    function update_user($data) {  
        $db = connect_db();  
        $sql = "update user SET user_name = '$data[user_name]',birth = '$data[birth]',country='$data[country]',region = '$data[region]',company = '$data[company]'"  
                . " WHERE user_id = '$data[user_id]'";  
        $exe = $db->query($sql);  
        $rows = $db->affected_rows;  
        $db = null;  
        if (!empty($rows))  
            echo "Update user success";  
            exit; 
    } 

    // update company  
    function update_company($data) {  
        $db = connect_db();  
        $sql = "update company SET company_name = '$data[company_name]',country='$data[country]',industry = '$data[industry]'"  
                . " WHERE company_id = '$data[company_id]'";  
        $exe = $db->query($sql);  
        $rows = $db->affected_rows;  
        $db = null;  
        if (!empty($rows))  
            echo "Update company success";  
            exit; 
    }  
     
    // delete user 
    function delete_user($user) {  
        $db = connect_db();  
        $sql = "DELETE FROM user WHERE user_id = '$user[user_id]'";  
        $exe = $db->query($sql);
        $rows = $db->affected_rows;  
        $db = null;  
        if (!empty($rows))  
            echo "Delete user success";  
            exit;
    } 

    // delete company 
    function delete_company($company) {  
        $db = connect_db();  
        $sql = "DELETE FROM company WHERE company_id = '$company[company_id]'";  
        $exe = $db->query($sql);
        $rows = $db->affected_rows;  
        $db = null;  
        if (!empty($rows))  
            echo "Delete company success";  
            exit;
    } 




       
    ?>  