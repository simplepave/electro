<?php
class ControllerExtensionModuleCategory extends Controller {
	public function index() {
		$this->load->language('extension/module/category');

		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['category_id'] = $parts[0];
		} else {
			$data['category_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		if ($data['category_id'])
			return $this->filter($data['category_id']);

		else {

			$this->load->model('catalog/category');

			$this->load->model('catalog/product');

			$data['categories'] = array();

			$categories = $this->model_catalog_category->getCategories(0);

			foreach ($categories as $category) {
				$children_data = array();

				if ($category['category_id'] == $data['category_id']) {
					$children = $this->model_catalog_category->getCategories($category['category_id']);

					foreach($children as $child) {
						$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

						$children_data[] = array(
							'category_id' => $child['category_id'],
							'name' => $child['name'],
							'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
						);
					}
				}

				$filter_data = array(
					'filter_category_id'  => $category['category_id'],
					'filter_sub_category' => true
				);

				$data['categories'][] = array(
					'category_id' => $category['category_id'],
					'name'        => $category['name'],
					'children'    => $children_data,
					'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}

			return $this->load->view('extension/module/category', $data);
		}
	}

	/**
	 * Filter
	 */

	private function filter($category_id)
	{
		$this->load->model('catalog/category');
		$category = $this->model_catalog_category->getCategory($category_id);

		$parent_id = (int)$category['parent_id'];

		if ($parent_id)
			$category_id = $parent_id;

		$categories = $this->model_catalog_category->getCategories($category_id);

		$groups = [];

		foreach ($categories as $category) {
			$category_arr = [
				'category_id' => $category['category_id'],
				'name'        => $category['name'],
				'href'        => $this->url->link('product/category', 'path=' . $category['parent_id'] . '_' . $category['category_id'])
			];

			$filter_data = $this->model_catalog_category->getCategoryFilters($category['category_id']);

			foreach ($filter_data as $filters) {
				foreach ($filters['filter'] as $filter) {
					if (array_key_exists($filter['filter_id'], $groups))
						$groups[$filter['filter_id']]['categories'][$category['category_id']] = $category_arr;
					else
						$groups[$filter['filter_id']] = [
							'name'       => $filter['name'],
							'sort'       => (int)$filter['sort'],
							'categories' => [$category['category_id'] => $category_arr]
						];
				}
			}
		}

		function cmd($a, $b) {
			if ($a['sort'] == $b['sort']) return 0;
			return ($a['sort'] < $b['sort']) ? -1 : 1;
		}

		if (uasort($groups, 'cmd'))
			$data['groups'] = $groups;
		else
			$data['groups'] = false;

		$data['price'] = $this->price();

		$url = '';

		if (isset($this->request->get['filter'])) $url .= '&filter=' . $this->request->get['filter'];
		if (isset($this->request->get['sort']))   $url .= '&sort='   . $this->request->get['sort'];
		if (isset($this->request->get['order']))  $url .= '&order='  . $this->request->get['order'];
		if (isset($this->request->get['limit']))  $url .= '&limit='  . $this->request->get['limit'];
		if (isset($this->request->get['p_min']))  $url .= '&p_min='  . $this->request->get['p_min'];
		if (isset($this->request->get['p_max']))  $url .= '&p_max='  . $this->request->get['p_max'];

		$url = str_replace('&amp;', '&', $this->url->link('product/category/more', 'path=' . $this->request->get['path'] . $url));

		$data['url'] = $url;

		return $this->load->view('extension/module/category_filter', $data);
	}

	private function price()
	{
		$this->document->addStyle('catalog/view/theme/default/stylesheet/ion.rangeSlider.css');
		$this->document->addStyle('catalog/view/theme/default/stylesheet/ion.rangeSlider.skinFlat.css');
		$this->document->addScript('catalog/view/javascript/js/ion.rangeSlider.js','footer');

		$parts = explode('_', (string)$this->request->get['path']);
		$category_id = (int)array_pop($parts);

		$this->load->model('catalog/product');
		$prices = $this->model_catalog_product->getProductsPrice($category_id);

		$prices['symbol_left']  = $this->currency->getSymbolLeft($this->session->data['currency']);
		$prices['symbol_right'] = $this->currency->getSymbolRight($this->session->data['currency']);

		return ($prices['min'] && $prices['max'])? $prices: false;
	}
}