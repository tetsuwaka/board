<?php

class DeliveryController extends Controller {
    
    public function entityAction() {
        $id = $this->request->getGet('id');
        $entityList = $this->db_manager->get('Board')->getAllEntity($id);
        echo json_encode($entityList);
    }
    
    public function threadAction() {
        $threadList = $this->db_manager->get('Board')->getThreadForDelivery();
        echo json_encode($threadList);
    }
}