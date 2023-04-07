<?php 
    include_once 'C:\xampp\htdocs\mycruds\config.php';
    include_once 'C:\xampp\htdocs\mycruds\Model\offer.php';
    class offerC{
        public function afficher_offer()
        {
            $sql="SELECT * FROM offers";
			$db = config::getConnexion();
			try{
				$liste_o = $db->query($sql);
				return $liste_o;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
        }

        public function ajouter_offer($offer)
        {
            $sql="insert into offers (id_formation,pourcentage,price_before,price_after) values (:id_formation,:pourcentage,:price_before,:price_after)";
            $db=config::getConnexion();
            try{
                    $req=$db->prepare($sql);

                    $id_formation=$offer->get_id_formation();
                    $pourcentage=$offer->get_pourcentage();
                    $price_before=$offer->get_price_before();
                    $price_after=$offer->get_price_after();
                    $req->bindValue(':id_formation',$id_formation);
                    $req->bindValue(':pourcentage',$pourcentage);
                    $req->bindValue(':price_before',$price_before);
                    $req->bindValue(':price_after',$price_after);
                    $req->execute();
            }catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }

        public function supprimer_offer($id_offer)
        {
            $sql="DELETE FROM offers where id_offer= :id_offer";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id_offer',$id_offer);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }

        public function modifier_offer($id_offer,$offer)
        {
            try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE offers SET 
						id_formation= :id_formation,
                        pourcentage= :pourcentage,
                        price_before= :price_before,
                        price_after= :price_after
					    WHERE id_offer= :id_offer'
				);
				$query->execute([
					'id_formation' => $offer->get_id_formation(),
                    'pourcentage' => $offer->get_pourcentage(),
                    'price_before' => $offer->get_price_before(),
                    'price_after' => $offer->get_price_after(),
					'id_offer' => $id_offer
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
        }
        public function chercher_offer($id_offer)
        {
            $sql="SELECT * FROM offers where id_offer = :id_offer";
			$db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_offer',$id_offer);
            $stmt->execute();
			$count=$stmt->rowCount();
		    if ($count > 0) {
            $row = $stmt->fetch();
            return $row;
            }
            else return FALSE;
        }
    }
?>