<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Shipper_auth extends CI_Controller
{
    public function login()
    {
        $this->load->model('ShipperModel');
        $error = '';

        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Lấy thông tin shipper theo email
            $shipper = $this->ShipperModel->getByEmail($email); // stdClass hoặc null

            // Kiểm tra tồn tại và đúng mật khẩu
            if ($shipper && password_verify($password, $shipper->Password)) {
                // Lưu session
                $this->session->set_userdata([
                    'ShipperID' => $shipper->ShipperID,
                    'shipper_logged_in' => true
                ]);

                // Chuyển hướng tới index
                redirect('shipper/index');
            } else {
                $error = 'Email hoặc mật khẩu không đúng';
            }
        }

        // Hiển thị lại form login với thông báo lỗi nếu có
        $this->load->view('shipper/login', ['error' => $error]);
    }






    // public function login()
    // {
    //     if ($this->input->post()) {
    //         $email = $this->input->post('email');
    //         $password = $this->input->post('password');

    //         $this->load->model('ShipperModel');
    //         $shipper = $this->ShipperModel->getByEmail($email);

    //         if ($shipper && password_verify($password, $shipper->Password)) {
    //             $this->session->set_userdata('shipper_logged_in', true);
    //             $this->session->set_userdata('shipper_id', $shipper->ShipperID);
    //             redirect('shipper/dashboard');
    //         } else {
    //             $data['error'] = 'Email hoặc mật khẩu không đúng';
    //         }
    //     }

    //     $this->load->view('shipper/login', isset($data) ? $data : []);
    // }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('shipper/login');
    }
}
