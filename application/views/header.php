<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$header_data['title']?></title>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
    <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/css/style.less" />
    <script src="<?=base_url()?>assets/js/jquery-1.9.1.js" type="text/javascript"></script> 
    <script src="<?=base_url()?>assets/js/bootstrap.min.js" type="text/javascript"></script> 
    <script src="<?=base_url()?>assets/js/less.js" type="text/javascript"></script>
    <!--[if IE 7]>
    <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
    <![endif]--> 
</head>
<body<?=$header_data['flag'] ? ' class="'.$header_data['flag'].'"' : ''?>>
<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="http://localhost/compclub/">Title Here</a>
        <ul class="nav">
            <li<?=$header_data['page'] == 'home' ? ' class="active"' : '' ?>><a href="<?=base_url()?>">เช็คชื่อ</a></li>
            <li<?=$header_data['page'] == 'search' ? ' class="active"' : '' ?>><a href="<?=base_url()?>index.php/search">รายชื่อทั้งหมด</a></li>
            <li<?=$header_data['page'] == 'absence' ? ' class="active"' : '' ?>><a href="<?=base_url()?>index.php/absence">คนที่ไม่มา</a></li>
        </ul>
        <ul class="nav pull-right">
            <li><a><?=date('j M Y - G:i:s', time());?></a></li>
        </ul>
    </div>
</div>
<div class="container">