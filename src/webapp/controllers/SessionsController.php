<?php

namespace tdt4237\webapp\controllers;

use tdt4237\webapp\repository\UserRepository;

class SessionsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function newSession()
    {
        if ($this->auth->check()) {
            $username = $this->auth->user()->getUsername();
            $this->app->flash('info', 'You are already logged in as ' . $username);
            $this->app->redirect('/');
            return;
        }

        $this->render('sessions/new.twig', []);
    }

    public function create()
    {
        $request = $this->app->request;
        $user    = $request->post('user');
        $pass    = $request->post('pass');

        if ($this->auth->checkCredentials($user, $pass)) {
            $_SESSION['user'] = $user;
            $_SESSION["password"] = $pass;
            $isAdmin = $this->auth->user()->isAdmin();

            if ($isAdmin) {
                $_SESSION["isadmin"] = "yes";
            } else {
                $_SESSION["isadmin"] = "no";
            }

            $this->app->flash('info', "You are now successfully logged in as $user.");
            $this->app->redirect('/');
            return;
        }

        $this->app->flashNow('error', 'Incorrect user/pass combination.');
        $this->render('sessions/new.twig', []);
    }

    public function destroy()
    {
        $this->auth->logout();
<<<<<<< HEAD
        $this->app->redirect('http://www.ntnu.no/');
=======
        $this->app->redirect('/');
>>>>>>> 376cdc3a62802b51e4c47ad3cdd44f4d70f6ca9a
    }
}
