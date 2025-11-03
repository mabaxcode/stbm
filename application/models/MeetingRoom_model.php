<?php
class MeetingRoom_model extends CI_Model {
    public function get_all() {
        return $this->db->get('meeting_rooms')->result_array();
    }

    public function check_overlap($room_id, $start_time, $end_time) {
        $this->db->where('meeting_room_id', $room_id);
        $this->db->where('start_time <', $end_time);
        $this->db->where('end_time >', $start_time);
        $query = $this->db->get('reservations');
        return $query->num_rows() > 0;
    }

    public function insert($data) {
        // echo "<pre>"; print_r($data); echo "</pre>"; exit;
        $data = [
            'user_id'           => $this->session->userdata('user_id'),
            'title'             => $data['tajuk'],
            'purpose'           => $data['agenda'],
            'meeting_room_id'   => $data['bilik'],
            'start_time'        => $data['tarikh_mula'],
            'end_time'          => $data['tarikh_tamat'],
            'remark'            => $data['catatan'],
            'created_at'        => date('Y-m-d H:i:s'),
            'status'            => 'Dalam Proses',
        ];
        $this->db->insert('reservations', $data);
        // echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    public function get_events() {
        $query = $this->db->get('reservations');
        $events = [];

        foreach ($query->result() as $row) {
            $room_name = $this->db->get_where('meeting_rooms', ['id' => $row->meeting_room_id])->row()->name;
            $events[] = [
                'id'        => $row->id,
                'title'     => $room_name . "-" . strtoupper($row->title), 
                'start'     => date('Y-m-d', strtotime($row->start_time)),
                'end'       => date('Y-m-d', strtotime($row->end_time)),  
                'room_name' => $room_name,
                'agenda'    => $row->purpose,
                'start_time'=> $row->start_time,
                'end_time'  => $row->end_time,
                'status'    => $row->status,
            ];
        }

        return $events;
    }

    public function get_my_reservations($user_id) {
        // $this->db->where('user_id', $user_id);
        // $this->db->order_by('start_time', 'DESC');
        // return $this->db->get('reservations')->result_array();
        // $this->db->select('r.*, m.name AS room_name, s.name AS status_name');
        $this->db->select('r.*, m.name AS room_name');
        $this->db->from('reservations r');
        $this->db->join('meeting_rooms m', 'm.id = r.meeting_room_id', 'left');
        // $this->db->join('status_ref s', 's.code = r.status', 'left');
        $this->db->where('r.user_id', $user_id);
        $this->db->order_by('r.start_time', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_reservation_detail($post) {
        $this->db->select('r.*, m.name AS room_name, u.name AS user_name, u.email AS user_email');
        $this->db->from('reservations r');
        $this->db->join('meeting_rooms m', 'm.id = r.meeting_room_id', 'left');
        $this->db->join('users u', 'u.id = r.user_id', 'left');
        $this->db->where('r.id', $post['id']);
        return $this->db->get()->row_array();
    }
    
    public function delete_reservation($post) {
        $this->db->where('id', $post['id']);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'Dalam Proses'); // only allow deletion if status is 'Dalam Proses'
        $this->db->delete('reservations');
        return $this->db->affected_rows() > 0;
    }

    public function get_reservation_list($status) {
        $this->db->select('r.*, m.name AS room_name');
        $this->db->from('reservations r');
        $this->db->join('meeting_rooms m', 'm.id = r.meeting_room_id', 'left');
        $this->db->where('r.status', $status);
        $this->db->order_by('r.start_time', 'DESC');
        return $this->db->get()->result_array();
    }
    
    public function get_by_id($id) {
        $this->db->select('r.*, m.name AS room_name, u.name AS user_name, u.email AS user_email');
        $this->db->from('reservations r');
        $this->db->join('meeting_rooms m', 'm.id = r.meeting_room_id', 'left');
        $this->db->join('users u', 'u.id = r.user_id', 'left');
        $this->db->where('r.id', $id);
        return $this->db->get()->row_array();
    }

    public function update_booking_status($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update('reservations', [
            'status'     => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function get_user_booking($id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    public function get_user_info($user_id) {
        $this->db->select('*');
        $this->db->from('user_info');
        $this->db->where('user_id', $user_id);
        return $this->db->get()->row_array();
    }

    function get_all_users() {
        $this->db->select('*, users.id as row_id');
        $this->db->from('users');
        // where role user
        $this->db->where('users.role', 'user');
        // join user info table with user_id    
        $this->db->join('user_info', 'users.id = user_info.user_id', 'left');
        return $this->db->get()->result_array();
    }

    public function get_user_detail($post) {
        $this->db->select('*, users.id as row_id');
        $this->db->from('users');
        $this->db->where('users.id', $post['id']);  
        $this->db->join('user_info', 'users.id = user_info.user_id', 'left');
        // echo $this->db->last_query();
        return $this->db->get()->row_array();
    }

    public function update_profile($post) {


        $user_id = $post['user_id'];

        # user
        $user_data = [
            'name'  => $post['name'],
            'email' => $post['email'],
        ];

        # user_info
        $user_info_data = [
            'phone_no'        => $post['phone_no'],
            'department_name' => $post['department_name'],
            'designation'     => $post['designation'],
        ];

        // Update users table
        $this->db->where('id', $user_id);
        $this->db->update('users', $user_data);

        // Update user_info table
        $this->db->where('user_id', $user_id);
        $this->db->update('user_info', $user_info_data);

        return ($this->db->affected_rows() > 0);
    }

    function verify_current_password($user_id, $current_password) {
        $this->db->where('id', $user_id);
        $user = $this->db->get('users')->row_array();

        if ($user && password_verify($current_password, $user['password'])) {
            return true;
        }
        return false;
    }

    function change_password($user_id, $new_password) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', [
            'password' => password_hash($new_password, PASSWORD_BCRYPT)
        ]);
    }

    function count_total_users() {
        $this->db->where('role', 'user');
        return $this->db->count_all_results('users');
    }

    function count_total_approved_bookings() {
        $this->db->where('status', 'Lulus');
        return $this->db->count_all_results('reservations');
    }

    function count_total_pending_bookings() {
        $this->db->where('status', 'Dalam Proses');
        return $this->db->count_all_results('reservations');
    }

    function count_total_reject_bookings() {
        $this->db->where('status', 'Batal');
        return $this->db->count_all_results('reservations');
    }

    function count_total_bookings_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->count_all_results('reservations');
    }

    function count_total_in_process_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'Dalam Proses');
        return $this->db->count_all_results('reservations');
    }

    function count_total_approved_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'Lulus');
        return $this->db->count_all_results('reservations');
    }

    function count_total_rejected_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'Batal');
        return $this->db->count_all_results('reservations');
    }

}
?>