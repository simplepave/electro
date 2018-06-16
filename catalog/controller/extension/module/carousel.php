<?php
class ControllerExtensionModuleCarousel extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->_product_id = isset($this->request->get['product_id'])? $this->request->get['product_id']: false;

		$this->load->model('design/banner');
		$this->load->model('tool/image');

		// $this->document->addStyle('catalog/view/javascript/jquery/swiper/css/swiper.min.css');
		// $this->document->addStyle('catalog/view/javascript/jquery/swiper/css/opencart.css');
		// $this->document->addScript('catalog/view/javascript/jquery/swiper/js/swiper.jquery.js');

		$this->document->addStyle('catalog/view/theme/default/stylesheet/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/js/owl.carousel.min.js','footer');

		$data['banners'] = array();

		$name = false;

		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				if(!$name)
					$name = explode('.', $result['name']);

				$data['banners'][] = array(
					'id' => $result['banner_image_id'],
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']),
					'is_item' => $this->is_item($result['link']),
				);
			}
		}

		$data['name'] = isset($name[1])? $name[1]: false;

		$data['module'] = $module++;

		return $this->load->view('extension/module/carousel', $data);
	}

	private function is_item($url)
	{
		if ($this->_product_id) {
			$query = parse_url(str_replace('&amp;', '&', $url), PHP_URL_QUERY);

			if ($query) {
				parse_str($query, $data);
				if (isset($data['product_id']))
					return $this->_product_id == $data['product_id']? true: false;
			}

			return $this->_product_id == $this->decode_url($url)? true: false;
		}

      return false;
	}

	private function decode_url($url)
	{
		$path = parse_url($url, PHP_URL_PATH);
		$parts = explode('/', $path);

		if (utf8_strlen(end($parts)) == 0)
			array_pop($parts);

		foreach ($parts as $part) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE keyword = '" . $this->db->escape($part) . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

			if ($query->num_rows) {
				$url = explode('=', $query->row['query']);

				if ($url[0] == 'product_id')
					return $url[1];
			}
		}

		return false;
	}
}