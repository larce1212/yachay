<?php

class Invitations_InvitationController extends Yeah_Action
{
    public function proceedAction() {
        global $CONFIG;
        global $USER;

        if ($USER->role != 1) {
            $this->_redirect($CONFIG->wwwroot);
        }

        $request = $this->getRequest();
        $code = $request->getParam('code');

        $model_invitations = new Invitations();

        $invitation = $model_invitations->findByCode(md5($CONFIG->key . $code));
        $this->requireExistence($invitation, 'invitation', 'frontpage_user', 'frontpage_user');

        $session = new Zend_Session_Namespace();
        if ($invitation->accepted) {
            $session->messages->addMessage('El recurso solicitado no existe');
            $this->_redirect($this->view->url(array(), 'frontpage_visitor'));
        }

        $this->view->user = new Users_Empty();

        if ($request->isPost()) {
            $model_users = new Users();
            $user = $model_users->createRow();

            $user->label = $request->getParam('label');
            $user->url = convert($user->label);
            $user->password = 'alphanum';
            $user->email = $invitation->email;
            $user->surname = $request->getParam('surname');
            $user->name = $request->getParam('name');
            $user->birthdate = $request->getParam('birthdate-year') . '-' . $request->getParam('birthdate-month') . '-' . $request->getParam('birthdate-day');

            $user->role = 2;

            if ($user->isValid()) {
                // Password generation
                $password = generatecode($user->password, $user->code);
                $user->password = md5($CONFIG->key . $password);

                $user->sociability = 1;
                $user->tsregister = time();
                $user->save();

                // email notification
                $view = new Zend_View();
                $view->addHelperPath($CONFIG->dirroot . 'libs/Yeah/Helpers', 'Yeah_Helpers');
                $view->setScriptPath($CONFIG->dirroot . 'modules/users/views/scripts/user/');

                $view->user       = $user;
                $view->servername = $CONFIG->wwwroot;
                $view->author     = NULL;
                $view->password   = $password;

                $content = $view->render('mail.php');
                $mail = new Zend_Mail('UTF-8');
                $mail->setBodyHtml($content)
                     ->setFrom($CONFIG->email_direction, $CONFIG->email_name)
                     ->addTo($user->email, $user->getFullName())
                     ->setSubject('Notificacion de registro de usuario')
                     ->send();

                // friend connection
                $model_friends = new Friends();

                $author = $invitation->getAuthor();
                $author->sociability = $author->sociability + 2;
                $author->save();

                $row = $model_friends->createRow();
                $row->user = $author->ident;
                $row->friend = $user->ident;
                $row->mutual = FALSE;
                $row->tsregister = time();
                $row->save();

                $invitation->accepted = true;
                $invitation->save();

                $session->messages->addMessage('Ha sido enviado un correo con tu contraseña a tu correo electronico');
                $this->_redirect($this->view->url(array(), 'login_in'));
            } else {
                foreach ($user->getMessages() as $message) {
                    $session->messages->addMessage($message);
                }
            }

            $this->view->user = $user;
        }

        breadcrumb();
    }

    public function deleteAction() {
        $this->requirePermission('invitations', 'invite');

        $request = $this->getRequest();

        $ident_invitation = $request->getParam('invitation');

        $model_invitations = new Invitations();
        $invitation = $model_invitations->findByIdent($ident_invitation);

        $this->requireExistence($invitation, 'invitation', 'invitations_manager', 'frontpage_user');
        $this->requireResourceAuthor($invitation);

        $session = new Zend_Session_Namespace();
        if (!$invitation->accepted) {
            $invitation->delete();
            $session->messages->addMessage('La invitación ha sido revocada');
        } else {
            $session->messages->addMessage('La invitación ya ha sido aceptada');
        }

        $this->_redirect($this->view->currentPage());
    }
}
