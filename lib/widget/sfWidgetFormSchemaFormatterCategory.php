<?php
class sfWidgetFormSchemaFormatterCategory extends sfWidgetFormSchemaFormatter {
	protected
	$rowFormat       = '%label% \n %error% %field%
                        %help% %hidden_fields%\n',
	$errorRowFormat  = "<div>%errors%</div>",
	$helpFormat      = '<div class="form_help">%help%</div>',
	$decoratorFormat = '<div>\n  %content%</div>';
	
}