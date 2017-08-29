<?php
class ShopController {
	

    public function single($id) {
        require "php/Model/ItemsModel.php";		 // charger le fichier PHP
        $dbItem = new ItemsModel();
        $itemHome = $dbItem -> listenerItem($id);
		// echo '<pre>'; print_r($itemHome); echo '</pre>';
		// echo sizeof($itemHome); 
		// die('fin');
        if(sizeof($itemHome) != 1)
            header("Location: ".HOST.FOLDER."404");
        else 
			// echo "<script> let testMike = 0</script>";
			
            require("shop-single.php");
			echo "<script> let idItem=".$itemHome[0]['iditems']."; let typePage = 1; </script>";
    }

}

?>