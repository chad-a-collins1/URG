
	
	<!-- Imported JS on this page -->
	<script type="text/javascript">

if(typeof jQuery == 'undefined'){
	var jquerysrc =  "<?php echo resources_url(); ?>assets/js/jquery-1.11.3.min.js"; 
        document.write('<script type="text/javascript" src="'+jquerysrc+'"></'+'script>');
  }

</script>
	<!--<script src="<?php echo resources_url(); ?>assets/js/jquery-1.11.3.min.js"></script>		-->
	<script src="<?php echo resources_url(); ?>assets/js/bootstrap.js"></script>


</body>
</html>


<?php

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

 
//	if ($generate) {
		$content = ob_get_contents(); // ob_get_clean();

		try {
			$html2pdf = new Html2Pdf('P', 'A4', 'fr');

		

			$html2pdf->writeHTML($content);
			$html2pdf->output('viewtier.pdf');
			exit;
		} catch (Html2PdfException $e) {
			$html2pdf->clean();

			$formatter = new ExceptionFormatter($e);
			echo $formatter->getHtmlMessage();
			exit;
		}
//	}


?>
