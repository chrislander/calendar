<?php

class calendar extends base {
   
    public $calendar;
    
    public function __construct($fregistry){                                
        //Construct a calendar object and set a few accessible values
        parent::__construct($fregistry);

        //Set readable calendar things, months, days etc
        $this->set_readable_names();                                     
    }
    
    
    public function show_day($year = false, $month = false, $day = false){
        if ( $year === false || $month === false  || $day === false ){
            //Show today
        }
    }
    
    public function show_month($year = false, $month = false) {
        
        if ( $year === false || $month === false ){  
            $year = date('Y');
            $month = date('m');            
        }             

        $no_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);            
        $date = new DateTime($year.'-'.$month.'-01');                                                                        			                                                                    
        
        //Find out the start day of the current month, monday=1, sunday=7    
        $start_day = $date->format('N');        
                        
        $current = clone $date;
                
        //Work out the number of days to add to the start of the array (i.e starting day - 1)
        if ($start_day > 1 ){            	
	    // Rewind the start to a Monday
            $current->modify('-' . ($start_day-1) . ' day');                       
        }
        	
        $end = clone $current;
        $end->modify('+6 week');
        
        var_dump($end);
        
        $calendar = array();
        $calendar['current_month']              = $date->format('m');
        $calendar['current_month_short']        = $date->format('M');
        $calendar['current_month_long']         = $date->format('F');;
        
        $calendar['current_year_full']          = $date->format('Y');
        $calendar['current_year_short']         = $date->format('y');
        
        $next_month = clone $date;
        $next_month->modify('+1 month');
        
        $calendar['next_month']                 = $next_month->format('m');
        $calendar['next_month_short']           = $next_month->format('M');
        $calendar['next_month_long']            = $next_month->format('F');
        
        $prev_month = clone $date;
        $prev_month->modify('-1 month');
        
        $calendar['prev_month']                 = $prev_month->format('m');
        $calendar['prev_month_short']           = $prev_month->format('M');
        $calendar['prev_month_long']            = $prev_month->format('F');        
                
        $calendar['absolute_start_date_full']   = $current->format('Y-m-d');
        $calendar['absolute_start_date_month']  = $current->format('m');
        $calendar['absolute_start_date_year']   = $current->format('Y');
        
        $calendar['absolute_end_date_full']     = $end->format('Y-m-d');
        $calendar['absolute_end_date_month']    = $end->format('m');
        $calendar['absolute_end_date_year']     = $end->format('Y');
                
        $calendar['days_in_month']              = $no_days;
        $calendar['first_day_of_month']         = $start_day;
                
        $date_cycle = clone $current;
        
        $i=0;
        while ($date_cycle < $end){                                    
                        
            $calendar['dates'][$i] = array (
                'date_sql'      =>  $date_cycle->format('Y-m-d'),
                'date_readable' =>  $date_cycle->format('d-m-Y'),
                'date'          =>  $date_cycle->format('d'),
                'month'         =>  $date_cycle->format('m'),
                'month_short'   =>  $prev_month->format('M'), 
                'month_long'    =>  $prev_month->format('F'),
                'year'          =>  $date_cycle->format('Y'),
                'day_no'        =>  $date_cycle->format('N'),
                'day_short'     =>  $date_cycle->format('D'),
                'day_long'      =>  $date_cycle->format('l'),                                
                'data'          =>  ''
                
            );
            
            $date_cycle->modify('+1 day'); 
            $i++;
        }           
        
        $this->calendar = $calendar;
    }
    
    private function set_readable_names(){
        
        $this->month_names = array(
                __('month_jan', "January"),
                __('month_feb', "February"),
                __('month_mar', "March"),
                __('month_apr', "April"),
                __('month_may', "May"),
                __('month_jun', "June"),
                __('month_jul', "July"),
                __('month_aug', "August"),
                __('month_sep', "September"),
                __('month_oct', "October"),
                __('month_nov', "November"),
                __('month_dec', "December")
        );

        $this->day_names = array(
                __('day_sunday_short', "Sun"),
                __('day_monday_short', "Mon"),
                __('day_tuesday_short', "Tues"),
                __('day_wednesday_short', "Wed"),
                __('day_thursday_short', "Thurs"),
                __('day_friday_short', "Fri"),
                __('day_saturday_short', "Sat")
        );
        
    }
    
    
    



}
