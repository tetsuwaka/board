<?php

class AdminController extends Controller {
    
    protected $auth_action = array('edit');
    
    public function autheniticateAction() {
        
        // ポストされているか
        if (!$this->request->isPost()) {
            return $this->redirect('/');
        }
        
        // ワンタイムトークンパス
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('index/index', $token)) {
            return $this->redirect('/');
        }
        
        $userid = $this->request->getPost('id');
        $pass = $this->request->getPost('pass');
        
        $user = $this->db_manager->get('Member')->fetchByUserId($userid);
        
        if(!$user || ($user['pass'] !== sha1($pass))) {
            return $this->redirect('/');
        } else {
            $this->session->setAuthenticated(true);
            $this->session->set('user', $user);
            
            return $this->redirect('/board/edit');
        }
    }
    
    
    public function editAction() {
        $message = "";
        
        // 削除ボタンが押された場合
        if ($this->request->getPost('erase') !== null) {

            // ワンタイムトークンパス
            $token = $this->request->getPost('_token');
            if (!$this->checkCsrfToken('admin/edit', $token)) {
                return $this->redirect('/board/index.php');
            }

            // スレッド削除
            if ($this->request->getPost('thread') !== null) {
                $this->db_manager->get('Board')->deleteThread($this->request->getPost('thread'));
                $message = "スレッド{$_POST['thread']}を削除しました。";

                // エンティティ削除
            } else if ($this->request->getPost('entity') !== null) {
                $this->db_manager->get('Board')->deleteEntities($this->request->getPost('entity'));
                $message = "エンティティ{$ids}を削除しました。";
            }
        }
        return $this->render(array(
                    '_token' => $this->generateCsrfToken('admin/edit'),
                    'message' => $message,
                ));
    }
    
}
