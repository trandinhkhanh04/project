<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SearchByImage extends CI_Controller {

    // public function __construct() {
    //     parent::__construct();
    //     $this->load->model('productModel');
    //     $this->load->model('brandModel');
    // }

    // public function index() {
    //     $data['brand'] = $this->brandModel->get_all_brands(); // Lấy danh sách brand
    //     $data['template'] = 'pages/home/upload_image';
    //     $this->load->view('pages/layout/index', $data);
    // }

    // public function search() {
    //     if (!empty($_FILES['image']['name'])) {
    //         $config['upload_path']   = './uploads/search_image/';
    //         $config['allowed_types'] = 'jpg|png|jpeg';
    //         $config['file_name']     = time() . '_' . $_FILES['image']['name'];

    //         $this->load->library('upload', $config);

    //         if ($this->upload->do_upload('image')) {
    //             $uploadData = $this->upload->data();

    //             // Đường dẫn tuyệt đối ảnh vừa upload
    //             $imagePath = realpath('./uploads/search_image/' . $uploadData['file_name']);

    //             // Lệnh gọi script Python
    //             $command = 'python application/assets/py/search_by_image.py "' . $imagePath . '"';

    //             // Gọi script Python và lấy output
    //             $output = shell_exec($command);

    //             // Nếu cần debug, in ra output gốc từ Python:
    //             // echo '<pre>'; echo $output; echo '</pre>'; die();

    //             $productIds = [];

    //             if (!empty($output)) {
    //                 $decoded = json_decode(trim($output), true); // trim để tránh ký tự thừa
    //                 if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
    //                     $productIds = $decoded;
    //                 }
    //             }

    //             // Debug nếu cần
    //             // echo '<pre>'; print_r($productIds); echo '</pre>'; die();

    //             // Lấy sản phẩm từ database
    //             $data['results'] = !empty($productIds)
    //                 ? $this->productModel->get_products_by_ids($productIds)
    //                 : [];
    //             $data['brand'] = $this->brandModel->get_all_brands(); // Thêm dòng này

    //             $data['template'] = 'pages/home/search_by_image_result';
    //             $this->load->view('pages/layout/index', $data);
    //         } else {
    //             show_error('Upload thất bại: ' . $this->upload->display_errors(), 500);
    //         }
    //     } else {
    //         show_error('Không có ảnh được chọn.', 400);
    //     }
    // }


}
