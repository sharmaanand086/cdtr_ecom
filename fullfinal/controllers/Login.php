<?php
 
class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/login');
        $this->load->view('header/footer');
        $this->load->view('header/htmlclose');
    }
    public function checkUser()
    {
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Email','required');
        if ($this->form_validation->run() == false) {
             $this->index();
            //echo "error someting";
        }else{
            $data['email'] = $this->input->post('email', true);
            $data['password'] = $this->input->post('password', true);
            $data['password'] = hash('md5',$data['password']);
            $user = $this->modUser->checkUser($data);
           // var_dump($data['email']);
            if (count($user) == 1) {
                switch ($user[0]['Status']) {
                    case 0:
                        //echo '';
                        setFlashData('alert-danger','Please activate your account before login','login');
                        break;
                    case 1:
                        if ($user[0]['password'] == $data['password']) {
                            //session here
                           $myActualUser =  array(
                                'uid'=>$user[0]['uid'],
                                'first_name'=>$user[0]['first_name'],
                                'last_name'=>$user[0]['last_name'],
                                'email'=>$user[0]['email'],
                                'date'=>$user[0]['date']
                            );
                           $this->session->set_userdata($myActualUser);
                            if ($this->session->userdata('uid')) {
                                redirect('User');
                            }else{
                                setFlashData('alert-danger','session is not created','login');
                            }
                        }
                        else{
                            setFlashData('alert-danger','Your password is invalid','login');
                        }
                        break;
                    case 2:
                        setFlashData('alert-danger','the admin blocked you.','Login');
                        break;
                }
            }else{
                echo 'The email is not exist.';
            }
        }
    }
}