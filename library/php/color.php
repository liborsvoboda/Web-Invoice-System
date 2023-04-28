<?

require_once('color.class.php');

//function for generate of the component
$color_picker1 = new color_picker("value16", "Vyber Barvu", $_POST['value16']);
$color_picker1->print_select();
?>
