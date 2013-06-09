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
    <?php if(isset($header_hook)) echo $header_hook; ?>
</head>
<body<?=isset($header_data['flag']) ? ' class="'.$header_data['flag'].'"' : ''?>>
<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="http://localhost/compclub/">Title Here</a>
        <ul class="nav">
            <li<?=$header_data['page'] == 'home' ? ' class="active"' : '' ?>><a href="<?=base_url()?>">เช็คชื่อ</a></li>
            <li<?=$header_data['page'] == 'search' ? ' class="active"' : '' ?>><a href="<?=base_url()?>index.php/search">รายชื่อทั้งหมด</a></li>
            <li<?=$header_data['page'] == 'absence' ? ' class="active"' : '' ?>><a href="<?=base_url()?>index.php/absence">คนที่ไม่มา</a></li>
            <li<?=($header_data['page'] == 'mapping' || 
                $header_data['page'] == 'verify_crud' ||
                $header_data['page'] == 'graduate_crud') ? ' class="active dropdown"' : ' class="dropdown"' ?>>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">CRUD <i class="icon-chevron-down"></i></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="<?=base_url()?>index.php/mapping">Barcode Map</a></li>
                    <li><a href="<?=base_url()?>index.php/graduate_crud">รายชื่อนิสิต</a></li>
                    <li><a href="<?=base_url()?>index.php/verify_crud">ประวัติการเช็คชื่อ</a></li>
                </ul>
            </li>
            <li<?=$header_data['page'] == 'map' ? ' class="active"' : '' ?>><a href="<?=base_url()?>/index.php/map">เพิ่ม Barcode</a></li>
        </ul>
        <ul class="nav pull-right">
            <li><a><?=date('j M Y - G:i:s', time());?></a></li>
        </ul>
    </div>
</div>
<div class="container">