<?php
    require("common.php");
    $db_name = db_game;
    $db = new SQLite3($db_name);

    /* Creating a database with tables for the application */
    function init($db){
        try{
            $query = "DROP TABLE IF EXISTS employee";
            $db->exec($query);
            $query = "CREATE TABLE employee(
                      emp_id INTEGER PRIMARY KEY,
                      emp_first_name TEXT,
                      emp_last_name TEXT,
                      emp_username TEXT,
                      emp_password TEXT,
                      emp_address TEXT,
                      emp_phone INT,
                      emp_email TEXT
                        
            )";
            $db->exec($query);
            $query = "INSERT INTO employee(emp_first_name,emp_last_name,emp_username,emp_password,emp_address,emp_phone,emp_email) VALUES('Sabin','Tamrakar','admin','www',
                     'Toowoomba','0400111000','demo@gmail.com');";
            $db->exec($query);

            $query = "DROP TABLE IF EXISTS category";
            $db->exec($query);
            $query = "CREATE TABLE category(
                      cat_id INTEGER PRIMARY KEY,
                      cat_platform TEXT
                                            
            )";
            $db->exec($query);
            $query = "INSERT INTO category(cat_platform) VALUES('PlayStation');".
                "INSERT INTO category(cat_platform) VALUES('Xbox');".
                "INSERT INTO category(cat_platform) VALUES('Nintendo');".
                "INSERT INTO category(cat_platform) VALUES('PC');";
            $db->exec($query);

            $query = "DROP TABLE IF EXISTS product";
            $db->exec($query);
            $query = "CREATE TABLE product(
                      p_id INTEGER PRIMARY KEY,
                      p_name TEXT,
                      p_category TEXT,
                      p_type TEXT,
                      p_price TEXT,
                      p_status TEXT,
                      p_sale TEXT,
                      p_image TEXT,
                      p_releasedate TEXT
                                            
            )";
            $db->exec($query);
            $query = "INSERT INTO product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate) VALUES('Need for Speed Heat','PlayStation', 'Game','99.99','available','No',
            'images/productimg/need_for_speed_heat.jpg','2020-01-20');".
            "INSERT INTO product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate) VALUES('FIFA20','PlayStation', 'Game','95.00','available','No',
            'images/productimg/fifa20.jpg','2020-04-11');".
            "INSERT INTO product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate) VALUES('Red Dead Redemption','PlayStation', 'Game','119.99','available','No',
            'images/productimg/red_dead_redemption.jpg','2020-02-12');".
            "INSERT INTO product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate) VALUES('Last of US 2','PlayStation', 'Game','89.99','available','No',
            'images/productimg/last_of_us_2.jpg','2020-08-02');".
            "INSERT INTO product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate) VALUES('NBA20','PlayStation', 'Game','69.99','available','Yes',
            'images/productimg/nba_20.jpg','2019-12-20');".
            "INSERT INTO product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate) VALUES('Jedi','Xbox', 'Game','99.99','available','No',
            'images/productimg/jedi.jpg','2020-01-01');".
             "INSERT INTO product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate) VALUES('PS controller black','PlayStation', 'Accessories','99.99','available','No',
             'images/productimg/ps4dual.jpg','2020-01-13');".
            "INSERT INTO product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate) VALUES('Minecraft','PC', 'Game','99.99','available','Yes',
            'images/productimg/Minecraft_cover.png','2020-01-01');".
             "INSERT INTO product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate) VALUES('Mario','Nintendo', 'Game','62.99','available','No',
             'images/productimg/mario-3d.jpg','2020-01-13');".
             "INSERT INTO product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate) VALUES('DOTA2','PC', 'Game','101.99','available','Yes',
             'images/productimg/Dota.jpg','2020-01-13');".
              "INSERT INTO product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate) VALUES('League of legend','PC', 'Game','120.99','available','No',
             'images/productimg/lol.jpg','2020-01-13');";
            $db->exec($query);


            $query = "DROP TABLE IF EXISTS contactus";
            $db->exec($query);
            $query = "CREATE TABLE contactus(
                      con_id INTEGER PRIMARY KEY,
                      con_name TEXT,
                      con_email TEXT,
                      con_message TEXT,
                      con_date TEXT
                                            
            )";
            $db->exec($query);
            $query = "INSERT INTO contactus(con_name, con_email, con_message, con_date) VALUES('Jared Leto','jared@30secondstomars.com', 'he PlayStation 5 (PS5) is an upcoming home video game console developed by Sony Interactive 
                        Entertainment. Announced in 2019 as the successor to the PlayStation 4, it is scheduled to launch on November 12, 2020 in North America, Australia, New Zealand, Japan, Singapore, 
                        and South Korea, and on November 19, 2020 for the rest of the world. The platform is anticipated to launch in two varieties: a base PlayStation 5 system with an Ultra HD Blu-ray 
                        compatible optical disc drive for retail game support alongside online distribution via the PlayStation Store, and a lower-cost variant lacking the disc drive and retaining digital
                        download support.','2020-09-19');".
            "INSERT INTO contactus(con_name, con_email, con_message, con_date) VALUES('Bon jovi','johnbon@jovi.com', 'box is a video gaming brand created and owned by Microsoft. It represents a series
                        of video game consoles developed by Microsoft, with three consoles released in the sixth, seventh, and eighth generations, respectively. ','2020-10-21');";
            $db->exec($query);


            $query = "DROP TABLE IF EXISTS client";
            $db->exec($query);
            $query = "CREATE TABLE client(
                      cl_id INTEGER PRIMARY KEY,
                      cl_username TEXT,
                      cl_password TEXT,
                      cl_firstname TEXT,
                      cl_lastname TEXT,
                      cl_email TEXT,
                      cl_mobile TEXT,
                      cl_address TEXT,
                      cl_suburb TEXT,
                      cl_city TEXT,
                      cl_state TEXT,
                      cl_date TEXT

                                            
            )";
            $db->exec($query);
            $query = "INSERT INTO client(cl_username, cl_password, cl_firstname, cl_lastname, cl_email, cl_mobile, cl_address, cl_suburb, cl_city, cl_state, cl_date) VALUES('Hari', 'www', 'Hari', 'Maharjan','hari@maharjan.com', '0422111111', 
            '00 abc street', 'Darling Heights', 'Toowoomba', 'QLD', '2020-02-15');".
           "INSERT INTO client(cl_username, cl_password, cl_firstname, cl_lastname, cl_email, cl_mobile, cl_address, cl_suburb, cl_city, cl_state, cl_date) VALUES('Elvis', 'www', 'Elvis', 'Presley', 'Elpresley@gmail.com', '0440001211', 
            '11 def ridge', 'North Toowoomba', 'Toowoomba', 'Queensland', '2020-10-19');";
            $db->exec($query);
            
            $query = "DROP TABLE IF EXISTS banner";
            $db->exec($query);
            $query = "CREATE TABLE banner(
                      b_id INTEGER PRIMARY KEY,
                      b_name TEXT,
                      b_image TEXT,
                      b_status TEXT,
                      b_msg TEXT

                                            
            )";
            $db->exec($query);
            $query = "INSERT INTO banner(b_name,b_image,b_status,b_msg) VALUES('Fifa','images/FIFA.png','Active','Coming Soon');".
            "INSERT INTO banner(b_name,b_image,b_status,b_msg) VALUES('NFS-Heat','images/nfs-heat.jpg','Active','Released on OCT 1st 2020');".
            "INSERT INTO banner(b_name,b_image,b_status,b_msg) VALUES('Last of Us','images/Thelast.jpg','Active','Pre Order Opened...');";
            $db->exec($query);

            $query = "DROP TABLE IF EXISTS upcomingitem";
            $db->exec($query);
            $query = "CREATE TABLE upcomingitem(
                      u_id INTEGER PRIMARY KEY,
                      u_name TEXT,
                      u_image TEXT,
                      u_date TEXT,
                      u_msg TEXT

                                            
            )";
            $db->exec($query);
            $query = "INSERT INTO upcomingitem(u_name,u_image,u_date,u_msg) VALUES('Playstation5','images/ps5.jpg','2021-01-01','Another part is the creation of category which generally is the platform of the products that are to be sold such as Playstation or Xbox which later joins the products table respectively.The CRUD operation can be doen
            easily with a dynamic and easy to use layout. The authorized users are able to create edit or remove the records from the category table respectively. Inorder to show the use of javascript and ajax, the remove code of the category is done 
            using ajax where the data is posted asynchronously with alerts used to track the progress and see which id is being deleted respectively.
            ');".
            "INSERT INTO upcomingitem(u_name,u_image,u_date,u_msg) VALUES('Switch','images/switch.jpg','2020-11-12','Another part is the creation of category which generally is the platform of the products that are to be sold such as Playstation or Xbox which later joins the products table respectively.The CRUD operation can be doen
            easily with a dynamic and easy to use layout. The authorized users are able to create edit or remove the records from the category table respectively. Inorder to show the use of javascript and ajax, the remove code of the category is done 
            using ajax where the data is posted asynchronously with alerts used to track the progress and see which id is being deleted respectively.
            ');".
            "INSERT INTO upcomingitem(u_name,u_image,u_date,u_msg) VALUES('Xbox one','images/xbox.jpg','2021-02-02','Another part is the creation of category which generally is the platform of the products that are to be sold such as Playstation or Xbox which later joins the products table respectively.The CRUD operation can be doen
            easily with a dynamic and easy to use layout. The authorized users are able to create edit or remove the records from the category table respectively. Inorder to show the use of javascript and ajax, the remove code of the category is done 
            using ajax where the data is posted asynchronously with alerts used to track the progress and see which id is being deleted respectively.
            ');".
            "INSERT INTO upcomingitem(u_name,u_image,u_date,u_msg) VALUES('Asus Pc','images/pc.jpg','2020-12-1','Another part is the creation of category which generally is the platform of the products that are to be sold such as Playstation or Xbox which later joins the products table respectively.The CRUD operation can be doen
            easily with a dynamic and easy to use layout. The authorized users are able to create edit or remove the records from the category table respectively. Inorder to show the use of javascript and ajax, the remove code of the category is done 
            using ajax where the data is posted asynchronously with alerts used to track the progress and see which id is being deleted respectively.
            ');";
            $db->exec($query);


            $query = "DROP TABLE IF EXISTS orders";
            $db->exec($query);
            $query = "CREATE TABLE orders(
                      o_id INTEGER PRIMARY KEY,
                      o_name TEXT,
                      o_email TEXT,
                      o_address TEXT,
                      o_suburb TEXT,
                      o_city TEXT,
                      o_state TEXT,
                      o_mobile TEXT,
                      o_msg TEXT,
                      o_payment TEXT,
                      o_date TEXT,
                      o_status TEXT

            )";
            $db->exec($query);
            $query = "INSERT INTO orders(o_name,o_email,o_mobile,o_address,o_suburb,o_city,o_state,o_payment,o_msg,o_date,o_status) VALUES('David Beckham','david@bech.com','042222222222',
            '21 street','abc','Brisbane','QLD','cod','Another part is the creation of category which generally is the platform of the products that are to be sold such as Playstation or Xbox which later joins the products table respectively.The CRUD operation can be doen
easily with a dynamic and easy to use layout. The authorized users are able to create edit or remove the records from the category table respectively. Inorder to show the use of javascript and ajax, the remove code of the category is done 
using ajax where the data is posted asynchronously with alerts used to track the progress and see which id is being deleted respectively.
','2020-11-12','Active');".
            "INSERT INTO orders(o_name,o_email,o_mobile,o_address,o_suburb,o_city,o_state,o_payment,o_msg,o_date,o_status) VALUES('Luis Figo','figoluis@abc.com','04255555552',
            '25 street','def','Sunshine coast','QLD','banktransfer','Another part is the creation of category which generally is the platform of the products that are to be sold such as Playstation or Xbox which later joins the products table respectively.The CRUD operation can be doen
easily with a dynamic and easy to use layout. The authorized users are able to create edit or remove the records from the category table respectively. Inorder to show the use of javascript and ajax, the remove code of the category is done 
using ajax where the data is posted asynchronously with alerts used to track the progress and see which id is being deleted respectively.
','2020-10-10','Active');".
            "INSERT INTO orders(o_name,o_email,o_mobile,o_address,o_suburb,o_city,o_state,o_payment,o_msg,o_date,o_status) VALUES('Petre Cech','cech11@asf.com','042222222222',
            '20 court','sag','Toowoomba','QLD','banktransfer','Another part is the creation of category which generally is the platform of the products that are to be sold such as Playstation or Xbox which later joins the products table respectively.The CRUD operation can be doen
easily with a dynamic and easy to use layout. The authorized users are able to create edit or remove the records from the category table respectively. Inorder to show the use of javascript and ajax, the remove code of the category is done 
using ajax where the data is posted asynchronously with alerts used to track the progress and see which id is being deleted respectively.
','2020-12-12','Active');";
            $db->exec($query);

            $query = "DROP TABLE IF EXISTS orderdetails";
            $db->exec($query);
            $query = "CREATE TABLE orderdetails(
                      od_id INTEGER PRIMARY KEY,
                      od_name TEXT,
                      od_p_id TEXT,
                      od_price TEXT,
                      od_qty TEXT,
                      od_o_id TEXT,
                      od_image TEXT
                      

                                            
            )";
                $db->exec($query);
             $query = "INSERT INTO orderdetails(od_name,od_p_id,od_price,od_qty,od_o_id,od_image) VALUES('Need for Speed Heat','1','99.99','1','2',
             'images/productimg/need_for_speed_heat.jpg');".
             "INSERT INTO orderdetails(od_name,od_p_id,od_price,od_qty,od_o_id,od_image) VALUES('FIFA20','2','95.00','1','1',
             'images/productimg/fifa20.jpg');".
             "INSERT INTO orderdetails(od_name,od_p_id,od_price,od_qty,od_o_id,od_image) VALUES('NBA20','5','69.99','1','3',
             'images/productimg/nba_20.jpg');".
             "INSERT INTO orderdetails(od_name,od_p_id,od_price,od_qty,od_o_id,od_image) VALUES('Need for Speed Heat','1','99.99','1','3',
             'images/productimg/need_for_speed_heat.jpg');".
             "INSERT INTO orderdetails(od_name,od_p_id,od_price,od_qty,od_o_id,od_image) VALUES('Last of US 2','4','89.99','1','3',
             'images/productimg/last_of_us_2.jpg');";
             
             $db->exec($query);
 
        

        }
        catch(Exception $e){
            throw $e;
        }
    }
    init($db);
?>