<?php
class ControllerCommonHomeMenu extends Controller {
	public function index() {

		$this->load->model('catalog/category');
		$this->load->model('tool/image');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $key => $category) {
			if ($category['top']) {
				$key++;

				$data['categories'][] = array(
					'id'	=> $key,
					'key' => $key == 1? 1: 0,
					'name'     => $category['name'],
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id']),
					'image' => 'image/' . $category['image'],
					'description' => htmlspecialchars_decode($category['description']),
				);
			} else {
				$data['dop_categories'][] = array(
					'name'     => $category['name'],
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id']),
				);
			}
		}

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

		return $this->load->view('common/home_menu', $data);
	}
}