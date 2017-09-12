 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Sendmail extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('front/homepage_model');
    }
    
    public function index()
    {
        
        if ($this->input->post('sendMail') == 'Submit') {
            
            
            $name          = $this->input->post('name');
            $email         = $this->input->post('email');
            $mobile_number = $this->input->post('mobile');
            $message       = $this->input->post('message');
            $subject       = 'Mail From Party Sharty';
            $mail          = $this->send_mail_admin($email, $subject, $message, $name);
            if ($mail) {
                
                $this->session->set_flashdata('mail_sent', '<div class="alert alert-danger alert-dismissable fade in">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>thanks</strong> Your mail send successfully we will feedback soon.
                </div>');
                redirect(base_url() . 'mail-us');
            }
            
            
            else {
                
                $this->session->set_flashdata('mail_sent', '<div class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Sorry</strong> try out after sometime we cant prossece  your request this time.
  </div>');
                redirect(base_url() . 'sendmail');
            }
            
        }
        
        else {
            $this->show_view_front('front/mail', $this->data);
        }
        
        
    }
    
    
    
    
    
    
    
    
}
/* End of file */
?> 