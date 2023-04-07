<?php
	include_once 'C:\xampp\htdocs\mycruds\config.php';
	include_once 'C:\xampp\htdocs\mycruds\Model\Cours.php';
class CoursC {

		function afficherCours()
		{
			$sql="SELECT * FROM cours";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function supprimerCours($idCours)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                DELETE FROM cours WHERE idCours =:idCours
                ');
                $querry->execute([
                    'idCours'=>$idCours
                ]);
                
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }
		function ajouterCours($cours)
		{
			$sql="INSERT INTO cours (nomCours,idFormation ,nbrPage, dateCreation, dateModification) 
			VALUES ( :nomCours,:idFormation ,:nbrPage, :dateCreation, :dateModification)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'nomCours' => $cours->getNomCours(),
					'idFormation' => $cours->get_idformation(),
					'nbrPage' => $cours->getNbrPage(),
					'dateCreation' => $cours->getDateCreation(),
					'dateModification' => $cours->getDateModification()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		function recupererCours($idCours)
		{
			$sql="SELECT * from cours where idCours=$idCours";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();
				
				$count=$query->rowCount();
		    	if ($count > 0) {
            	$row = $query->fetch();
            	return $row;
            	}
           		else return FALSE;
				}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		
		function modifierCours($cours, $idCours){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE cours SET 
		                nomCours= :nomCours,
						idFormation= :idFormation,
		                nbrPage= :nbrPage,
						dateCreation= :dateCreation,
		                dateModification= :dateModification
					WHERE idCours= :idCours'
				);
				$query->execute([
                    'nomCours'=> $cours->getNomCours(),
					'idFormation'=> $cours->get_idformation(),
                    'nbrPage'=> $cours->getNbrPage(),
					'dateCreation'=> $cours->getDateCreation(),
                    'dateModification'=> $cours->getDateModification(),
                    'idCours'=> $idCours
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
		public function chercher_all_cour($id_formation)
        {
            $sql="SELECT * FROM cours WHERE idFormation = '$id_formation' ";
            $db = config::getConnexion();
            try{
                $liste_t = $db->query($sql);
                $row=$liste_t->fetchAll();
                return $row;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }
		public function chercher_pdf($id_cour)
        {
            $sql="SELECT * FROM cour_pdf WHERE id_pdf = '$id_cour' ";
            $db = config::getConnexion();
            try{
                $liste_t = $db->query($sql);
                $row=$liste_t->fetchAll();
                return $row;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }
		//Partie Upload PDF : 
//**** PARTIE PDF COURS :

public function upload_pdf($id_cour,$pdfName,$pdfPath,$pdf_type)
{
	$sql="insert into cour_pdf (id_pdf,name_pdf,type,pdf) values (:id_pdf,:name_pdf,:type,:pdf)";
	$db=config::getConnexion();
	try{
			$req=$db->prepare($sql);

			$req->bindValue(':id_pdf',$id_cour);
			$req->bindValue(':name_pdf',$pdfName);
			$req->bindValue(':type',$pdf_type);
			$req->bindValue(':pdf',$pdfPath);

			$req->execute();
	}
	catch(Exception $e){
		die('Erreur:'. $e->getMessage());
	}
}

public function display_pdf($pdfID)
{
	$sql="SELECT * FROM cour_pdf where id_pdf = :id_pdf";
	$db = config::getConnexion();
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':id_pdf',$pdfID);
	$stmt->execute();
	$count=$stmt->rowCount();
	if ($count > 0) {
	$row = $stmt->fetch();
	return $row;
	}
	else return FALSE;
}
public function find_pdf_name($pdf_name)
{
	$sql="SELECT * FROM cour_pdf where name_pdf = :name_pdf";
	$db = config::getConnexion();
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':name_pdf',$pdf_name);
	$stmt->execute();
	$count=$stmt->rowCount();
	if ($count > 0) {
	$row = $stmt->fetch();
	return $row;
	}
	else return FALSE;
}

public function supprimer_pdf($pdfID)
{
	$sql="DELETE FROM cour_pdf where id_pdf=:id_pdf";
	$db = config::getConnexion();
	$req=$db->prepare($sql);
	$req->bindValue(':id_pdf',$pdfID);
	try{
		$req->execute();
	}
	catch (Exception $e){
		die('Erreur: '.$e->getMessage());
	}
}


// Pagination

function AffichercoursPaginer($page, $perPage)
{
	$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
	$sql = "SELECT * FROM cours LIMIT {$start},{$perPage}";
	$db = config::getConnexion();
	try 
	{
		$liste = $db->prepare($sql);
		$liste->execute();
		$liste = $liste->fetchAll(PDO::FETCH_ASSOC);
		return $liste;
	} 
	catch (Exception $e) 
	{
		die('Erreur: ' . $e->getMessage());
	}
}



function calcTotalRows($perPage)
{
	$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM cours";
	$db = config::getConnexion();
	try {

		$liste = $db->query($sql);
		$total = $db->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
		$pages = ceil($total / $perPage);
		return $pages;
	} catch (Exception $e) {
		die('Erreur: ' . $e->getMessage());
	}
}
}//end of class





?>