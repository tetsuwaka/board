<?php

define("MAXTHREAD", 5); //表示スレッド数
define("MAXENTITY", 5); //表示エンティティ数

class IndexController extends Controller {
    
    public function indexAction() {
        // スレッドリストを得る
        try{
            $threadList = $this->db_manager->get('Board')->getThread();
        } catch (PDOException $e) {
            $this->db_manager->get('CreatingTables')->createBbs();
            $threadList = $this->db_manager->get('Board')->getThread();
        }
        
        // DBからエンティティデータの取得
        $count = 0;
        $bbsList = array();
        foreach ($threadList as $thread) {
            $entList = $this->db_manager->get('Board')->getEntity($thread['id'], MAXENTITY);
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
    
}