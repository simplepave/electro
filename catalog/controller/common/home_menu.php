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
					'description' => htmlspecialchars_decode($category['comment']),
				);
			} else {
				$data['dop_categories'][] = array(
					'name'     => $category['name'],
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id']),
				);
			}
		}

		$data['advantages'] = $this->load->controller('information/advantages');

		return $this->load->view('common/home_menu', $data);
	}
}