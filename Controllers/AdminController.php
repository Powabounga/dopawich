<?php

namespace App\Controllers;

use App\Models\UsersModel;

class AdminController extends Controller{
    public function index(){

        // On vérifie si on est admin
        if($this->isAdmin()){
            $this->render('admin/index', [], 'admin');
        }
    }

    /**
     * Affiche la liste des annonces sous forme de tableau
     */
    public function annonces(){
        if($this->isAdmin()){
            $annoncesModel = new UsersModel;

            $annonces = $annoncesModel->findAll();

            $this->render('admin/annonces', compact('annonces'), 'admin');
        }
    }

    /**
     * Supprime une annonce si on est admin
     * @param int $id
     * @return void
     */
    public function supprimeAnnonce(int $id){
        if($this->isAdmin()){
            $annonce = new UsersModel;

            $annonce->delete($id);
            $_SESSION['message'] = "L'annonce a bien été supprimée";
            header('Location: '.$_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    /**
     * Verifie si on est admin 
     * @return true 
     */
    private function isAdmin(){
        // On vérifie si on est connecté et si "ROLE_ADMIN" est dans nos roles
        if(isset($_SESSION['user']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])){
            // On est admin
            return true;
        }else{
            // On est pas admin
            $_SESSION['erreur'] = "Vous n'avez pas accès à cette zone";
            header('Location: /');
            exit;
        }
    }

}