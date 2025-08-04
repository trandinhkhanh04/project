<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shipper extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
        $this->load->model('ShipperModel');

        // Kiểm tra đăng nhập shipper
        if (!$this->session->userdata('shipper_logged_in')) {
            redirect('shipper/login');
        }
    }
    public function index()
    {
        $shipper_id = $this->session->userdata('ShipperID');

        $data['canceled'] = $this->OrderModel->countOrdersByStatus($shipper_id, 5);
        $data['delivering'] = $this->OrderModel->countOrdersByStatus($shipper_id, 3);
        $data['delivered'] = $this->OrderModel->countOrdersByStatus($shipper_id, 4);
        $data['total_money'] = $this->OrderModel->getTotalAmountDelivered($shipper_id);
        $data['chart_data'] = $this->OrderModel->getChartData($shipper_id);

        $this->load->view('shipper/index', $data);
    }

    public function dashboard()
    {
        $shipper_id = $this->session->userdata('ShipperID');
        if (!$shipper_id) {
            redirect('shipper/login');
            return;
        }

        // Lọc đơn hàng theo trạng thái nếu có
        $status = $this->input->get('status');
        if ($status) {
            $data['orders'] = $this->ShipperModel->getOrdersByStatus($shipper_id, $status);
        } else {
            $data['orders'] = $this->ShipperModel->getOrdersByShipper($shipper_id);
        }

        $data['current_status'] = $status; // để active tab

        // Thống kê tổng quan
        $data['count_delivered'] = $this->ShipperModel->countOrdersByStatus($shipper_id, '4');
        $data['count_shipping'] = $this->ShipperModel->countOrdersByStatus($shipper_id, '3');
        $data['count_canceled'] = $this->ShipperModel->countOrdersByStatus($shipper_id, '5');

        $this->load->view('shipper/dashboard', $data);
    }


    // Chi tiết đơn hàng
    public function orders($order_code)
    {
        $shipper_id = $this->session->userdata('ShipperID');
        $order = $this->ShipperModel->getOrderByCode($order_code, $shipper_id);
        if (!$order) {
            show_404(); // Không cho xem đơn không thuộc shipper
        }
        $data['order'] = $order;
        $this->load->view('shipper/order_detail', $data);
    }
    // 
    public function getOrdersByShipper($shipper_id)
    {
        return $this->db->get_where('orders', ['ShipperID' => $shipper_id])->result();
    }

    public function getOrdersByShipperAndStatus($shipper_id, $status)
    {
        return $this->db->get_where('orders', [
            'ShipperID' => $shipper_id,
            'Order_Status' => $status
        ])->result();
    }



    public function confirm_delivery()
    {
        $order_id = $this->input->post('OrderID');
        $status = $this->input->post('status'); // 4 = Đã giao, 5 = Hủy

        if ($status == 4) {
            $data = [
                'Order_Status' => 4,
                'Date_delivered' => date('Y-m-d H:i:s')
            ];
        } else {
            $data = [
                'Order_Status' => 5
            ];
        }

        $this->db->where('OrderID', $order_id);
        $this->db->update('orders', $data);

        $this->session->set_flashdata('success', 'Cập nhật trạng thái đơn hàng thành công.');
        redirect('shipper/dashboard');
    }

    // Hiển thị form hồ sơ
    public function profile()
    {
        // Lấy thông tin shipper đang đăng nhập từ session
        $shipper_id = $this->session->userdata('ShipperID');

        // Nếu chưa đăng nhập, chuyển về trang login
        if (!$shipper_id) {
            redirect('shipper/login');
        }

        // Gọi model để lấy thông tin shipper từ DB
        $this->load->model('ShipperModel');
        $data['shipper'] = $this->ShipperModel->getShipperById($shipper_id);

        // Load view và truyền dữ liệu
        $this->load->view('shipper/profile_view', $data);
    }


    // Xử lý cập nhật thông tin
    public function updateProfile()
    {
        // Kiểm tra shipper đã đăng nhập chưa
        if (!$this->session->userdata('ShipperID')) {
            redirect('shipper/login');
        }

        $this->load->model('ShipperModel');
        $shipper_id = $this->session->userdata('ShipperID');

        // Lấy dữ liệu từ form
        $name              = $this->input->post('name');
        $phone             = $this->input->post('phone');
        $address           = $this->input->post('address');
        $email             = $this->input->post('email');
        $password          = $this->input->post('password');
        $confirm_password  = $this->input->post('confirm_password');
        $current_password  = $this->input->post('current_password');

        // Chuẩn bị mảng cập nhật cơ bản
        $data = [
            'Name'    => $name,
            'Phone'   => $phone,
            'Address' => $address,
            'Email'   => $email
        ];

        // Nếu người dùng có nhập 1 trong 3 trường liên quan đến đổi mật khẩu
        if (!empty($password) || !empty($confirm_password) || !empty($current_password)) {

            // Kiểm tra nếu thiếu bất kỳ trường nào thì báo lỗi
            if (empty($password) || empty($confirm_password) || empty($current_password)) {
                $this->session->set_flashdata('msg', 'Vui lòng điền đầy đủ các trường để đổi mật khẩu!');
                redirect('shipper/profile');
                return;
            }

            // Kiểm tra xác nhận lại mật khẩu
            if ($password !== $confirm_password) {
                $this->session->set_flashdata('msg', 'Mật khẩu mới không khớp!');
                redirect('shipper/profile');
                return;
            }

            // Lấy thông tin shipper từ DB để kiểm tra mật khẩu hiện tại
            $shipper = $this->ShipperModel->getShipperById($shipper_id);

            // Kiểm tra mật khẩu hiện tại có đúng không
            if (!password_verify($current_password, $shipper->Password)) {
                $this->session->set_flashdata('msg', 'Mật khẩu hiện tại không đúng!');
                redirect('shipper/profile');
                return;
            }

            // Nếu đúng thì cập nhật mật khẩu mới
            $data['Password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Cập nhật thông tin
        $this->ShipperModel->updateShipper($shipper_id, $data);

        // Thông báo thành công
        $this->session->set_flashdata('msg', 'Cập nhật thông tin thành công!');
        redirect('shipper/profile');
    }
}
