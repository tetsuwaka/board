<?php

define("MAXTHREAD", 5); //表示スレッド数
define("MAXENTITY", 5); //表示エンティティ数

class IndexController extends Collator {
    
    public function indexAction() {
        // スレッドリストを得る
        $threadList = $this->db_manager->get('Index')->getThread();
        
        // DBからエンティティデータの取得
        $count = 0;
        $bbsList = array();
        foreach ($threadList as $thread) {
            $entList = $this->db_manager->get('Index')->getEntity($thread['id'], MAXENTITY);
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