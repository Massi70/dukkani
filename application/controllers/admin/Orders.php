<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Orders extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin==false){
			redirect(base_url()."admin/Orders/");
			exit();
		}
		$this->load->model('Adminmodel');
		$this->load->model('Storesmodel');
		$this->load->model('Ordersmodel');
		//$this->load->helper('my_helper');
	}

	public function index(){
		//echo 'hello Sub-admins';exit;
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin==false){
			redirect(base_url()."admin/Index/login");
			exit();
		}

		$getAllOrders = $this->Ordersmodel->getAllOrders();
		$deliveredOrders = $this->Ordersmodel->getAllOrdersDelivered();
		$cancelledOrders = $this->Ordersmodel->getAllOrdersCancelled();
		$pendingOrders = $this->Ordersmodel->getAllOrdersPending();
		//echo '<pre>';print_r($allStores);exit;
		$assignData = array('pageName'=>'orders','orders'=>$getAllOrders,'deliveredOrders'=>$deliveredOrders,'cancelledOrders'=>$cancelledOrders,
			'pendingOrders'=>$pendingOrders);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/vieworders',$assignData);
		$this->load->view('admin/footer');
			
	}

	public function getOrderByNumber($orderNumber){
		//echo 'OrderNumber :'. $orderNumber;exit();
		$getOrderUserDetails = $this->Ordersmodel->getOrderUserDetails($orderNumber);
		$getOrderDetails = $this->Ordersmodel->getOrderDetails($orderNumber);		
		$assignData = array('pageName'=>'orders','orderUserdetails'=>$getOrderUserDetails,'orderdetails'=>$getOrderDetails);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/orderdetails',$assignData);
		$this->load->view('admin/footer');
	}


	public function export($orderNumber){
			
		// Create new PHPExcel object
		$this->load->library('Excel');
		$objPHPExcel = new Excel();
		// Set document properties
		
		
			$objPHPExcel->getProperties()->setCreator("Dukkani")
										 ->setLastModifiedBy("Dukkani")
										 ->setTitle("Dukkani Order Report")
										 ->setSubject("Dukkani Order Report")
										 ->setDescription("Export Module Created By: Masroor Ahmed (masroortunio@hotmail.com).")
										 ->setKeywords("office 2007 openxml php")
										 ->setCategory("");
			// Add some data
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'Requested Item')
						->setCellValue('B1', 'Quantity')
						->setCellValue('C1', 'Price Per Item')
						->setCellValue('D1', 'Total Price Per Item')
						->setCellValue('E1', 'Order Number')
						->setCellValue('F1', 'Customer Name')
						->setCellValue('G1', 'Location')
						->setCellValue('H1', 'Contact Number')
						/*->setCellValue('I1', 'Request No')
						->setCellValue('J1', 'Delivery Date')
						->setCellValue('K1', 'Delivery Time')*/;
			// $data = from database
			
			$data = $this->Ordersmodel->getOrderDetailsExport($orderNumber);	
			//echo '<pre>';print_r($data);exit();
			
			if(!empty($data))
			{
				$c=2;
				foreach($data as $d)
				{
					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$c, $d['english_name'])
					->setCellValue('B'.$c, $d['quantity'])
					->setCellValue('C'.$c, $d['product_price'])
					->setCellValue('D'.$c, $d['price_per_quantity'])
					->setCellValue('E'.$c, $d['order_number'])
					->setCellValue('F'.$c, $d['UserName'])
					->setCellValue('G'.$c, $d['street_address']." ".$d['villa_address'])
					->setCellValue('H'.$c, $d['phone'])
					/*->setCellValue('I'.$c, $d['RequestNo'])
					->setCellValue('J'.$c, $d['DeliveryDate'])
					->setCellValue('K'.$c, $d['DeliveryTime'])*/;
					$c++;
				}
			}
			
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Orders List');
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client's web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			//header('Content-Disposition: attachment;filename="orders_'.date('d-m-Y').'.xls"');
			header('Content-Disposition: attachment;filename="orders_'.$orderNumber.'.xls"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
		exit;	
	
	}

	public function changeStatus(){
		//echo 'Status is: '.$status;
		$status = $this->input->post_get('status');
		$order_number = $this->input->post_get('order_number');
		$admin_id = $this->input->post_get('admin_id');
		//$id = '1';
		//exit();
		$success = $this->Ordersmodel->updateStatus($order_number,$status,$admin_id);
		if($success){
			echo 'order updated successfully';
		}else{
			echo 'update failed';
		}
		
	}

	public function pendingOrders(){
		$pendingOrders = $this->Ordersmodel->getAllOrdersPending();
	}

	public function todayOrders(){
		$getAllOrders = $this->Ordersmodel->getAllOrders();
	}

	public function deliveredOrders(){
		$deliveredOrders = $this->Ordersmodel->getAllOrdersDelivered();
	}

	public function cancelledOrders(){
		$cancelledOrders = $this->Ordersmodel->getAllOrdersCancelled();
	}
	
}
/* End of file Orders.php */
/* Location: ./application/controllers/Orders.php */