<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $resources = base_url().'resources/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title><?php echo (!empty($title) ? $title : 'FPT services'); ?></title>
    <link rel="stylesheet" href="<?php echo $resources; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $resources; ?>/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo $resources; ?>/css/main.css">
</head>
<body>
    <div id="loading" class="loading"></div>
    <div class="container-fluid">
        <div class="pan-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2 col-xs-12 text-center">
                        <a href="<?php echo base_url(); ?>index.php/home">
                            <img class="img-logo" src="<?php echo base_url('resources/images/logo.png'); ?>">
                        </a>
                    </div>
                    <div class="col-sm-10 col-xs-12">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12 panel-left hidden-xs">
                                <h4><a href="www.fptcantho.vn">www.fptcantho.vn</a></h4>
                                <h4>Mail: <a href="mailto:linhntt23@fpt.com.vn">linhntt23@fpt.com.vn</a></h4>
                                <h3>Hotline: 0939 69 8088</h3>
                            </div>
                            <div class="col-sm-8 col-xs-12 panel-right">
                                <h4>CHI NHÁNH CẦN THƠ - CÔNG TY CỔ PHẦN VIỄN THÔNG FPT</h4>
                                <h4 class="font-custom">Mọi Dịch Vụ Trên Một Kết Nối</h4>
                                <div class="visible-xs">
                                    <h4><a href="www.fptcantho.vn">www.fptcantho.vn</a></h4>
                                    <h4>Mail: <a href="mailto:linhntt23@fpt.com.vn">linhntt23@fpt.com.vn</a></h4>
                                    <h3>Hotline: 0939 69 8088</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        