<?php
 class CommonController extends PT_Controller { public function init() { if (!C('app_status', null, true)) { $this->error(C('app_closemsg', null, '网站升级中，请稍后访问！'), 0, 0); } if (!is_file(DATA_PATH.'/install.lock')){ $this->redirect(U('install.index.index')); } if ($this->userinfo = M('user')->checkLoginStatus()) { define('IS_LOGIN', true); } else { define('IS_LOGIN', false); } $this->searchkey = empty($_REQUEST['searchkey']) ? '' : $_REQUEST['searchkey']; $this->sitename = C('sitename'); $this->getpagesign(); $this->mobilecheck(); $this->model('cron')->check(); } protected function getnovelid() { $zym_9 = 0; if (isset($_REQUEST['novelid'])) { $zym_9 = I('request.novelid', 'int', 0); } if (!$zym_9 && isset($_REQUEST['novelkey'])) { $zym_12 = I('request.novelkey', 'str', ''); $zym_9 = M('novelsearch_info')->key2id($zym_12); } if ($zym_9) { M('novelsearch_info')->incvisit($zym_9); } return $zym_9; } public function getpagesign() { $zym_13 = C('pagesign'); $zym_14 = MODULE_NAME . '.' . CONTROLLER_NAME . '.' . ACTION_NAME; if (isset($zym_13[$zym_14])) { $this->pagesign = $zym_13[$zym_14]; $this->tkd = C('tkd_' . $this->pagesign); } else { $this->pagesign = $zym_14; $this->tkd = array('title' => '', 'keywords' => '', 'description' => ''); } } protected function mobilecheck() { $zym_5 = $this->request->isMobile(); switch ($this->config->get('wap_type')) { case 1: if ($zym_5) { $this->config->set('tpl_theme', $this->config->get('wap_theme')); $this->config->set('wap_domain', $this->config->get('siteurl')); } break; default: $zym_6 = empty($_SERVER['HTTP_X_REWRITE_URL']) ? $_SERVER['REQUEST_URI'] : $_SERVER['HTTP_X_REWRITE_URL']; if ($zym_6 == '/index.php') $zym_6 = '/'; $zym_7 = $this->config->get('wap_domain'); $zym_11 = PT_URL . $_SERVER['REQUEST_URI']; if ($zym_7) { if ($zym_5) { if (strpos($zym_11, $zym_7) === false) { $zym_8 = str_replace($this->config->get('siteurl'), $zym_7, $zym_11); if ($zym_8 == $zym_11) break; $this->redirect($zym_8); } } else { } } } $zym_10 = date('H'); if ($zym_10 < 6) { $this->view->hello = '凌晨'; } elseif ($zym_10 < 11) { $this->view->hello = '上午'; } elseif ($zym_10 < 14) { $this->view->hello = '中午'; } elseif ($zym_10 < 18) { $this->view->hello = '下午'; } else { $this->view->hello = '晚上'; } $this->config->set('wapurl', $this->config->get('wap_domain')); } }
?>