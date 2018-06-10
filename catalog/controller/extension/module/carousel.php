<?php
class ControllerExtensionModuleCarousel extends Controller {
	public function index($setting) {
		static $module = 0;

		$url = parse_url($_SERVER['REQUEST_URI']);
		$this->request_uri = $url['path'] . '?' . $url['query'];

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
					'is_item' => $this->is_item(html_entity_decode($result['link'], ENT_QUOTES, 'UTF-8')),
				);
			}
		}

		$data['name'] = isset($name[1])? $name[1]: false;

		$data['module'] = $module++;

		return $this->load->view('extension/module/carousel', $data);
	}

	private function is_item($url)
	{
		$url = parse_url($url);
      $request = $url['path'] . '?' . $url['query'];

      return $request == $this->request_uri? true: false;
	}
}