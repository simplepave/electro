<?php
class ControllerInformationAdvantages extends Controller {

	public function index() {
		$this->load->model('catalog/information');

		$res = $this->model_catalog_information->getInformation(8);
		$data['dostavka_title'] = $res['title'];
		$data['dostavka_href'] = $this->url->link('information/information', 'information_id=' . $res['information_id']);

		$res = $this->model_catalog_information->getInformation(9);
		$data['garantiya_title'] = $res['title'];
		$data['garantiya_href'] = $this->url->link('information/information', 'information_id=' . $res['information_id']);

		$res = $this->model_catalog_information->getInformation(10);
		$data['drajv_title'] = $res['title'];
		$data['drajv_href'] = $this->url->link('information/information', 'information_id=' . $res['information_id']);

		$res = $this->model_catalog_information->getInformation(11);
		$data['remont_title'] = $res['title'];
		$data['remont_href'] = $this->url->link('information/information', 'information_id=' . $res['information_id']);

		return $this->load->view('information/advantages', $data);
	}
}