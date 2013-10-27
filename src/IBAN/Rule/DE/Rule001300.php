<?php

namespace IBAN\Rule\DE;

class Rule001300 extends \IBAN\Rule\DE\Rule000000
{    
	public function __construct($localeCode, $instituteIdentification, $bankAccountNumber) {
		parent::__construct($localeCode, '30050000', $bankAccountNumber);
	}
}