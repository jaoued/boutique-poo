<?php
    
	session_start();
	
	require_once 'php/config.php' ;
	
	
	$statments = preg_split('(/)', $_SERVER["REQUEST_URI"]); 
	$id = (sizeof($statments) > 4)?$statments[4]:0;	//conver tychamps to array
	unset($statments[4]);
	$_SERVER["REQUEST_URI"] = implode("/", $statments);
    
	
	
    // Verification des Method Utiliser
    // echo $_SERVER["REQUEST_METHOD"]; die(); // Retourne le type de la method utiliser
    
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{ 	// Si la method est POST
	

        // Test l'existance de la route
        switch($_SERVER["REQUEST_URI"])
		{
			
            case FOLDER."user-register": // Chargement de la Class et lancement de la methode
                require "php/Controller/UsersController.php"; // Charger le fichier php
                $test = new UsersController();
                $test->addUser();
            break;

			case  FOLDER."single":
					require 'php/Controller/ApiController.php';
					$test = new ApiController();
					$test->detailItem((int)$id);
					
					break;
					
            default: // Redirection vers la route 404
				// die(' FOLDER.single POST  deflaut');
                header("Location: ". FOLDER.HOST."404");
				
							
			
        }
	}

	elseif($_SERVER["REQUEST_METHOD"] == "GET")
	{

        switch($_SERVER["REQUEST_URI"]){
			
            case FOLDER:
				require "php/Controller/HomeController.php"; 
				$test = new HomeController();
                $test->home();
            break;

            case FOLDER."single":
				require "php/Controller/ShopController.php"; 
				$test = new ShopController();
                $test->single((int)$id);
					
				   break;
				   
			case FOLDER."404":
					include("404.php");
				   break;
				
			case  FOLDER."logout":
					require 'php/Controller/usersController.php';
					$test = new UsersController();
					$test->logClientOut();
					//include("home.php");
					   break;
	
         

            default:
                header("Location: ".HOST.FOLDER."404");
        }


    }