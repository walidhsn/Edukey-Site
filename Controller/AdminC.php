<?php 
    include_once 'C:\xampp\htdocs\mycruds\config.php';
    include_once 'C:\xampp\htdocs\mycruds\Model\Admin.php';
    class AdminC{
        public function afficher_admin()
        {
            $sql="SELECT * FROM admins";
			$db = config::getConnexion();
			try{
				$liste_a = $db->query($sql);
				return $liste_a;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
        }

        public function ajouter_admin($admin)
        {
            $sql="insert into admins (username,pass_word) values (:username,:pass_word)";
            $db=config::getConnexion();
            try{
                    $req=$db->prepare($sql);

                    $username=$admin->get_username();
                    $password=$admin->get_password();
                    $req->bindValue(':username',$username);
                    $req->bindValue(':pass_word',$password);
                    $req->execute();
            }catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }

        public function supprimer_admin($id_admin)
        {
            $sql="DELETE FROM admins where id_admin= :id_admin";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id_admin',$id_admin);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }

        public function modifier_admin($id_admin,$admin)
        {
            try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE admins SET 
						username= :username,
						pass_word= :pass_word,
					    WHERE id_admin= :id_admin'
				);
				$query->execute([
					'username' => $admin->get_username(),
					'pass_word' => $admin->get_password(),
					'id_admin' => $id_admin
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
        }
    }
?>