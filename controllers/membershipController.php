<?php
class membershipController extends controller{

    public function index(){
        
    }
    
    public function get($id){
        $member = new Memberships();
        $data = $member->getMembershipByID($id);

        $expire = new DateTime(calculateDays($data['period'], $data['days']));
        $formatter = new IntlDateFormatter($this->config['site_locale'], IntlDateFormatter::FULL, IntlDateFormatter::NONE, $this->config['site_timezone'], IntlDateFormatter::GREGORIAN);
        $data['expired'] = $formatter->format($expire);
        $data['period_text'] = periodText($data['period'], ($data['days'] > 1) ? true : false);

        $_SESSION['buy_membership_id'] = $data['id'];

        echo json_encode($data);
    }
}
?>