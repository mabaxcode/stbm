<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	function __construct()
	{
        parent::__construct();

		$this->load->model('MeetingRoom_model');
        $this->load->library('form_validation');
		// Check if user is logged in
		if (!$this->session->userdata('user_id')) {
			redirect();
		}
	}

	public function index()
	{	
		$data['content'] = 'app/dashboard';

		# total user
		$data['total_user'] = $this->MeetingRoom_model->count_total_users();
		# total approved booking
		$data['total_approved_booking'] = $this->MeetingRoom_model->count_total_approved_bookings();
		# total reject booking
		$data['total_reject_booking'] = $this->MeetingRoom_model->count_total_reject_bookings();
		# total pending booking
		$data['total_pending_booking'] = $this->MeetingRoom_model->count_total_pending_bookings();

		// echo $data['total_approved_booking'];exit;

		# by user id
		$data['user_booking_count'] = $this->MeetingRoom_model->count_total_bookings_by_user($this->session->userdata('user_id'));
		$data['user_in_process_count'] = $this->MeetingRoom_model->count_total_in_process_by_user($this->session->userdata('user_id'));
		$data['user_approved_count'] = $this->MeetingRoom_model->count_total_approved_by_user($this->session->userdata('user_id'));
		$data['user_rejected_count'] = $this->MeetingRoom_model->count_total_rejected_by_user($this->session->userdata('user_id'));

		$this->load->view('app/pages', $data);
	}

	public function tempahan($data=false)
	{
		$data['content']    = 'app/buat-tempahan';
		$data['add_script'] = 'global-js/calendar-script';
		$data['bilik_mesyuarat'] = $this->MeetingRoom_model->get_all();
		
		$this->load->view('app/pages', $data);
	}

	public function profile() {
		$data['content']    = 'app/profile';
		$data['user'] = $this->MeetingRoom_model->get_user_booking($this->session->userdata('user_id'));
		$data['user_info'] = $this->MeetingRoom_model->get_user_info($this->session->userdata('user_id'));

		$this->load->view('app/pages', $data);
	}

	public function mybooking($data=false)
	{
		$data['content']      = 'app/tempahan-saya';
		$data['reservations'] = $this->MeetingRoom_model->get_my_reservations($this->session->userdata('user_id'));
		$this->load->view('app/pages', $data);
	}

	public function tempah($data=false)
	{	
		$post = $this->input->post();
		

		// Set validation rules
		$this->form_validation->set_rules([
            ['field' => 'tajuk', 'label' => 'Tajuk', 'rules' => 'required|min_length[3]'],
            ['field' => 'agenda', 'label' => 'Agenda', 'rules' => 'required'],
            ['field' => 'bilik', 'label' => 'Bilik Mesyuarat', 'rules' => 'required'],
            ['field' => 'tarikh_mula', 'label' => 'Tarikh Mula', 'rules' => 'required'],
            ['field' => 'tarikh_tamat', 'label' => 'Tarikh Tamat', 'rules' => 'required']
        ]);

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => $this->form_validation->error_array()
			]);
			return;
		} else {
			$post = $this->input->post();
			// check for overlapping bookings
			$overlap = $this->MeetingRoom_model->check_overlap($post['bilik'], $post['tarikh_mula'], $post['tarikh_tamat']);
			if ($overlap) {
				echo json_encode([
					'status' => 'overlap',
					'message' => 'Tempahan bertindih dengan tempahan sedia ada.'
				]);
				return;
			}
			$this->MeetingRoom_model->insert($post);
			echo json_encode(['status' => 'success']);
			// $this->session->set_flashdata('success', 'Tempahan berjaya disimpan!');
			// echo json_encode(['status' => 'success']);
		}
	}

	public function proses($safe_id)
	{
		$encrypted_id = base64_decode(urldecode($safe_id));
		$id = $this->encryption->decrypt($encrypted_id);

		if ($id === false) {
			show_error("Invalid ID");
		}

		// Now $id is your original reservation id
		$reservation = $this->MeetingRoom_model->get_by_id($id);
		if (!$reservation) {
			show_404();
		}

		// continue...
		$data['content']      = 'app/proses-permohonan';
		$data['reservation']  = $reservation;

		switch ($reservation['status']) {
			case 'Dalam Proses':
				$data['back_url'] = 'app/permohonan'; 
				$data['proses']   = true;
				break;
			case 'Lulus':
				$data['back_url'] = 'app/permohonan_lulus'; 
				$data['proses']   = false;
				break;
			case 'Batal':
				$data['back_url'] = 'app/permohonan_batal'; 
				$data['proses']   = false;
				break;
			
			default:
				break;
		}

		$data['user'] = $this->MeetingRoom_model->get_user_booking($reservation['user_id']);
		$data['department'] = $this->MeetingRoom_model->get_user_info($reservation['user_id']);

		$this->load->view('app/pages', $data);
	}

	public function process_booking()
	{
		$post = $this->input->post();

		$id = $post['process_id'] ?? null;
		$keputusan = $post['keputusan_permohonan'] ?? null;

		if (empty($id) || empty($keputusan)) {
			echo json_encode([
				"success" => false,
				"message" => "Data tidak lengkap."
			]);
			return;
		}

		// Call model update
		$update = $this->MeetingRoom_model->update_booking_status($id, $keputusan);

		if ($update) {
			echo json_encode([
				"success" => true,
				"message" => "Permohonan berjaya diproses!"
			]);
		} else {
			echo json_encode([
				"success" => false,
				"message" => "Gagal memproses permohonan."
			]);
		}
	}

	public function permohonan()
	{
		$data['content']      = 'app/permohonan';
		$data['reservations'] = $this->MeetingRoom_model->get_reservation_list('Dalam Proses');
		$data['breadcrumb'] = "Proses Permohonan";
		$data['btn_name'] = "Proses Permohonan";
		$data['proses'] = true;
		$data['back_url'] = "permohonan";

		// echo "<pre>"; print_r($data['reservations']); echo "</pre>"; exit;
		$this->load->view('app/pages', $data);
	}

	public function permohonan_lulus()
	{
		$data['content']      = 'app/permohonan';
		$data['reservations'] = $this->MeetingRoom_model->get_reservation_list('Lulus');
		$data['breadcrumb'] = "Permohonan Lulus";
		$data['btn_name'] = "Lihat Butiran";
		$data['proses'] = false;
		$data['back_url'] = "permohonan_lulus";

		// echo "<pre>"; print_r($data['reservations']); echo "</pre>"; exit;
		$this->load->view('app/pages', $data);
	}

	public function permohonan_batal()
	{
		$data['content']      = 'app/permohonan';
		$data['reservations'] = $this->MeetingRoom_model->get_reservation_list('Batal');
		$data['breadcrumb'] = "Permohonan Batal";
		$data['btn_name'] = "Lihat Butiran";
		$data['proses'] = false;
		$data['back_url'] = "permohonan_batal";

		// echo "<pre>"; print_r($data['reservations']); echo "</pre>"; exit;
		$this->load->view('app/pages', $data);
	}

	public function senarai_pengguna()
	{
		// $data['content']      = 'app/senarai-pengguna';
		// $data['users'] = $this->MeetingRoom_model->get_all_users();

		// $this->load->view('app/pages', $data);

		$data['content']      = 'app/senarai-pengguna';
		$data['users'] = $this->MeetingRoom_model->get_all_users();
		$data['breadcrumb'] = "Senarai Pengguna";
		$data['btn_name'] = "Lihat Butiran";
		$data['proses'] = false;
		$data['back_url'] = "senarai_pengguna";

		// echo "<pre>"; print_r($data['reservations']); echo "</pre>"; exit;
		$this->load->view('app/pages', $data);
	}

	public function user_detail() {
        $post = $this->input->post();
        $user = $this->MeetingRoom_model->get_user_detail($post);
		// print_r($user);
        if ($user) {
            $html = $this->load->view('app/component/user-detail-modal', ['user' => $user], true);
            echo json_encode([
                "success" => true,
                "content" => $html
            ]);
        } else {
            echo json_encode([
                "success" => false
            ]);
        }
    }

	function edit_profile($id)
	{
		$data['content']    = 'app/edit-profile';
		$data['user'] = $this->MeetingRoom_model->get_user_booking($id);
		$data['user_info'] = $this->MeetingRoom_model->get_user_info($id);

		$this->load->view('app/pages', $data);
	}

	function tukar_katalaluan()
	{
		$data['content']    = 'app/tukar-katalaluan';

		$this->load->view('app/pages', $data);
	}

	public function edit_profile_process($data=false)
	{	
		$post = $this->input->post();


		$this->load->library('form_validation');

        // Validation rules
        $this->form_validation->set_rules('name', 'Full Name', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('phone_no', 'No Telefon', 'required');
		$this->form_validation->set_rules('department_name', 'Jabatan', 'required');
		$this->form_validation->set_rules('designation', 'Jawatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload the form with error messages
			$data['content']    = 'app/edit-profile';
			$data['user'] 		= $this->MeetingRoom_model->get_user_booking($post['user_id']);
			$data['user_info']  = $this->MeetingRoom_model->get_user_info($post['user_id']);
			$this->load->view('app/pages', $data);

        } else {
            // Validation passed, continue processing (e.g., save to DB)
			$this->MeetingRoom_model->update_profile($post);
			$this->session->set_flashdata('success', 'Profile berjaya dikemaskini!');
			redirect ('app/profile');
        }

	}

	function do_change_password()
	{
		$post = $this->input->post();

		$this->load->library('form_validation');

		// Validation rules
		$this->form_validation->set_rules('current_password', 'Current Password', 'required');
		$this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

		if ($this->form_validation->run() == FALSE) {
			// Validation failed, reload the form with error messages
			$data['content']    = 'app/tukar-katalaluan';
			$this->load->view('app/pages', $data);

		} else {
			// Validation passed, continue processing (e.g., save to DB)
			$user_id = $this->session->userdata('user_id');
			$current_password = $post['current_password'];
			$new_password = $post['new_password'];

			// check current password is correct or not
			$check = $this->MeetingRoom_model->verify_current_password($user_id, $current_password);

			if (!$check) {
				$this->session->set_flashdata('error', 'Katalaluan sekarang tidak betul.');
				$data['content']    = 'app/tukar-katalaluan';
				$this->load->view('app/pages', $data);
			}else{
				$change = $this->MeetingRoom_model->change_password($user_id, $new_password);

				if ($change == true) {
					$this->session->set_flashdata('success', 'Katalaluan berjaya ditukar!');
					redirect ('app/profile');
				} else {
					$this->session->set_flashdata('error', 'Gagal menukar katalaluan');
					$data['content']    = 'app/tukar-katalaluan';
					$this->load->view('app/pages', $data);
				}
			}

		}

	}

}
