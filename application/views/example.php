<?php
$header_hook = "";
foreach($css_files as $file){
	$header_hook .= '<link type="text/css" rel="stylesheet" href="'.$file.'" />';
}
foreach($js_files as $file){
	$header_hook .= '<script src="'.$file.'"></script>';
}

$header_hook .= <<<EOD
<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
    text-decoration: underline;
}
</style>
EOD;

$header_data['header_hook'] = $header_hook;
$this->load->view('header', $header_data);
?>

<div>
	<?php echo $output; ?>
</div>
<?php $this->load->view('footer'); ?>
