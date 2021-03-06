<?php

class Login extends MY_Controller{
  public function index(){
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->view('Public/Admin_login');
    echo "hello";
  }

  public function admin_logout(){
    $this->session->unset_userdata(userdata);
    return redirect('Login');
  }

  public function admin_login(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules(['username','User name','required|alpha|max_length[20]|is_unique[users.uname]']);
    $this->form_validation->set_rules('username','username','required');
    $this->form_validation->set_rules('password','Pass word','required|trim');

    if($this->form_validation->run() ){

      $username=$this->input->post('username');
      $password=$this->input->post('password');
      //  echo "$username";
      //  echo "$password";
      $this->load->model('Login_model');

      $login_id=$this->Login_model->login_valid($username,$password);
      if($login_id){
          $this->load->library('session');
          $this->session->set_userdata('user_id',$login_id);
          return redirect('/Admin/dashboard');

            //return redirect('views/Admin/dashboard_view');
          //return redirect('/Admin/Dashboard');
          //echo "password match;
          //return redirect('application/controllers/Admin/dashboard_view');
      }else{
        //failed
        echo "password fails";
      }


    }
    else{
      $this->load->view('Public/Admin_login');
      //echo validation_errors();
    }



  }

}

?>
