<?php
class ShipperAdmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ShipperModel');
    }

    public function index($page = 1)
    {
        $this->config->config['pageTitle'] = 'List Shippers';

        // Filter
        $keyword = $this->input->get('keyword', TRUE);
        $status = $this->input->get('status', TRUE);
        $perpage = (int) $this->input->get('perpage');
        $perpage = ($perpage > 0) ? $perpage : 10;

        $filter = [
            'keyword' => $keyword,
            'status' => $status,
        ];

        $total = $this->ShipperModel->countShippers($filter);
        $page  = ($page > 0) ? $page : 1;
        $max_page = ceil($total / $perpage);
        if ($page > $max_page && $total > 0) {
            $query = http_build_query($this->input->get());
            redirect(base_url('manage-shipper/list') . ($query ? '?' . $query : ''));
        }

        $start = ($page - 1) * $perpage;
        $data['shippers'] = $this->ShipperModel->getShippers($perpage, $start, $filter);
        $data['links'] = init_pagination(base_url('manage-shipper/list'), $total, $perpage, 3);

        // Trả filter về view
        $data['keyword'] = $keyword;
        $data['status'] = $status;
        $data['perpage'] = $perpage;

        $data['title'] = "Danh sách Shipper";
        $data['breadcrumb'] = [
            ['label' => 'Dashboard', 'url' => 'dashboard'],
            ['label' => 'Danh sách Shipper']
        ];
        $data['start'] = $start;
        $data['template'] = "manage-shipper/index";  // <-- view chính
        $this->load->view("admin-layout/admin-layout", $data);
    }


    // Hiển thị form thêm
    public function create()
    {
        $data['title'] = "Thêm mới Shipper";
        $data['breadcrumb'] = [
            ['label' => 'Dashboard', 'url' => 'dashboard'],
            ['label' => 'Shipper', 'url' => 'shipperadmin'],
            ['label' => 'Thêm mới']
        ];
        $data['template'] = "manage-shipper/create";  // Đây là view chính

        $this->load->view("admin-layout/admin-layout", $data);
    }

    public function edit($id)
{
    // Load model nếu chưa load trong __construct()
    $this->load->model('ShipperModel');
    // Lấy thông tin shipper theo ID
    $shipper = $this->ShipperModel->getById($id);
    // Kiểm tra tồn tại
    if (!$shipper) {
        show_404();
    }

    // Gửi dữ liệu sang view
    $data = [
        'title' => "Cập nhật Shipper",
        'breadcrumb' => [
            ['label' => 'Dashboard', 'url' => 'dashboard'],
            ['label' => 'Shipper', 'url' => 'shipperadmin'],
            ['label' => 'Cập nhật']
        ],
        'shipper' => $shipper,
        'template' => "manage-shipper/edit"
    ];

    // Gọi view layout chính
    $this->load->view("admin-layout/admin-layout", $data);
}


    public function update($id)
    {
        $data = [
            'Name'    => $this->input->post('Name'),
            'Phone'   => $this->input->post('Phone'),
            'Address' => $this->input->post('Address'),
            'Status'  => $this->input->post('Status'),
        ];

        $this->ShipperModel->update($id, $data);

        redirect('shipperadmin');
    }

   public function delete($id)
{
    $this->load->model('OrderModel'); // Gọi model đơn hàng nếu chưa load

    $count = $this->OrderModel->countOrdersByShipper($id);

    if ($count > 0) {
        $this->session->set_flashdata('error', 'Không thể xoá shipper vì đang được gán cho đơn hàng.');
    } else {
        $this->ShipperModel->delete($id);
        $this->session->set_flashdata('success', 'Xoá shipper thành công.');
    }

    redirect('shipperadmin');
}


    // Xử lý lưu shipper mới
    public function store()
    {
        $data = [
            'Name' => $this->input->post('Name'),
            'Phone' => $this->input->post('Phone'),
            'Address' => $this->input->post('Address'),
            'Email' => $this->input->post('Email'),
            'Password' => password_hash($this->input->post('Password'), PASSWORD_DEFAULT), 
            'Status' => $this->input->post('Status'),
        ];
        $this->ShipperModel->insert($data);
        $this->session->set_flashdata('success', 'Thêm shipper thành công');
        redirect('shipperadmin');
    }




}
