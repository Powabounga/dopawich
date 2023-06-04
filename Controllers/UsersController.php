<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\UsersModel;

class UsersController extends Controller{

    /**
     * Connexion des utilisateurs
     *
     * @return void
     */
    public function login(){
        
        // On vérifie si le formulaire est complet 
        if(Form::validate($_POST, ['email', 'password'])){
            // Le formulaire est complet 
            // On va chercher dans la base de donnée l'utilisateur avec l'email entré
            $usersModel = new UsersModel;
            $userArray = $usersModel->findOneByEmail(strip_tags($_POST['email']));

            // Si l'utilisateur n'existe pas
            if(!$userArray){
                // On envoie un message de session 
                $_SESSION['erreur'] = "L'adresse email et/ou le mot de passe est incorrect";
                header('Location: /users/login');
                exit;
            }

            // L'utilisateur existe 
            $user = $usersModel->hydrate($userArray);

            // On vérifie si le mot de passe est correct 
            if(password_verify($_POST['password'], $user->getPassword())){
                // Le mot de pass est bon
                // On crée la session
                $user->setSession();
                header('Location: /');
                exit;
            }else{
                // Mauvais mot de passe
                $_SESSION['erreur'] = "L'adresse email et/ou le mot de passe est incorrect";
                header('Location: /users/login');
                exit;
            }
        }

        // On instancie le formulaire
        $form = new Form;

        // On ajoute chacune des parties qui nous intéressent
        $form->debutForm('post', '#', ['class' => 'w-100'])
            ->ajoutLabelFor('email', 'Email :')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control'])
            ->ajoutLabelFor('password', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['id' => 'password', 'class' => 'form-control'])
            ->ajoutBouton('Me connecter', ['class' => 'w-100 btn mb-3 btn-lg orange-button'])
            ->finForm() ;

        // On envoie le formulaire à la vue en utilisant notre méthode "create"
        $this->render('users/login', ['loginForm' => $form->create()]);
    }



    /**
     * Inscription des utilisateurs
     *
     * @return void
     */
    public function register(){

        // On vérifie si le formulaire est valide 
        if(Form::validate($_POST, ['email', 'password'])){
            // Le formulaire est valide 
            // On "nettoie" l'adresse mail, nom et prenom
            $email = strip_tags($_POST['email']);
            $first_name = strip_tags($_POST['first_name']);
            $last_name = strip_tags($_POST['last_name']);

            // On chiffre le mot de passe
            $pass = password_hash($_POST['password'], PASSWORD_ARGON2I);

            // On hydrate l'utilisateur en base de donnée 
            $user = new UsersModel;
            $user->setLast_name($last_name)
                ->setFirst_name($first_name)
                ->setEmail($email)
                ->setPassword($pass);

            // On stocke l'utilisateur
            $user->create();

            // On redirige
            $_SESSION['message'] = "Votre inscription a été validé";
            header('Location: login');
            exit;
        }


        $form = new Form;

        $form->debutForm('post', '#', ['class' => 'w-100'])
            ->ajoutLabelFor('first_name', 'Prénom :')
            ->ajoutInput('text', 'first_name', ['class' => 'form-control', 'id' => 'first_name', 'placeholder' => 'Jean'])
            ->ajoutLabelFor('last_name', 'Nom :')
            ->ajoutInput('text', 'last_name', ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Dupont'])
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'nom@exemple.com'])
            ->ajoutLabelFor('pass', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
            ->ajoutBouton('M\'inscrire', ['class' => 'w-100 btn mb-3 btn-lg orange-button'])
            ->finForm();

        $this->render('users/register', ['registerForm' => $form->create()]);
    } 

    /**
     * Déconnexion de l'utilisateur
     * @return void (exit) 
     */
    public function logout(){
        unset($_SESSION['user']);
        header('Location: '. $_SERVER['HTTP_REFERER']);
        exit;
    }
}

?>