<?php
   class ApiController
   {
       public function detailItem($id)
	   {
		
          require "php/Model/ItemsModel.php";         
           $dbItem = new ItemsModel();
		    
			$pictureItem = $dbItem -> listenerPictures($id);
			 $pictureItemReviews = $dbItem -> listenerItemReviews($id);

		
			// echo json_encode(array('pictures' => $pictureItem, 'reviews'=>pictureItemReviews);
			echo json_encode(array('pictures'=>$pictureItem, "ItemReviews"=>pictureItemReviews));

		   
		   
       }
   }