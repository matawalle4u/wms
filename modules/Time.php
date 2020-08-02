 <?php
 class DateManip extends DateTime{

    public function add_days($days){
        if(!is_numeric($days) || $days <1){
            //Throw an exception
        }
        parent::modify('+', . intval($days) . 'days');
    }

    public function sub_days($days){

        if(!is_numeric($days) || $days <1){
            //Throw an exception
        }
        parent::modify('-', . abs(intval($days)) . 'days');
    }


    public function add_weeks($weeks){
        if(!is_numeric($weeks) || $weeks <1){
            //Throw an exception
        }
        parent::modify('+', . intval($weeks) . 'weeks');
    }


    public function sub_weeks($weeks){

        if(!is_numeric($weeks) || $weeks <1){
            //Throw an exception
        }
        parent::modify('-', . abs(intval($weeks)) . 'weeks');
    }

    //
    public function add_months($months){
        //Problem with months variations
        $months = (int) $months;
        $result = $this->_month+$months;

        if($result<=12){
            $this->_month = $result;
        }else{
            //Problem with 
            $check_dec = $result % 12;
            if($check_dec){
                //if not december means zero
                $this->_month = $check_dec;
                $this->_year +=floor($result /12);
            }else{
                //If December means not zero
                $this->_month = 12;
                $this->_year +=($result/12)-1;
            }
        }

    }



}
    
?>