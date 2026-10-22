<?php
require_once __DIR__ . '/BaseDao.php';

class ConsultationDao extends BaseDao {
    public function __construct() {
        parent::__construct('consultations');
    }

    // Get all consultations submitted by a specific user
    public function get_by_user($user_id) {
        return $this->query("SELECT * FROM consultations WHERE user_id = :user_id ORDER BY created_at DESC", ['user_id' => $user_id]);
    }

    // Update the status of a consultation case
    public function update_status($id, $status) {
        return $this->update($id, ['status' => $status]);
    }
}
?>