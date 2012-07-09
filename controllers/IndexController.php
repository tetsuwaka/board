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
                    '_token' => $this->generateCsrfToken('index/signup'),
                    'bbsList' => $bbsList,
                    'threadList' => $threadList,
                ));
    }

    public function threadAction() {
        $threadid = $this->request->getGet('threadid');

        if ($threadid === null) {
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
            $this->redirect('/board/index.php');
        }
        $name = $this->request->getPost('name');
        $body = $this->request->getPost('body');
        $thread = $this->request->getPost('thread');

        // 書き込み
        $this->db_manager->get('Board')->insertEntity($body, $thread, $name);

        // スレッドのアップデート
        $result = $this->db_manager->get('Board')->getEntityCount($thread);
        $result = $this->db_manager->get('Board')->updateThread($thread, $result[0]);
    }

}