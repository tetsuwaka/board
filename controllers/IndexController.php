<?php

define("MAXTHREAD", 5); //表示スレッド数

class IndexController extends Controller {

    public function indexAction() {
        // スレッドリストを得る
        try {
            $threadList = $this->db_manager->get('Board')->getThread();
        } catch (PDOException $e) {
            $this->db_manager->get('CreatingTables')->createBbs();
            $this->db_manager->get('CreatingTables')->createEntity();
            $this->db_manager->get('CreatingTables')->createMember();
            $this->db_manager->get('Member')->makeUser('user', 'pass');
            $threadList = array();
        }

        // DBからエンティティデータの取得
        $count = 0;
        $bbsList = array();
        foreach ($threadList as $thread) {
            $entList = $this->db_manager->get('Board')->getEntity($thread['id']);
            $bbsList[] = array($thread, $entList);
            // 読み込み数になったら終わり
            ++$count;
            if ($count == MAXTHREAD) {
                break;
            }
        }

        return $this->render(array(
                    '_token' => $this->generateCsrfToken('index/index'),
                    'bbsList' => $bbsList,
                    'threadList' => $threadList,
                ));
    }

    public function threadAction() {
        $threadid = $this->request->getGet('threadid');

        if ($threadid === null or $threadid === '' or !ctype_digit($threadid)) {
            $this->forward404();
        }

        $thread = $this->db_manager->get('Board')->getThreadById($threadid);
        $entList = $this->db_manager->get('Board')->getEntity($threadid);
        $bbsList = array($thread, $entList);

        return $this->render(array(
                    'thread' => $bbsList
                ));
    }

    public function writeAction() {
        if (!$this->request->isPost()) {
            $this->redirect('/');
        }
        $name = $this->request->getPost('name');
        $body = $this->request->getPost('body');
        $thread = $this->request->getPost('thread');

	if (empty($body) or empty($thread)) {
            $this->forward404();
        }

        // 書き込み
        $this->db_manager->get('Board')->insertEntity($body, $thread, $name);

        // スレッドのアップデート
        $result = $this->db_manager->get('Board')->getEntityCount($thread);
        $this->db_manager->get('Board')->updateThread($thread, $result[0]);

        return $this->render(array());
    }

    public function mkthreadAction() {
        return $this->render(array('_token' => $this->generateCsrfToken('index/mkthread')));
    }

    public function createAction() {

        // ポストされているか
        if (!$this->request->isPost()) {
            return $this->redirect('/');
        }

        // ワンタイムトークンパス
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('index/mkthread', $token)) {
            return $this->redirect('/');
        }

        $name = $this->request->getPost('name');
        $body = $this->request->getPost('body');
        $title = $this->request->getPost('title');

        if (($body === null) or ($title === null)) {
            return $this->redirect('/');
        }

        // スレッド作成
        $this->db_manager->get('Board')->makeThread($title);

        // スレッドのIDを得る
        $myid = $this->db_manager->get('Board')->getThreadId($title);
        
        // スレッドに書き込む
        $this->db_manager->get('Board')->insertEntity($body, $myid['id'], $name);

        return $this->render(array());
    }

}
