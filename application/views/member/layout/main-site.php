<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view(MEMBER_FILE.'layout/layout-top');
$this->load->view($pagename);
$this->load->view(MEMBER_FILE.'layout/layout-bot'); ?>