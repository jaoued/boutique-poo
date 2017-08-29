<?php
	require "Model.php"; // Charger le fichier php
	class ItemsModel extends Model{

		function __construct() {
			parent::__construct();
        }

        public function addItem($item = array()){
			if(!isset($item['libelle'])){
				return 0;
			}
			elseif(!isset($item['description'])){
				return 0;
			}
			elseif(!isset($item['availabity']) && !is_int($item['availabity'])){
				return 0;
			}
			elseif(!isset($item['price'])){
				return 0;
			}
			elseif(!isset($item['categories_idcategories']) && !is_int($item['categories_idcategories'])){
				return 0;
			}
			
			$item['code_item'] = $this->randomByAlphNum("Items");
			return $this->insert( $item, "items" );
		}
        
        public function addOrderByItem($orderId, $itemId, $qte){

            if(!is_int($orderId)){
                return 0;
            }
            elseif(!is_int($itemId)){
                return 0;
            }

            $price = $this->select("price", "items", array("iditems"=>$itemId));
            $priceTotal = $price[0]["price"] * $qte;
            $priceTotal = number_format($priceTotal, 2, '.', '');
            settype($priceTotal, "float");
            $idFavorie = $this->insert( array("orders_idorders"=>$orderId, "items_iditems"=>$itemId, "price_final"=>$priceTotal, "qte"=>$qte), "orders_has_items" );
        }
        
        public function updateItem($itemData){
			if(!isset($itemData['iditems'])){
				return 0;
			}
            $idItem = array("iditems" => $itemData['iditems']);
            unset($itemData['iditems']);
            $this->update($itemData, $idItem, "items");
        }
        
        public function deleteItem($item = array()){
            if(!isset($item['iditems'])){
                return 0;
            }
            return $this->delete( $item, "items" );
        }
		
		 public function listenerItems($nbItem=8)
		 {
            if(!is_int($nbItem)){
                return -1;
            }
            return $this->select( "i.*, p.url", "items i, pictures p", "p.items_iditems = i.iditems GROUP BY i.iditems LIMIT ".$nbItem);
        }
		
		public function listenerItem($id)
		{
            if(!is_int($id)){
                return -1;
            }
            return $this->select( 'i.*, c.name as categorie, p.url, COUNT(r.note) as "reviews", AVG(r.note) as "moyenne"', 
					'pictures p , items i , categories c , reviews r',
					' i.categories_idcategories = c.idcategories AND i.iditems = '. $id .' GROUP BY i.iditems');
        }
		
		public function listenerPictures($id)
		{
            if(!is_int($id)){
                return -1;
            }
            return $this->select( 'url', 'pictures' , "items_iditems=".$id );
        }

		public function listenerItemReviews($id)
		{
	
            if(!is_int($id)){
                return -1;
            }
            return $this->select( '*', 'reviews' , "items_iditems=".$id );
        }
		

    }

    $test = new ItemsModel();
	//echo '<pre>'; print_r($test->listenerItems() ); echo '</pre>';
    // $id = $test->addItem( array("libelle" =>"tt", "description"=>"test1", "availabity"=>2, "price"=>2.2, "categories_idcategories"=>1) );
    // echo $id;
    // $test->updateItem( array("iditems" =>1, "libelle"=>"test1") );
    // sleep(10);
    // $test->deleteItem( array("iditems" =>$id) );
    // $test->addOrderByItem(2, 2 , 10 );